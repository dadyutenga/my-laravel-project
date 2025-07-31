<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Malalamiko;
use App\Models\Balozi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MalalamixoController extends Controller
{
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    /**
     * Display a listing of malalamiko (VIEW ONLY)
     */
    public function index()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        // Get all Balozi under this Mwenyekiti with complaint counts
        $balozis = Balozi::where('mwenyekiti_id', $mwenyekitiId)
            ->withCount(['malalamiko' => function($query) {
                $query->where('status', 'pending');
            }])
            ->get();

        // Get selected Balozi if any
        $selectedBaloziId = request('balozi_id');
        $selectedBalozi = null;
        $malalamiko = collect();

        if ($selectedBaloziId) {
            $selectedBalozi = Balozi::where('id', $selectedBaloziId)
                ->where('mwenyekiti_id', $mwenyekitiId)
                ->first();

            if ($selectedBalozi) {
                $malalamiko = Malalamiko::where('created_by', $selectedBaloziId)
                    ->with('balozi')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            }
        }

        // Get statistics
        $malalamixoQuery = Malalamiko::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        });
        
        $stats = [
            'total' => (clone $malalamixoQuery)->count(),
            'pending' => (clone $malalamixoQuery)->where('status', 'pending')->count(),
            'resolved' => (clone $malalamixoQuery)->where('status', 'resolved')->count(),
            'rejected' => (clone $malalamixoQuery)->where('status', 'rejected')->count(),
        ];

        return view('Mwenyekiti.Malalamiko.index', compact(
            'balozis',
            'selectedBalozi',
            'selectedBaloziId',
            'malalamiko',
            'stats'
        ));
    }

    /**
     * Display specific malalamiko (VIEW ONLY)
     */
    public function show($id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        $malalamiko = Malalamiko::with('balozi')
            ->whereHas('balozi', function($query) use ($mwenyekitiId) {
                $query->where('mwenyekiti_id', $mwenyekitiId);
            })
            ->findOrFail($id);

        return view('Mwenyekiti.Malalamiko.show', compact('malalamiko'));
    }

    /**
     * Update status only (NO CREATE/DELETE)
     */
    public function updateStatus(Request $request, $id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        $request->validate([
            'status' => 'required|in:pending,resolved,rejected',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $malalamiko = Malalamiko::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })->findOrFail($id);
        
        // Prepare update data
        $updateData = [
            'status' => $request->status,
            'updated_at' => now()
        ];

        // Only add admin_notes if the column exists
        if (Schema::hasColumn('malalamiko', 'admin_notes')) {
            $updateData['admin_notes'] = $request->admin_notes;
        }

        $malalamiko->update($updateData);

        return redirect()->back()->with('success', 'Hali ya lalamiko imebadilishwa kikamilifu!');
    }
}