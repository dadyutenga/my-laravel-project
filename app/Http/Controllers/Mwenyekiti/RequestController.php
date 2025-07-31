<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Balozi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    /**
     * Display a listing of service requests
     */
    public function index()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        // Get all Balozi under this Mwenyekiti
        $balozis = Balozi::where('mwenyekiti_id', $mwenyekitiId)
            ->withCount(['services' => function($query) {
                $query->where('status', 'pending');
            }])
            ->get();

        // Get selected Balozi if any
        $selectedBaloziId = request('balozi_id');
        $selectedBalozi = null;
        $serviceRequests = collect();

        if ($selectedBaloziId) {
            $selectedBalozi = Balozi::where('id', $selectedBaloziId)
                ->where('mwenyekiti_id', $mwenyekitiId)
                ->first();

            if ($selectedBalozi) {
                $serviceRequests = Service::where('created_by', $selectedBaloziId)
                    ->with('createdByBalozi')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            }
        }

        // Get statistics
        $stats = [
            'total' => Service::visibleToMwenyekiti($mwenyekitiId)->count(),
            'pending' => Service::visibleToMwenyekiti($mwenyekitiId)->where('status', 'pending')->count(),
            'approved' => Service::visibleToMwenyekiti($mwenyekitiId)->where('status', 'approved')->count(),
            'rejected' => Service::visibleToMwenyekiti($mwenyekitiId)->where('status', 'rejected')->count(),
        ];

        return view('Mwenyekiti.Requests.index', compact(
            'balozis',
            'selectedBalozi',
            'selectedBaloziId',
            'serviceRequests',
            'stats'
        ));
    }

    /**
     * Display the specified service request
     */
    public function show($id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        $serviceRequest = Service::with('createdByBalozi')
            ->visibleToMwenyekiti($mwenyekitiId)
            ->findOrFail($id);

        return view('Mwenyekiti.Requests.show', compact('serviceRequest'));
    }

    /**
     * Update the status of a service request
     */
    public function updateStatus(Request $request, $id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $serviceRequest = Service::visibleToMwenyekiti($mwenyekitiId)->findOrFail($id);
        
        $serviceRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Hali ya ombi imebadilishwa kikamilifu!');
    }

    /**
     * Get service requests by Balozi (AJAX)
     */
    public function getRequestsByBalozi($baloziId)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        // Verify this Balozi belongs to the Mwenyekiti
        $balozi = Balozi::where('id', $baloziId)
            ->where('mwenyekiti_id', $mwenyekitiId)
            ->first();

        if (!$balozi) {
            return response()->json(['error' => 'Balozi si sahihi'], 404);
        }

        $requests = Service::where('created_by', $baloziId)
            ->with('createdByBalozi')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'balozi' => $balozi,
            'requests' => $requests
        ]);
    }

    /**
     * Get service request statistics
     */
    public function getStats()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        $stats = [
            'total' => Service::visibleToMwenyekiti($mwenyekitiId)->count(),
            'pending' => Service::visibleToMwenyekiti($mwenyekitiId)->where('status', 'pending')->count(),
            'approved' => Service::visibleToMwenyekiti($mwenyekitiId)->where('status', 'approved')->count(),
            'rejected' => Service::visibleToMwenyekiti($mwenyekitiId)->where('status', 'rejected')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Bulk update service request statuses
     */
    public function bulkUpdateStatus(Request $request)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        $request->validate([
            'request_ids' => 'required|array',
            'request_ids.*' => 'integer|exists:services,id',
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $updated = Service::whereIn('id', $request->request_ids)
            ->visibleToMwenyekiti($mwenyekitiId)
            ->update([
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', "Maombi {$updated} yamebadilishwa kikamilifu!");
    }
}