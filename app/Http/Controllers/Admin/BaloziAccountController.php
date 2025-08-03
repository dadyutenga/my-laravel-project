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

    // For managing existing Balozi auth accounts
    public function index()
    {
        // For managing existing accounts
        $baloziAccounts = BaloziAuth::with('balozi')->latest()->paginate(10);
        return view('Admin.balozi.managebaloziacc', compact('baloziAccounts'));
    }

    // For viewing account creation requests
    public function accountRequests()
    {
        // For viewing account requests
        $requests = BaloziAccountRequest::with(['balozi', 'mwenyekiti'])
            ->latest()
            ->paginate(10);

        return view('Admin.balozi.createbaloziacc', compact('requests'));
    }

    // View specific account request
    public function showRequest($requestId)
    {
        $accountRequest = BaloziAccountRequest::with(['balozi', 'mwenyekiti'])
            ->findOrFail($requestId);

        return view('Admin.balozi.createbaloziacc', compact('accountRequest'));
    }

    // Process account creation request
    public function processRequest(Request $request, $requestId)
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

            return redirect()->route('admin.balozi.account.requests')
                ->with('success', 'Balozi account created successfully.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error creating Balozi account: ' . $e->getMessage());
        }
    }

    // Update existing account password
    public function updatePassword(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'password' => 'required|string|min:8',
            ]);

            $baloziAuth = BaloziAuth::findOrFail($id);
            $baloziAuth->update([
                'password' => Hash::make($validated['password'])
            ]);

            return back()->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating password: ' . $e->getMessage());
        }
    }

    // Toggle account status (activate/deactivate)
    public function toggleStatus($id)
    {
        try {
            $baloziAuth = BaloziAuth::findOrFail($id);
            $baloziAuth->update([
                'is_active' => !$baloziAuth->is_active
            ]);

            $status = $baloziAuth->is_active ? 'activated' : 'deactivated';
            return back()->with('success', "Account {$status} successfully.");
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating status: ' . $e->getMessage());
        }
    }
}
