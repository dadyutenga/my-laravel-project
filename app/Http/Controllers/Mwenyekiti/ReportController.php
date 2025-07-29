<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Balozi;
use App\Models\Watu;
use App\Models\MtaaMeeting;  // This is the correct model name
use App\Models\MtaaMeetingRequest;
use App\Models\Matangazo;
use App\Models\MatangazoYaKawaida;  // Added this model
use App\Models\Udhamini;
use App\Models\Service;  // Added this model
use App\Models\KayaMaskini;  // Added this model
use App\Models\MahitajiMaalumu;  // Added this model
use App\Models\Malalamiko;  // Added this model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    /**
     * Display analytics dashboard with overview reports
     */
    public function index()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        // Get date range from request or default to last 30 days
        $startDate = request('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = request('end_date', Carbon::now()->format('Y-m-d'));
        
        // Basic Statistics
        $totalBalozi = Balozi::where('mwenyekiti_id', $mwenyekitiId)->count();
        $totalWatu = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })->count();
        
        // Use MtaaMeeting instead of Meeting
        $totalMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)->count();
        
        // Use both Matangazo and MatangazoYaKawaida
        $totalMatangazo = Matangazo::where('created_by', $mwenyekitiId)->count() + 
                         MatangazoYaKawaida::where('created_by', $mwenyekitiId)->count();

        // Demographics Analysis
        $genderStats = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->select('gender', DB::raw('count(*) as count'))
        ->groupBy('gender')
        ->get()
        ->pluck('count', 'gender')
        ->toArray();

        // Age Group Analysis
        $ageGroups = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->whereNotNull('date_of_birth')
        ->get()
        ->groupBy(function($watu) {
            $age = Carbon::parse($watu->date_of_birth)->age;
            if ($age < 18) return 'Watoto';
            if ($age < 35) return 'Vijana';
            if ($age < 60) return 'Wazima';
            return 'Wazee';
        })
        ->map->count()
        ->toArray();

        // Registration Trends (Last 12 months)
        $registrationTrends = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->where('created_at', '>=', Carbon::now()->subMonths(12))
        ->select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

        // Balozi Performance
        $baloziPerformance = Balozi::where('mwenyekiti_id', $mwenyekitiId)
            ->withCount('watu')
            ->orderByDesc('watu_count')
            ->limit(10)
            ->get();

        // Location Distribution
        $locationStats = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->whereNotNull('mtaa')
        ->select('mtaa', DB::raw('count(*) as count'))
        ->groupBy('mtaa')
        ->orderByDesc('count')
        ->limit(10)
        ->get();

        // Meeting Statistics - Use MtaaMeeting model
        $meetingStats = [
            'completed' => MtaaMeeting::where('organizer_id', $mwenyekitiId)->count(),
            'upcoming' => MtaaMeeting::where('organizer_id', $mwenyekitiId)
                ->where('meeting_date', '>', Carbon::now())->count(),
            'cancelled' => 0, // ADD THIS LINE - since MtaaMeeting doesn't have status field
            'total' => MtaaMeeting::where('organizer_id', $mwenyekitiId)->count(),
        ];

        // Meeting Request Trends
        $meetingRequestStats = MtaaMeetingRequest::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get()
        ->pluck('count', 'status')
        ->toArray();

        // Recent Activities (Last 30 days)
        $recentRegistrations = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->count();

        $recentMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();

        // Growth Statistics
        $currentMonthRegistrations = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();

        $lastMonthRegistrations = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->whereMonth('created_at', Carbon::now()->subMonth()->month)
        ->whereYear('created_at', Carbon::now()->subMonth()->year)
        ->count();

        $growthPercentage = $lastMonthRegistrations > 0 
            ? round((($currentMonthRegistrations - $lastMonthRegistrations) / $lastMonthRegistrations) * 100, 1)
            : 0;

        // Service Requests Analysis - Use Service and Udhamini models
        $serviceRequestsCount = Service::whereHas('createdByBalozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })->count();

        $udhaminiCount = Udhamini::whereHas('watu.balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })->count();

        $serviceRequests = [
            'total' => $serviceRequestsCount + $udhaminiCount,
            'services' => $serviceRequestsCount,
            'udhamini' => $udhaminiCount,
            'approved' => $udhaminiCount, // Assuming all udhamini are processed
            'pending' => $serviceRequestsCount,
            'rejected' => 0
        ];

        return view('Mwenyekiti.Reports.index', compact(
            'totalBalozi',
            'totalWatu',
            'totalMeetings',
            'totalMatangazo',
            'genderStats',
            'ageGroups',
            'registrationTrends',
            'baloziPerformance',
            'locationStats',
            'meetingStats',
            'meetingRequestStats',
            'recentRegistrations',
            'recentMeetings',
            'growthPercentage',
            'serviceRequests',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Show detailed report for specific metric
     */
    public function show($type)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        // Get filters from request
        $startDate = request('start_date', Carbon::now()->subDays(30));
        $endDate = request('end_date', Carbon::now());
        $baloziId = request('balozi_id');

        $data = [];
        $title = '';
        $description = '';

        switch ($type) {
            case 'demographics':
                $title = 'Takwimu za Kijamii';
                $description = 'Uchambuzi wa makundi ya umri, jinsia na mahali';
                
                // Detailed demographics
                $data['genderByAge'] = Watu::whereHas('balozi', function($query) use ($mwenyekitiId, $baloziId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                    if ($baloziId) $query->where('id', $baloziId);
                })
                ->whereNotNull('date_of_birth')
                ->get()
                ->groupBy('gender')
                ->map(function($group) {
                    return $group->groupBy(function($watu) {
                        $age = Carbon::parse($watu->date_of_birth)->age;
                        if ($age < 18) return 'Watoto';
                        if ($age < 35) return 'Vijana';
                        if ($age < 60) return 'Wazima';
                        return 'Wazee';
                    })->map->count();
                });

                $data['locationDistribution'] = Watu::whereHas('balozi', function($query) use ($mwenyekitiId, $baloziId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                    if ($baloziId) $query->where('id', $baloziId);
                })
                ->select('mtaa', 'gender', DB::raw('count(*) as count'))
                ->whereNotNull('mtaa')
                ->groupBy('mtaa', 'gender')
                ->get()
                ->groupBy('mtaa');

                break;

            case 'registrations':
                $title = 'Ripoti ya Usajili';
                $description = 'Mwelekeo wa usajili wa watu wapya';
                
                // Daily registrations
                $data['dailyRegistrations'] = Watu::whereHas('balozi', function($query) use ($mwenyekitiId, $baloziId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                    if ($baloziId) $query->where('id', $baloziId);
                })
                ->whereBetween('created_at', [$startDate, $endDate])
                ->select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('count(*) as count')
                )
                ->groupBy('date')
                ->orderBy('date')
                ->get();

                // Registration by Balozi
                $data['registrationsByBalozi'] = Balozi::where('mwenyekiti_id', $mwenyekitiId)
                    ->when($baloziId, function($query) use ($baloziId) {
                        return $query->where('id', $baloziId);
                    })
                    ->withCount(['watu' => function($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    }])
                    ->get();

                break;

            case 'meetings':
                $title = 'Ripoti ya Mikutano';
                $description = 'Takwimu za mikutano na mahudhurio';
                
                // Meeting trends - Use MtaaMeeting
                $data['meetingTrends'] = MtaaMeeting::where('organizer_id', $mwenyekitiId)
                    ->whereBetween('meeting_date', [$startDate, $endDate])
                    ->select(
                        DB::raw('DATE_FORMAT(meeting_date, "%Y-%m") as month'),
                        DB::raw('count(*) as count')
                    )
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get()
                    ->mapWithKeys(function($item) {
                        return [$item->month => collect([
                            (object)['status' => 'completed', 'count' => $item->count]
                        ])];
                    });

                // Meeting list
                $data['meetingsList'] = MtaaMeeting::where('organizer_id', $mwenyekitiId)
                    ->whereBetween('meeting_date', [$startDate, $endDate])
                    ->get();

                break;

            case 'balozi-performance':
                $title = 'Utendaji wa Balozi';
                $description = 'Uchambuzi wa kazi za Balozi';
                
                // Balozi performance metrics
                $data['baloziMetrics'] = Balozi::where('mwenyekiti_id', $mwenyekitiId)
                    ->when($baloziId, function($query) use ($baloziId) {
                        return $query->where('id', $baloziId);
                    })
                    ->withCount([
                        'watu as total_watu',
                        'watu as new_registrations' => function($query) use ($startDate, $endDate) {
                            $query->whereBetween('created_at', [$startDate, $endDate]);
                        }
                    ])
                    ->get();

                break;

            case 'services':
                $title = 'Ripoti ya Huduma';
                $description = 'Takwimu za maombi ya huduma na udhamini';
                
                // Service request trends
                $serviceData = Service::whereHas('createdByBalozi', function($query) use ($mwenyekitiId, $baloziId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                    if ($baloziId) $query->where('id', $baloziId);
                })
                ->whereBetween('created_at', [$startDate, $endDate])
                ->select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();

                $udhaminiData = Udhamini::whereHas('watu.balozi', function($query) use ($mwenyekitiId, $baloziId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                    if ($baloziId) $query->where('id', $baloziId);
                })
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

                $data['serviceRequests'] = collect([
                    'services' => $serviceData,
                    'udhamini' => collect([
                        (object)['status' => 'approved', 'count' => $udhaminiData]
                    ])
                ]);

                break;

            default:
                abort(404);
        }

        // Get available Balozi for filter
        $balozis = Balozi::where('mwenyekiti_id', $mwenyekitiId)->get();

        return view('Mwenyekiti.Reports.show', compact(
            'type',
            'title',
            'description',
            'data',
            'balozis',
            'startDate',
            'endDate',
            'baloziId'
        ));
    }

    /**
     * Export report data as CSV
     */
    public function export($type)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        $startDate = request('start_date', Carbon::now()->subDays(30));
        $endDate = request('end_date', Carbon::now());

        $filename = "ripoti_{$type}_" . Carbon::now()->format('Y-m-d') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($type, $mwenyekitiId, $startDate, $endDate) {
            $file = fopen('php://output', 'w');
            
            switch ($type) {
                case 'watu':
                    fputcsv($file, ['Jina la Kwanza', 'Jina la Kati', 'Jina la Mwisho', 'Jinsia', 'Umri', 'Simu', 'Mtaa', 'Balozi', 'Tarehe ya Usajili']);
                    
                    Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
                        $query->where('mwenyekiti_id', $mwenyekitiId);
                    })
                    ->with('balozi')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->chunk(100, function($watu) use ($file) {
                        foreach ($watu as $mtu) {
                            $age = $mtu->date_of_birth ? Carbon::parse($mtu->date_of_birth)->age : 'N/A';
                            fputcsv($file, [
                                $mtu->first_name,
                                $mtu->middle_name,
                                $mtu->last_name,
                                $mtu->gender == 'male' ? 'Mume' : 'Mke',
                                $age,
                                $mtu->phone_number,
                                $mtu->mtaa,
                                ($mtu->balozi ? $mtu->balozi->first_name . ' ' . $mtu->balozi->last_name : 'N/A'),
                                $mtu->created_at->format('Y-m-d')
                            ]);
                        }
                    });
                    break;

                case 'meetings':
                    fputcsv($file, ['Jina la Mkutano', 'Tarehe', 'Mtaa', 'Mpangaji', 'Tarehe ya Kutengenezwa']);
                    
                    MtaaMeeting::where('organizer_id', $mwenyekitiId)
                        ->whereBetween('meeting_date', [$startDate, $endDate])
                        ->with('organizer')
                        ->chunk(100, function($meetings) use ($file) {
                            foreach ($meetings as $meeting) {
                                fputcsv($file, [
                                    $meeting->title,
                                    $meeting->meeting_date,
                                    $meeting->mtaa,
                                    ($meeting->organizer ? $meeting->organizer->first_name . ' ' . $meeting->organizer->last_name : 'N/A'),
                                    $meeting->created_at->format('Y-m-d')
                                ]);
                            }
                        });
                    break;

                case 'services':
                    fputcsv($file, ['Aina ya Huduma', 'Jina la Ombi', 'Hali', 'Mtaa', 'Tarehe']);
                    
                    Service::whereHas('createdByBalozi', function($query) use ($mwenyekitiId) {
                        $query->where('mwenyekiti_id', $mwenyekitiId);
                    })
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->chunk(100, function($services) use ($file) {
                        foreach ($services as $service) {
                            fputcsv($file, [
                                'Huduma za Kijamii',
                                $service->title,
                                ucfirst($service->status),
                                $service->mtaa,
                                $service->created_at->format('Y-m-d')
                            ]);
                        }
                    });

                    // Add Udhamini records
                    Udhamini::whereHas('watu.balozi', function($query) use ($mwenyekitiId) {
                        $query->where('mwenyekiti_id', $mwenyekitiId);
                    })
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->with('watu')
                    ->chunk(100, function($udhaminis) use ($file) {
                        foreach ($udhaminis as $udhamini) {
                            fputcsv($file, [
                                'Udhamini',
                                $udhamini->sababu,
                                'Yamekamilika',
                                $udhamini->watu->mtaa ?? 'N/A',
                                $udhamini->created_at->format('Y-m-d')
                            ]);
                        }
                    });
                    break;
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get chart data for AJAX requests
     */
    public function chartData($type)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        switch ($type) {
            case 'registration-trends':
                $data = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                })
                ->where('created_at', '>=', Carbon::now()->subMonths(6))
                ->select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('count(*) as count')
                )
                ->groupBy('month')
                ->orderBy('month')
                ->get();
                break;

            case 'gender-distribution':
                $data = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                })
                ->select('gender', DB::raw('count(*) as count'))
                ->groupBy('gender')
                ->get();
                break;

            default:
                $data = [];
        }

        return response()->json($data);
    }
}