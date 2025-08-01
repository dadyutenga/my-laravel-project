<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\MahitajiMaalumu;
use App\Models\Balozi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MahitajiController extends Controller
{
    /**
     * Get the current Mwenyekiti's ID from session
     */
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    /**
     * Display a listing of Mahitaji Maalumu records (VIEW ONLY)
     */
    public function index(Request $request)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Get all Balozi under this Mwenyekiti with MahitajiMaalumu counts
            $balozis = Cache::remember("mwenyekiti_{$mwenyekitiId}_balozi_mahitaji", 300, function() use ($mwenyekitiId) {
                return Balozi::where('mwenyekiti_id', $mwenyekitiId)
                    ->where('is_active', true)
                    ->withCount(['mahitajiMaalumu'])
                    ->orderBy('first_name')
                    ->get();
            });

            // Get selected Balozi if any
            $selectedBaloziId = $request->get('balozi_id');
            $selectedBalozi = null;
            $mahitaji = collect();

            if ($selectedBaloziId) {
                // Verify Balozi belongs to this Mwenyekiti
                $selectedBalozi = Balozi::where('id', $selectedBaloziId)
                    ->where('mwenyekiti_id', $mwenyekitiId)
                    ->where('is_active', true)
                    ->first();

                if ($selectedBalozi) {
                    // Get MahitajiMaalumu records with pagination
                    $query = MahitajiMaalumu::where('created_by', $selectedBaloziId)
                        ->with(['createdBy' => function($query) {
                            $query->select('id', 'first_name', 'middle_name', 'last_name', 'phone');
                        }]);

                    // Apply search filter
                    if ($request->filled('search')) {
                        $search = $request->get('search');
                        $query->where(function($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                              ->orWhere('middle_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%")
                              ->orWhere('phone', 'like', "%{$search}%")
                              ->orWhere('disability_type', 'like', "%{$search}%")
                              ->orWhere('nida_number', 'like', "%{$search}%");
                        });
                    }

                    // Apply gender filter
                    if ($request->filled('gender')) {
                        $query->where('gender', $request->get('gender'));
                    }

                    // Apply disability type filter
                    if ($request->filled('disability_type')) {
                        $query->where('disability_type', 'like', '%' . $request->get('disability_type') . '%');
                    }

                    // Order by latest first
                    $mahitaji = $query->orderBy('created_at', 'desc')
                        ->paginate(15)
                        ->appends($request->query());
                }
            }

            // Get comprehensive statistics
            $stats = $this->getMahitajiStats($mwenyekitiId);

            return view('Mwenyekiti.Mahitaji.index', compact(
                'balozis',
                'selectedBalozi',
                'selectedBaloziId',
                'mahitaji',
                'stats'
            ));

        } catch (\Exception $e) {
            Log::error('Error fetching Mahitaji index: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null,
                'balozi_id' => $selectedBaloziId ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Display specific MahitajiMaalumu record (VIEW ONLY)
     */
    public function show($id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Use transaction for consistent read
            $mahitaji = DB::transaction(function() use ($id, $mwenyekitiId) {
                return MahitajiMaalumu::with(['createdBy' => function($query) {
                        $query->select('id', 'first_name', 'middle_name', 'last_name', 'phone', 'email', 'street_village', 'shina', 'shina_number');
                    }])
                    ->whereHas('createdBy', function($query) use ($mwenyekitiId) {
                        $query->where('mwenyekiti_id', $mwenyekitiId)
                              ->where('is_active', true);
                    })
                    ->findOrFail($id);
            });

            return view('Mwenyekiti.Mahitaji.show', compact('mahitaji'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Mahitaji not found or unauthorized access', [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId
            ]);

            return redirect()->route('mwenyekiti.mahitaji.index')
                ->with('error', 'Rekodi ya Mahitaji Maalumu haipatikani au hauruhusiwi kuiona.');

        } catch (\Exception $e) {
            Log::error('Error fetching Mahitaji details: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('mwenyekiti.mahitaji.index')
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Export Mahitaji data for a specific Balozi
     */
    public function export(Request $request, $baloziId)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Verify Balozi belongs to this Mwenyekiti
            $balozi = Balozi::where('id', $baloziId)
                ->where('mwenyekiti_id', $mwenyekitiId)
                ->where('is_active', true)
                ->firstOrFail();

            // Get all MahitajiMaalumu records for this Balozi
            $mahitaji = MahitajiMaalumu::where('created_by', $baloziId)
                ->with('createdBy')
                ->orderBy('created_at', 'desc')
                ->get();

            $filename = 'mahitaji_maalumu_' . str_replace(' ', '_', $balozi->first_name . '_' . $balozi->last_name) . '_' . date('Y-m-d') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($mahitaji) {
                $file = fopen('php://output', 'w');
                
                // CSV Headers (based on actual model fields)
                fputcsv($file, [
                    'Jina la Kwanza',
                    'Jina la Kati',
                    'Jina la Mwisho',
                    'Umri',
                    'Jinsia',
                    'Simu',
                    'Nambari ya NIDA',
                    'Aina ya Ulemavu',
                    'Tarehe ya Kuongezwa'
                ]);

                // CSV Data
                foreach ($mahitaji as $hitaji) {
                    fputcsv($file, [
                        $hitaji->first_name,
                        $hitaji->middle_name,
                        $hitaji->last_name,
                        $hitaji->age,
                        $hitaji->gender == 'male' ? 'Mume' : 'Mke',
                        $hitaji->phone,
                        $hitaji->nida_number,
                        $hitaji->disability_type,
                        $hitaji->created_at->format('d/m/Y H:i')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error('Error exporting Mahitaji data: ' . $e->getMessage(), [
                'balozi_id' => $baloziId,
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo katika kuunda faili. Tafadhali jaribu tena.');
        }
    }

    /**
     * Get comprehensive statistics for MahitajiMaalumu
     */
    private function getMahitajiStats($mwenyekitiId)
    {
        return Cache::remember("mwenyekiti_{$mwenyekitiId}_mahitaji_stats", 600, function() use ($mwenyekitiId) {
            $baseQuery = MahitajiMaalumu::whereHas('createdBy', function($query) use ($mwenyekitiId) {
                $query->where('mwenyekiti_id', $mwenyekitiId)
                      ->where('is_active', true);
            });

            return [
                'total' => (clone $baseQuery)->count(),
                'male' => (clone $baseQuery)->where('gender', 'male')->count(),
                'female' => (clone $baseQuery)->where('gender', 'female')->count(),
                'this_month' => (clone $baseQuery)->whereMonth('created_at', now()->month)
                                                  ->whereYear('created_at', now()->year)
                                                  ->count(),
                'this_week' => (clone $baseQuery)->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ])->count(),
                'today' => (clone $baseQuery)->whereDate('created_at', today())->count(),
            ];
        });
    }

    /**
     * Get Mahitaji statistics for a specific Balozi (API endpoint)
     */
    public function getBaloziStats($baloziId)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Verify Balozi belongs to this Mwenyekiti
            $balozi = Balozi::where('id', $baloziId)
                ->where('mwenyekiti_id', $mwenyekitiId)
                ->where('is_active', true)
                ->firstOrFail();

            $baseQuery = MahitajiMaalumu::where('created_by', $baloziId);

            $stats = [
                'total' => (clone $baseQuery)->count(),
                'male' => (clone $baseQuery)->where('gender', 'male')->count(),
                'female' => (clone $baseQuery)->where('gender', 'female')->count(),
                'this_month' => (clone $baseQuery)->whereMonth('created_at', now()->month)
                                                  ->whereYear('created_at', now()->year)
                                                  ->count(),
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            Log::error('Error fetching Balozi Mahitaji stats: ' . $e->getMessage(), [
                'balozi_id' => $baloziId,
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return response()->json(['error' => 'Server error'], 500);
        }
    }

    /**
     * Get unique disability types for filtering (API endpoint)
     */
    public function getDisabilityTypes()
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $types = MahitajiMaalumu::whereHas('createdBy', function($query) use ($mwenyekitiId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId)
                          ->where('is_active', true);
                })
                ->whereNotNull('disability_type')
                ->distinct()
                ->pluck('disability_type')
                ->filter()
                ->values();

            return response()->json($types);

        } catch (\Exception $e) {
            Log::error('Error fetching disability types: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}