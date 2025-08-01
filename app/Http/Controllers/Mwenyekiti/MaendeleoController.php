<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\MaendeleoYaSiku;
use App\Models\Balozi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class MaendeleoController extends Controller
{
    /**
     * Get the current Mwenyekiti's ID from session
     */
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    /**
     * Display a listing of Maendeleo ya Siku records
     */
    public function index(Request $request)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Get all Balozi under this Mwenyekiti with MaendeleoYaSiku counts
            $balozis = Cache::remember("mwenyekiti_{$mwenyekitiId}_balozi_maendeleo", 300, function() use ($mwenyekitiId) {
                return Balozi::where('mwenyekiti_id', $mwenyekitiId)
                    ->where('is_active', true)
                    ->withCount(['maendeleoYaSiku'])
                    ->orderBy('first_name')
                    ->get();
            });

            // Get selected filters
            $selectedBaloziId = $request->get('balozi_id');
            $selectedDate = $request->get('tarehe');
            $viewType = $request->get('view_type', 'mine'); // 'mine' or 'balozi'
            
            $selectedBalozi = null;
            $maendeleo = collect();

            // Handle different view types
            if ($viewType === 'mine') {
                // Show Mwenyekiti's own records
                $query = MaendeleoYaSiku::where('created_by', $mwenyekitiId);

                // Apply date filter
                if ($selectedDate) {
                    $query->whereDate('tarehe', $selectedDate);
                }

                // Apply search filter
                if ($request->filled('search')) {
                    $search = $request->get('search');
                    $query->where(function($q) use ($search) {
                        $q->where('maelezo', 'like', "%{$search}%")
                          ->orWhere('maoni', 'like', "%{$search}%");
                    });
                }

                $maendeleo = $query->orderBy('tarehe', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(15)
                    ->appends($request->query());

            } elseif ($viewType === 'balozi' && $selectedBaloziId) {
                // Show selected Balozi's records
                $selectedBalozi = Balozi::where('id', $selectedBaloziId)
                    ->where('mwenyekiti_id', $mwenyekitiId)
                    ->where('is_active', true)
                    ->first();

                if ($selectedBalozi) {
                    $query = MaendeleoYaSiku::where('created_by', $selectedBaloziId)
                        ->with(['createdBy' => function($query) {
                            $query->select('id', 'first_name', 'middle_name', 'last_name', 'phone');
                        }]);

                    // Apply date filter
                    if ($selectedDate) {
                        $query->whereDate('tarehe', $selectedDate);
                    }

                    // Apply search filter
                    if ($request->filled('search')) {
                        $search = $request->get('search');
                        $query->where(function($q) use ($search) {
                            $q->where('maelezo', 'like', "%{$search}%")
                              ->orWhere('maoni', 'like', "%{$search}%");
                        });
                    }

                    $maendeleo = $query->orderBy('tarehe', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15)
                        ->appends($request->query());
                }
            }

            // Get comprehensive statistics
            $stats = $this->getMaendeleoStats($mwenyekitiId);

            return view('Mwenyekiti.Maendeleo.index', compact(
                'balozis',
                'selectedBalozi',
                'selectedBaloziId',
                'selectedDate',
                'viewType',
                'maendeleo',
                'stats'
            ));

        } catch (\Exception $e) {
            Log::error('Error fetching Maendeleo index: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null,
                'balozi_id' => $selectedBaloziId ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Show the form for creating a new Maendeleo ya Siku record
     */
    public function create()
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            return view('Mwenyekiti.Maendeleo.create');

        } catch (\Exception $e) {
            Log::error('Error showing Maendeleo create form: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Store a newly created Maendeleo ya Siku record
     */
    public function store(Request $request)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Validate the request
            $validated = $request->validate([
                'tarehe' => 'required|date|before_or_equal:today',
                'maelezo' => 'required|string|min:10|max:1000',
                'maoni' => 'nullable|string|max:500',
            ], [
                'tarehe.required' => 'Tarehe ni lazima',
                'tarehe.date' => 'Tarehe si sahihi',
                'tarehe.before_or_equal' => 'Tarehe haiwezi kuwa ya baadaye',
                'maelezo.required' => 'Maelezo ni lazima',
                'maelezo.min' => 'Maelezo yanahitaji angalau herufi 10',
                'maelezo.max' => 'Maelezo yasipungue herufi 1000',
                'maoni.max' => 'Maoni yasipungue herufi 500',
            ]);

            // Check if record already exists for this date
            $existingRecord = MaendeleoYaSiku::where('created_by', $mwenyekitiId)
                ->whereDate('tarehe', $validated['tarehe'])
                ->first();

            if ($existingRecord) {
                throw ValidationException::withMessages([
                    'tarehe' => 'Tayari umeshaweka maendeleo ya tarehe hii. Badilisha au funga rekodi iliyopo.'
                ]);
            }

            // Create the record using transaction for data integrity
            $maendeleo = DB::transaction(function() use ($validated, $mwenyekitiId) {
                return MaendeleoYaSiku::create([
                    'tarehe' => $validated['tarehe'],
                    'maelezo' => trim($validated['maelezo']),
                    'maoni' => $validated['maoni'] ? trim($validated['maoni']) : null,
                    'created_by' => $mwenyekitiId,
                ]);
            });

            // Clear cache
            Cache::forget("mwenyekiti_{$mwenyekitiId}_maendeleo_stats");

            Log::info('Maendeleo ya Siku created successfully', [
                'id' => $maendeleo->id,
                'mwenyekiti_id' => $mwenyekitiId,
                'tarehe' => $validated['tarehe']
            ]);

            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('success', 'Maendeleo ya siku yamehifadhiwa kikamilifu!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error creating Maendeleo ya Siku: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.')
                ->withInput();
        }
    }

    /**
     * Display the specified Maendeleo ya Siku record
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
            $maendeleo = DB::transaction(function() use ($id, $mwenyekitiId) {
                return MaendeleoYaSiku::with(['createdBy' => function($query) {
                        $query->select('id', 'first_name', 'middle_name', 'last_name', 'phone', 'email', 'street_village', 'shina', 'shina_number');
                    }])
                    ->where(function($query) use ($mwenyekitiId) {
                        // Can view own records or records from their Balozi
                        $query->where('created_by', $mwenyekitiId)
                              ->orWhereHas('createdBy', function($subQuery) use ($mwenyekitiId) {
                                  $subQuery->where('mwenyekiti_id', $mwenyekitiId)
                                           ->where('is_active', true);
                              });
                    })
                    ->findOrFail($id);
            });

            return view('Mwenyekiti.Maendeleo.show', compact('maendeleo'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Maendeleo not found or unauthorized access', [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId
            ]);

            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('error', 'Rekodi ya Maendeleo haipatikani au hauruhusiwi kuiona.');

        } catch (\Exception $e) {
            Log::error('Error fetching Maendeleo details: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Show the form for editing the specified Maendeleo ya Siku record (own records only)
     */
    public function edit($id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Only allow editing own records
            $maendeleo = MaendeleoYaSiku::where('id', $id)
                ->where('created_by', $mwenyekitiId)
                ->firstOrFail();

            return view('Mwenyekiti.Maendeleo.edit', compact('maendeleo'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Maendeleo not found for editing', [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId
            ]);

            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('error', 'Rekodi ya Maendeleo haipatikani au hauruhusiwi kuihariri.');

        } catch (\Exception $e) {
            Log::error('Error showing Maendeleo edit form: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId
            ]);

            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Update the specified Maendeleo ya Siku record (own records only)
     */
    public function update(Request $request, $id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Only allow updating own records
            $maendeleo = MaendeleoYaSiku::where('id', $id)
                ->where('created_by', $mwenyekitiId)
                ->firstOrFail();

            // Validate the request
            $validated = $request->validate([
                'tarehe' => 'required|date|before_or_equal:today',
                'maelezo' => 'required|string|min:10|max:1000',
                'maoni' => 'nullable|string|max:500',
            ], [
                'tarehe.required' => 'Tarehe ni lazima',
                'tarehe.date' => 'Tarehe si sahihi',
                'tarehe.before_or_equal' => 'Tarehe haiwezi kuwa ya baadaye',
                'maelezo.required' => 'Maelezo ni lazima',
                'maelezo.min' => 'Maelezo yanahitaji angalau herufi 10',
                'maelezo.max' => 'Maelezo yasipungue herufi 1000',
                'maoni.max' => 'Maoni yasipungue herufi 500',
            ]);

            // Check if another record exists for this date (excluding current record)
            $existingRecord = MaendeleoYaSiku::where('created_by', $mwenyekitiId)
                ->whereDate('tarehe', $validated['tarehe'])
                ->where('id', '!=', $id)
                ->first();

            if ($existingRecord) {
                throw ValidationException::withMessages([
                    'tarehe' => 'Tayari kuna rekodi ya maendeleo ya tarehe hii. Chagua tarehe nyingine.'
                ]);
            }

            // Update the record using transaction
            DB::transaction(function() use ($maendeleo, $validated) {
                $maendeleo->update([
                    'tarehe' => $validated['tarehe'],
                    'maelezo' => trim($validated['maelezo']),
                    'maoni' => $validated['maoni'] ? trim($validated['maoni']) : null,
                ]);
            });

            // Clear cache
            Cache::forget("mwenyekiti_{$mwenyekitiId}_maendeleo_stats");

            Log::info('Maendeleo ya Siku updated successfully', [
                'id' => $maendeleo->id,
                'mwenyekiti_id' => $mwenyekitiId,
                'tarehe' => $validated['tarehe']
            ]);

            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('success', 'Maendeleo ya siku yamebadilishwa kikamilifu!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('error', 'Rekodi ya Maendeleo haipatikani au hauruhusiwi kuihariri.');

        } catch (\Exception $e) {
            Log::error('Error updating Maendeleo ya Siku: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.')
                ->withInput();
        }
    }

    /**
     * Remove the specified Maendeleo ya Siku record (own records only)
     */
    public function destroy($id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Only allow deleting own records
            $maendeleo = MaendeleoYaSiku::where('id', $id)
                ->where('created_by', $mwenyekitiId)
                ->firstOrFail();

            // Delete using transaction
            DB::transaction(function() use ($maendeleo) {
                $maendeleo->delete();
            });

            // Clear cache
            Cache::forget("mwenyekiti_{$mwenyekitiId}_maendeleo_stats");

            Log::info('Maendeleo ya Siku deleted successfully', [
                'id' => $maendeleo->id,
                'mwenyekiti_id' => $mwenyekitiId,
                'tarehe' => $maendeleo->tarehe
            ]);

            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('success', 'Rekodi ya maendeleo imefutwa kikamilifu!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('mwenyekiti.maendeleo.index')
                ->with('error', 'Rekodi ya Maendeleo haipatikani au hauruhusiwi kuifuta.');

        } catch (\Exception $e) {
            Log::error('Error deleting Maendeleo ya Siku: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Export Maendeleo data for a specific Balozi or own records
     */
    public function export(Request $request)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $viewType = $request->get('view_type', 'mine');
            $baloziId = $request->get('balozi_id');
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date', now()->toDateString());

            $query = MaendeleoYaSiku::query();

            if ($viewType === 'mine') {
                $query->where('created_by', $mwenyekitiId);
                $filename = 'maendeleo_mwenyekiti_' . date('Y-m-d') . '.csv';
            } elseif ($viewType === 'balozi' && $baloziId) {
                // Verify Balozi belongs to this Mwenyekiti
                $balozi = Balozi::where('id', $baloziId)
                    ->where('mwenyekiti_id', $mwenyekitiId)
                    ->where('is_active', true)
                    ->firstOrFail();

                $query->where('created_by', $baloziId);
                $filename = 'maendeleo_' . str_replace(' ', '_', $balozi->first_name . '_' . $balozi->last_name) . '_' . date('Y-m-d') . '.csv';
            } else {
                return redirect()->back()->with('error', 'Chagua aina ya data ya kuexport');
            }

            // Apply date filters
            if ($startDate) {
                $query->whereDate('tarehe', '>=', $startDate);
            }
            if ($endDate) {
                $query->whereDate('tarehe', '<=', $endDate);
            }

            $maendeleo = $query->with('createdBy')
                ->orderBy('tarehe', 'desc')
                ->get();

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($maendeleo) {
                $file = fopen('php://output', 'w');
                
                // CSV Headers
                fputcsv($file, [
                    'Tarehe',
                    'Maelezo',
                    'Maoni',
                    'Ameongezwa na',
                    'Tarehe ya Kuongeza'
                ]);

                // CSV Data
                foreach ($maendeleo as $record) {
                    fputcsv($file, [
                        $record->tarehe->format('d/m/Y'),
                        $record->maelezo,
                        $record->maoni ?: '-',
                        $record->createdBy ? ($record->createdBy->first_name . ' ' . $record->createdBy->last_name) : 'Mwenyekiti',
                        $record->created_at->format('d/m/Y H:i')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error('Error exporting Maendeleo data: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null,
                'view_type' => $viewType ?? null,
                'balozi_id' => $baloziId ?? null
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo katika kuunda faili. Tafadhali jaribu tena.');
        }
    }

    /**
     * Get comprehensive statistics for Maendeleo ya Siku
     */
    private function getMaendeleoStats($mwenyekitiId)
    {
        return Cache::remember("mwenyekiti_{$mwenyekitiId}_maendeleo_stats", 600, function() use ($mwenyekitiId) {
            // Own records stats
            $ownQuery = MaendeleoYaSiku::where('created_by', $mwenyekitiId);
            
            // Balozi records stats
            $baloziQuery = MaendeleoYaSiku::whereHas('createdBy', function($query) use ($mwenyekitiId) {
                $query->where('mwenyekiti_id', $mwenyekitiId)
                      ->where('is_active', true);
            });

            return [
                'own_total' => (clone $ownQuery)->count(),
                'own_this_month' => (clone $ownQuery)->whereMonth('tarehe', now()->month)
                                                    ->whereYear('tarehe', now()->year)
                                                    ->count(),
                'own_this_week' => (clone $ownQuery)->whereBetween('tarehe', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString()
                ])->count(),
                'balozi_total' => (clone $baloziQuery)->count(),
                'balozi_this_month' => (clone $baloziQuery)->whereMonth('tarehe', now()->month)
                                                          ->whereYear('tarehe', now()->year)
                                                          ->count(),
                'total_all' => (clone $ownQuery)->count() + (clone $baloziQuery)->count(),
            ];
        });
    }

    /**
     * Get Maendeleo statistics for a specific Balozi (API endpoint)
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

            $baseQuery = MaendeleoYaSiku::where('created_by', $baloziId);

            $stats = [
                'total' => (clone $baseQuery)->count(),
                'this_month' => (clone $baseQuery)->whereMonth('tarehe', now()->month)
                                                  ->whereYear('tarehe', now()->year)
                                                  ->count(),
                'this_week' => (clone $baseQuery)->whereBetween('tarehe', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString()
                ])->count(),
                'today' => (clone $baseQuery)->whereDate('tarehe', today())->count(),
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            Log::error('Error fetching Balozi Maendeleo stats: ' . $e->getMessage(), [
                'balozi_id' => $baloziId,
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return response()->json(['error' => 'Server error'], 500);
        }
    }
}