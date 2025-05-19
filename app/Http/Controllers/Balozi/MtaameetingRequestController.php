<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use App\Models\MtaaMeetingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MtaameetingRequestController extends Controller
{
    /**
     * Show the form for creating a new meeting request
     */
    public function create()
    {
        return view('Balozi.MtaaMeetingRequest.create');
    }

    /**
     * Get the ID of the currently logged-in Balozi from session or Auth
     */
    protected function getBaloziId()
    {
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        return $baloziId;
    }

    /**
     * Store a newly created meeting request
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'request_details' => 'required|string',
            'requested_at' => 'required|date',
        ]);

        // Get the authenticated Balozi user ID
        $baloziId = $this->getBaloziId();
        
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        // Set default values
        $validated['balozi_id'] = $baloziId;
        $validated['status'] = 'pending'; // Set default status
        $validated['processed_at'] = null; // Will be set when status changes

        MtaaMeetingRequest::create($validated);

        return redirect()->route('balozi.mtaameetingrequest.index')
            ->with('success', 'Meeting request submitted successfully');
    }

    /**
     * Display a listing of the meeting requests
     */
    public function index()
    {
        $baloziId = Auth::id();
        $requests = MtaaMeetingRequest::where('balozi_id', $baloziId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Balozi.MtaaMeetingRequest.index', compact('requests'));
    }

    /**
     * Show the form for editing the specified meeting request
     */
    public function edit($id)
    {
        $request = MtaaMeetingRequest::findOrFail($id);
        
        // Ensure the request belongs to the current user
        if ($request->balozi_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        return view('Balozi.MtaaMeetingRequest.edit', compact('request'));
    }

    /**
     * Update the specified meeting request
     */
    public function update(Request $request, $id)
    {
        $meetingRequest = MtaaMeetingRequest::findOrFail($id);
        
        // Ensure the request belongs to the current user
        if ($meetingRequest->balozi_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'request_details' => 'required|string',
            'requested_at' => 'required|date',
            'admin_comments' => 'nullable|string',
        ]);

        $meetingRequest->update($validated);

        return redirect()->route('balozi.mtaameetingrequest.index')
            ->with('success', 'Meeting request updated successfully');
    }

    /**
     * Remove the specified meeting request
     */
    public function destroy($id)
    {
        $meetingRequest = MtaaMeetingRequest::findOrFail($id);
        
        // Ensure the request belongs to the current user
        if ($meetingRequest->balozi_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $meetingRequest->delete();

        return redirect()->route('balozi.mtaameetingrequest.index')
            ->with('success', 'Meeting request deleted successfully');
    }
}