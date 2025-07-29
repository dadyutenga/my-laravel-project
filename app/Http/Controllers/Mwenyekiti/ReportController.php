<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Balozi;
use App\Models\Mtu;
use App\Models\Meeting;
use App\Models\MeetingRequest;
use App\Models\Tangazo;
use App\Models\Udhamini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:mwenyekiti');
    }

    /**
     * Display analytics dashboard with overview reports
     */
    public function index()
    {
        $mwenyekitiId = auth('mwenyekiti')->id();
        
        // Get date range from request or default to last 30 days
        $startDate = request('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = request('end_date', Carbon::now()->format('Y-m-d'));
        
        // Basic Statistics
        $totalBalozi = Balozi::where('mwenyekiti_id', $mwenyekitiId)->count();
        $totalWatu = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })->count();
        
        $totalMeetings = Meeting::where('mwenyekiti_id', $mwenyekitiId)->count();
        $totalMatangazo = Tangazo::where('mwenyekiti_id', $mwenyekitiId)->count();

        // Demographics Analysis
        $genderStats = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->select('gender', DB::raw('count(*) as count'))
        ->groupBy('gender')
        ->get()
        ->pluck('count', 'gender')
        ->toArray();

        // Age Group Analysis
        $ageGroups = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->whereNotNull('date_of_birth')
        ->get()
        ->groupBy(function($mtu) {
            $age = Carbon::parse($mtu->date_of_birth)->age;
            if ($age < 18) return 'Watoto';
            if ($age < 35) return 'Vijana';
            if ($age < 60) return 'Wazima';
            return 'Wazee';
        })
        ->map->count()
        ->toArray();

        // Registration Trends (Last 12 months)
        $registrationTrends = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
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
        $locationStats = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->whereNotNull('mtaa')
        ->select('mtaa', DB::raw('count(*) as count'))
        ->groupBy('mtaa')
        ->orderByDesc('count')
        ->limit(10)
        ->get();

        // Meeting Statistics
        $meetingStats = [
            'completed' => Meeting::where('mwenyekiti_id', $mwenyekitiId)
                ->where('status', 'completed')->count(),
            'upcoming' => Meeting::where('mwenyekiti_id', $mwenyekitiId)
                ->where('status', 'scheduled')
                ->where('date', '>', Carbon::now())->count(),
            'cancelled' => Meeting::where('mwenyekiti_id', $mwenyekitiId)
                ->where('status', 'cancelled')->count(),
        ];

        // Meeting Request Trends
        $meetingRequestStats = MeetingRequest::whereHas('meeting', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get()
        ->pluck('count', 'status')
        ->toArray();

        // Recent Activities (Last 30 days)
        $recentRegistrations = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->count();

        $recentMeetings = Meeting::where('mwenyekiti_id', $mwenyekitiId)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();

        // Growth Statistics
        $currentMonthRegistrations = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();

        $lastMonthRegistrations = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->whereMonth('created_at', Carbon::now()->subMonth()->month)
        ->whereYear('created_at', Carbon::now()->subMonth()->year)
        ->count();

        $growthPercentage = $lastMonthRegistrations > 0 
            ? round((($currentMonthRegistrations - $lastMonthRegistrations) / $lastMonthRegistrations) * 100, 1)
            : 0;

        // Service Requests Analysis
        $serviceRequests = Udhamini::whereHas('mtu.balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get()
        ->pluck('count', 'status')
        ->toArray();

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
        $mwenyekitiId = auth('mwenyekiti')->id();
        
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
                $data['genderByAge'] = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId, $baloziId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                    if ($baloziId) $query->where('id', $baloziId);
                })
                ->whereNotNull('date_of_birth')
                ->get()
                ->groupBy('gender')
                ->map(function($group) {
                    return $group->groupBy(function($mtu) {
                        $age = Carbon::parse($mtu->date_of_birth)->age;
                        if ($age < 18) return 'Watoto';
                        if ($age < 35) return 'Vijana';
                        if ($age < 60) return 'Wazima';
                        return 'Wazee';
                    })->map->count();
                });

                $data['locationDistribution'] = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId, $baloziId) {
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
                $data['dailyRegistrations'] = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId, $baloziId) {
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
                
                // Meeting trends
                $data['meetingTrends'] = Meeting::where('mwenyekiti_id', $mwenyekitiId)
                    ->whereBetween('date', [$startDate, $endDate])
                    ->select(
                        DB::raw('DATE_FORMAT(date, "%Y-%m") as month'),
                        'status',
                        DB::raw('count(*) as count')
                    )
                    ->groupBy('month', 'status')
                    ->orderBy('month')
                    ->get()
                    ->groupBy('month');

                // Meeting attendance
                $data['attendanceStats'] = Meeting::where('mwenyekiti_id', $mwenyekitiId)
                    ->whereBetween('date', [$startDate, $endDate])
                    ->whereNotNull('attendees_count')
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
                    ->with(['watu' => function($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    }])
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
                $data['serviceRequests'] = Udhamini::whereHas('mtu.balozi', function($query) use ($mwenyekitiId, $baloziId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                    if ($baloziId) $query->where('id', $baloziId);
                })
                ->whereBetween('created_at', [$startDate, $endDate])
                ->select('huduma_type', 'status', DB::raw('count(*) as count'))
                ->groupBy('huduma_type', 'status')
                ->get()
                ->groupBy('huduma_type');

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
        $mwenyekitiId = auth('mwenyekiti')->id();
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
                    
                    Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
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
                                $mtu->phone,
                                $mtu->mtaa,
                                $mtu->balozi->first_name . ' ' . $mtu->balozi->last_name,
                                $mtu->created_at->format('Y-m-d')
                            ]);
                        }
                    });
                    break;

                case 'meetings':
                    fputcsv($file, ['Jina la Mkutano', 'Tarehe', 'Muda', 'Mahali', 'Hali', 'Wahudhuriaji', 'Tarehe ya Kutengenezwa']);
                    
                    Meeting::where('mwenyekiti_id', $mwenyekitiId)
                        ->whereBetween('date', [$startDate, $endDate])
                        ->chunk(100, function($meetings) use ($file) {
                            foreach ($meetings as $meeting) {
                                fputcsv($file, [
                                    $meeting->title,
                                    $meeting->date,
                                    $meeting->time,
                                    $meeting->location,
                                    ucfirst($meeting->status),
                                    $meeting->attendees_count ?? 0,
                                    $meeting->created_at->format('Y-m-d')
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
        $mwenyekitiId = auth('mwenyekiti')->id();
        
        switch ($type) {
            case 'registration-trends':
                $data = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
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
                $data = Mtu::whereHas('balozi', function($query) use ($mwenyekitiId) {
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