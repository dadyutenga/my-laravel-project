<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function __construct()
    {
        // Middleware to ensure only authenticated Balozi can access these routes
        $this->middleware('auth.balozi');
    }

    public function index()
    {
        // Get the ID of the currently logged-in Balozi from session or Auth
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        // Only fetch Service requests created by this Balozi
        $serviceRequests = Service::visibleToBalozi($baloziId)
            ->latest()
            ->paginate(10);
            
        return view('Balozi.Services.ViewRequest', compact('serviceRequests'));
    }

    public function create()
    {
        return view('Balozi.Services.RequestServices');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'title_sw' => 'nullable|string|max:255',
                'description' => 'required|string',
                'mtaa' => 'nullable|string|max:255',
            ]);

            // Get the ID of the currently logged-in Balozi from session or Auth
            $baloziId = session('balozi_id');
            if (!$baloziId && Auth::check()) {
                $baloziId = Auth::user()->balozi_id;
            }

            if (!$baloziId) {
                throw new \Exception('Unauthorized. Balozi ID not found. Please login again.');
            }

            // Get the Balozi record to find the associated Mwenyekiti
            $balozi = \App\Models\Balozi::find($baloziId);
            if (!$balozi || !$balozi->mwenyekiti_id) {
                throw new \Exception('Mwenyekiti not found for this Balozi. Please contact support.');
            }

            $service = new Service($validated);
            $service->created_by = $baloziId;
            $service->assigned_to = $balozi->mwenyekiti_id;
            $service->status = 'pending'; // Initial status
            $service->save();

            return redirect()->route('balozi.services.index')->with('success', 'Service request created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating Service request: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // Get the ID of the currently logged-in Balozi from session or Auth
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        // Only allow viewing of Service requests created by this Balozi
        $service = Service::with('assignedTo')
            ->where('created_by', $baloziId)
            ->findOrFail($id);
            
        return view('Balozi.Services.ViewRequest', compact('service'));
    }
}
