<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\KayaMaskini;
use App\Models\Balozi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class KayaMAskiniFetchController extends Controller
{
    /**
     * Get the current Mwenyekiti's ID from session
     */
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    /**
     * Display a listing of Kaya Maskini records (VIEW ONLY)
     */
    public function index(Request $request)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Get all Balozi under this Mwenyekiti with KayaMaskini counts
            $balozis = Cache::remember("mwenyekiti_{$mwenyekitiId}_balozi_kaya_maskini", 300, function() use ($mwenyekitiId) {
                return Balozi::where('mwenyekiti_id', $mwenyekitiId)
                    ->where('is_active', true)
                    ->withCount(['kayaMaskini'])
                    ->orderBy('first_name')
                    ->get();
            });

            // Get selected Balozi if any
            $selectedBaloziId = $request->get('balozi_id');
            $selectedBalozi = null;
            $kayaMaskini = collect();

            if ($selectedBaloziId) {
                // Verify Balozi belongs to this Mwenyekiti
                $selectedBalozi = Balozi::where('id', $selectedBaloziId)
                    ->where('mwenyekiti_id', $mwenyekitiId)
                    ->where('is_active', true)
                    ->first();

                if ($selectedBalozi) {
                    // Get KayaMaskini records with pagination
                    $query = KayaMaskini::where('created_by', $selectedBaloziId)
                        ->with(['createdBy' => function($query) {
                            $query->select('id', 'first_name', 'middle_name', 'last_name', 'phone');
                        }]);

                    // Apply filters
                    if ($request->filled('search')) {
                        $search = $request->get('search');
                        $query->where(function($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                              ->orWhere('middle_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%")
                              ->orWhere('phone', 'like', "%{$search}%")
                              ->orWhere('street', 'like', "%{$search}%");
                        });
                    }

                    if ($request->filled('gender')) {
                        $query->where('gender', $request->get('gender'));
                    }

                    // Order by latest first
                    $kayaMaskini = $query->orderBy('created_at', 'desc')
                        ->paginate(15)
                        ->appends($request->query());
                }
            }

            // Get comprehensive statistics
            $stats = $this->getKayaMaskiniStats($mwenyekitiId);

            return view('Mwenyekiti.KayaMaskini.index', compact(
                'balozis',
                'selectedBalozi',
                'selectedBaloziId',
                'kayaMaskini',
                'stats'
            ));

        } catch (\Exception $e) {
            Log::error('Error fetching KayaMaskini index: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null,
                'balozi_id' => $selectedBaloziId ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Display specific KayaMaskini record (VIEW ONLY)
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
            $kayaMaskini = DB::transaction(function() use ($id, $mwenyekitiId) {
                return KayaMaskini::with(['createdBy' => function($query) {
                        $query->select('id', 'first_name', 'middle_name', 'last_name', 'phone', 'email', 'street_village', 'shina', 'shina_number');
                    }])
                    ->whereHas('createdBy', function($query) use ($mwenyekitiId) {
                        $query->where('mwenyekiti_id', $mwenyekitiId)
                              ->where('is_active', true);
                    })
                    ->findOrFail($id);
            });

            // Parse household members if it's JSON
            $householdMembers = [];
            if ($kayaMaskini->household_members) {
                $householdMembers = is_string($kayaMaskini->household_members) 
                    ? json_decode($kayaMaskini->household_members, true) ?? []
                    : $kayaMaskini->household_members;
            }

            return view('Mwenyekiti.KayaMaskini.show', compact('kayaMaskini', 'householdMembers'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('KayaMaskini not found or unauthorized access', [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId
            ]);

            return redirect()->route('mwenyekiti.kaya-maskini.index')
                ->with('error', 'Rekodi ya Kaya Maskini haipatikani au hauruhusiwi kuiona.');

        } catch (\Exception $e) {
            Log::error('Error fetching KayaMaskini details: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('mwenyekiti.kaya-maskini.index')
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Export KayaMaskini data for a specific Balozi
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

            // Get all KayaMaskini records for this Balozi
            $kayaMaskini = KayaMaskini::where('created_by', $baloziId)
                ->with('createdBy')
                ->orderBy('created_at', 'desc')
                ->get();

            $filename = 'kaya_maskini_' . str_replace(' ', '_', $balozi->first_name . '_' . $balozi->last_name) . '_' . date('Y-m-d') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($kayaMaskini) {
                $file = fopen('php://output', 'w');
                
                // CSV Headers
                fputcsv($file, [
                    'Jina la Kwanza',
                    'Jina la Kati',
                    'Jina la Mwisho',
                    'Jinsia',
                    'Mtaa',
                    'Simu',
                    'Maelezo',
                    'Idadi ya Watu Nyumbani',
                    'Tarehe ya Kuongezwa'
                ]);

                // CSV Data
                foreach ($kayaMaskini as $kaya) {
                    fputcsv($file, [
                        $kaya->first_name,
                        $kaya->middle_name,
                        $kaya->last_name,
                        $kaya->gender,
                        $kaya->street,
                        $kaya->phone,
                        $kaya->description,
                        $kaya->household_count,
                        $kaya->created_at->format('d/m/Y H:i')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error('Error exporting KayaMaskini data: ' . $e->getMessage(), [
                'balozi_id' => $baloziId,
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo katika kuunda faili. Tafadhali jaribu tena.');
        }
    }

    /**
     * Get comprehensive statistics for KayaMaskini
     */
    private function getKayaMaskiniStats($mwenyekitiId)
    {
        return Cache::remember("mwenyekiti_{$mwenyekitiId}_kaya_maskini_stats", 600, function() use ($mwenyekitiId) {
            $baseQuery = KayaMaskini::whereHas('createdBy', function($query) use ($mwenyekitiId) {
                $query->where('mwenyekiti_id', $mwenyekitiId)
                      ->where('is_active', true);
            });

            return [
                'total' => (clone $baseQuery)->count(),
                'male' => (clone $baseQuery)->where('gender', 'male')->count(),
                'female' => (clone $baseQuery)->where('gender', 'female')->count(),
                'total_household_members' => (clone $baseQuery)->sum('household_count'),
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
     * Get KayaMaskini statistics for a specific Balozi
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

            $baseQuery = KayaMaskini::where('created_by', $baloziId);

            $stats = [
                'total' => (clone $baseQuery)->count(),
                'male' => (clone $baseQuery)->where('gender', 'male')->count(),
                'female' => (clone $baseQuery)->where('gender', 'female')->count(),
                'total_household_members' => (clone $baseQuery)->sum('household_count'),
                'this_month' => (clone $baseQuery)->whereMonth('created_at', now()->month)
                                                  ->whereYear('created_at', now()->year)
                                                  ->count(),
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            Log::error('Error fetching Balozi KayaMaskini stats: ' . $e->getMessage(), [
                'balozi_id' => $baloziId,
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return response()->json(['error' => 'Server error'], 500);
        }
    }
}