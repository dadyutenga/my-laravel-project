<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\MtaaMeetingRequest;
use App\Models\Balozi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingRequestController extends Controller
{
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    public function index()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        // Get all meeting requests from Balozi under this Mwenyekiti
        $meetingRequests = MtaaMeetingRequest::with('balozi')
            ->whereHas('balozi', function($query) use ($mwenyekitiId) {
                $query->where('mwenyekiti_id', $mwenyekitiId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Mwenyekiti.MeetingRequest.index', compact('meetingRequests'));
    }

    public function show($id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $meetingRequest = MtaaMeetingRequest::with('balozi')
            ->whereHas('balozi', function($query) use ($mwenyekitiId) {
                $query->where('mwenyekiti_id', $mwenyekitiId);
            })
            ->findOrFail($id);

        return view('Mwenyekiti.MeetingRequest.show', compact('meetingRequest'));
    }

    public function updateStatus(Request $request, $id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_comments' => 'required|string|min:10|max:1000',
        ]);

        $meetingRequest = MtaaMeetingRequest::with('balozi')
            ->whereHas('balozi', function($query) use ($mwenyekitiId) {
                $query->where('mwenyekiti_id', $mwenyekitiId);
            })
            ->findOrFail($id);

        $meetingRequest->update([
            'status' => $request->status,
            'admin_comments' => $request->admin_comments,
            'processed_at' => now(),
        ]);

        $statusMessage = [
            'approved' => 'Meeting request has been approved successfully!',
            'rejected' => 'Meeting request has been rejected.',
            'pending' => 'Meeting request status updated to pending.',
        ];

        return redirect()->route('mwenyekiti.meeting-requests.index')
            ->with('success', $statusMessage[$request->status]);
    }
}