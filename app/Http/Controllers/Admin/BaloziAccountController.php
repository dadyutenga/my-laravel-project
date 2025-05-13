<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balozi;
use App\Models\BaloziAccountRequest;
use App\Models\BaloziAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BaloziAccountController extends Controller
{
    public function __construct()
    {
        // Share pending requests count with all admin views
        $pendingRequests = BaloziAccountRequest::where('status', 'pending')->count();
        view()->share('pendingRequests', $pendingRequests);
    }

    public function index()
    {
        $requests = BaloziAccountRequest::with(['balozi', 'mwenyekiti'])
            ->latest()
            ->paginate(10);

        return view('admin.balozi.managebaloziacc', compact('requests'));
    }

    public function create($requestId)
    {
        $accountRequest = BaloziAccountRequest::with(['balozi', 'mwenyekiti'])
            ->findOrFail($requestId);

        // Check if Balozi already has an account
        if ($accountRequest->balozi->auth()->exists()) {
            return redirect()->route('admin.balozi.account.index')
                ->with('error', 'Balozi already has an account.');
        }

        // Check if request is already processed
        if ($accountRequest->status !== 'pending') {
            return redirect()->route('admin.balozi.account.index')
                ->with('error', 'This request has already been processed.');
        }

        return view('admin.balozi.createbaloziacc', compact('accountRequest'));
    }

    public function store(Request $request, $requestId)
    {
        try {
            $accountRequest = BaloziAccountRequest::with('balozi')
                ->findOrFail($requestId);

            // Validate request
            $validated = $request->validate([
                'username' => 'required|string|unique:balozi_auths,username',
                'password' => 'required|string|min:8',
            ]);

            // Check if Balozi already has an account
            if ($accountRequest->balozi->auth()->exists()) {
                return back()->with('error', 'Balozi already has an account.');
            }

            // Check if request is already processed
            if ($accountRequest->status !== 'pending') {
                return back()->with('error', 'This request has already been processed.');
            }

            // Create Balozi account
            BaloziAuth::create([
                'balozi_id' => $accountRequest->balozi_id,
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'remember_token' => Str::random(60),
                'is_active' => true,
            ]);

            // Update request status
            $accountRequest->update([
                'status' => 'approved',
                'processed_at' => now(),
                'admin_comments' => $request->input('admin_comments'),
            ]);

            return redirect()->route('admin.balozi.account.index')
                ->with('success', 'Balozi account created successfully.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error creating Balozi account: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $requestId)
    {
        try {
            $accountRequest = BaloziAccountRequest::findOrFail($requestId);

            // Check if request is already processed
            if ($accountRequest->status !== 'pending') {
                return back()->with('error', 'This request has already been processed.');
            }

            // Update request status
            $accountRequest->update([
                'status' => 'rejected',
                'processed_at' => now(),
                'admin_comments' => $request->input('admin_comments'),
            ]);

            return redirect()->route('admin.balozi.account.index')
                ->with('success', 'Account request rejected successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error rejecting request: ' . $e->getMessage());
        }
    }

    public function show($requestId)
    {
        $accountRequest = BaloziAccountRequest::with(['balozi', 'mwenyekiti'])
            ->findOrFail($requestId);

        return view('admin.balozi.createbaloziacc', compact('accountRequest'));
    }
}
