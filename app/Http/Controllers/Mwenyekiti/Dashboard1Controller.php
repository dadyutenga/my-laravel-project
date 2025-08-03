<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Watu;
use App\Models\Balozi;
use App\Models\BaloziAuth;
use App\Models\MtaaMeeting;
use App\Models\MtaaMeetingRequest;
use App\Models\MatangazoYaKawaida;
use App\Models\Matangazo;
use App\Models\Udhamini;
use App\Models\MahitajiMaalumu;
use App\Models\KayaMaskini;
use App\Models\Malalamiko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Dashboard1Controller extends Controller
{
    protected function getMwenyekitiId()
    {
        $mwenyekitiId = session('mwenyekiti_id');
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }
        
        return $mwenyekitiId;
    }

    public function index()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        // Get all statistics - ONLY for this Mwenyekiti's Balozi
        $stats = $this->getOverviewStats($mwenyekitiId);
        $charts = $this->getChartData($mwenyekitiId);
        $recentActivities = $this->getRecentActivities($mwenyekitiId);
        $quickActions = $this->getQuickActions($mwenyekitiId);

        return view('Mwenyekiti.dashboard', compact('stats', 'charts', 'recentActivities', 'quickActions'));
    }

    private function getOverviewStats($mwenyekitiId)
    {
        // Get ONLY Balozi under this specific Mwenyekiti
        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');

        // If no Balozi found, return zeros
        if ($baloziIds->isEmpty()) {
            return [
                'totalWatu' => 0,
                'newWatuThisMonth' => 0,
                'totalBalozi' => 0,
                'activeBaloziThisMonth' => 0,
                'totalMeetings' => 0,
                'upcomingMeetings' => 0,
                'pendingMeetingRequests' => 0,
                'totalAnnouncements' => 0,
                'activeAnnouncements' => 0,
                'totalUdhamini' => 0,
                'udhaminiThisMonth' => 0,
                'totalMahitajiMaalumu' => 0,
                'totalKayaMaskini' => 0,
                'totalMalalamiko' => 0,
                'pendingMalalamiko' => 0,
            ];
        }

        // WATU: Only people registered by THIS Mwenyekiti's Balozi
        $totalWatu = Watu::whereIn('created_by', $baloziIds)->count();
        $newWatuThisMonth = Watu::whereIn('created_by', $baloziIds)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // BALOZI: Only THIS Mwenyekiti's Balozi
        $totalBalozi = $baloziIds->count();
        
        // Active Balozi: Those who registered people recently OR are marked active
        $activeBaloziThisMonth = Balozi::where('mwenyekiti_id', $mwenyekitiId)
            ->where(function($query) {
                $query->whereHas('watu', function($subQuery) {
                    $subQuery->where('created_at', '>=', now()->subMonth());
                })->orWhere('is_active', true);
            })
            ->count();

        // MEETINGS: Only meetings organized by THIS Mwenyekiti
        $totalMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)->count();
        $upcomingMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->where('meeting_date', '>', now())
            ->whereNull('outcome')
            ->count();

        // MEETING REQUESTS: Only from THIS Mwenyekiti's Balozi
        $pendingMeetingRequests = MtaaMeetingRequest::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })->where('status', 'pending')->count();

        // ANNOUNCEMENTS: Only created by THIS Mwenyekiti
        $totalAnnouncements = MatangazoYaKawaida::where('created_by', $mwenyekitiId)->count() +
                             Matangazo::where('created_by', $mwenyekitiId)->count();
        
        $activeAnnouncements = MatangazoYaKawaida::where('created_by', $mwenyekitiId)
            ->where('effective_date', '<=', now())
            ->where(function($query) {
                $query->whereNull('expiry_date')
                      ->orWhere('expiry_date', '>=', now());
            })->count();

        // UDHAMINI: Only created by THIS Mwenyekiti
        $totalUdhamini = Udhamini::where('created_by', $mwenyekitiId)->count();
        $udhaminiThisMonth = Udhamini::where('created_by', $mwenyekitiId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // SPECIAL NEEDS: Only by THIS Mwenyekiti's Balozi
        $totalMahitajiMaalumu = MahitajiMaalumu::whereIn('created_by', $baloziIds)->count();
        
        // POOR FAMILIES: Only by THIS Mwenyekiti's Balozi
        $totalKayaMaskini = KayaMaskini::whereIn('created_by', $baloziIds)->count();

        // COMPLAINTS: Only by THIS Mwenyekiti's Balozi
        $totalMalalamiko = Malalamiko::whereIn('created_by', $baloziIds)->count();
        $pendingMalalamiko = Malalamiko::whereIn('created_by', $baloziIds)
            ->where('status', 'pending')->count();

        return [
            'totalWatu' => $totalWatu,
            'newWatuThisMonth' => $newWatuThisMonth,
            'totalBalozi' => $totalBalozi,
            'activeBaloziThisMonth' => $activeBaloziThisMonth,
            'totalMeetings' => $totalMeetings,
            'upcomingMeetings' => $upcomingMeetings,
            'pendingMeetingRequests' => $pendingMeetingRequests,
            'totalAnnouncements' => $totalAnnouncements,
            'activeAnnouncements' => $activeAnnouncements,
            'totalUdhamini' => $totalUdhamini,
            'udhaminiThisMonth' => $udhaminiThisMonth,
            'totalMahitajiMaalumu' => $totalMahitajiMaalumu,
            'totalKayaMaskini' => $totalKayaMaskini,
            'totalMalalamiko' => $totalMalalamiko,
            'pendingMalalamiko' => $pendingMalalamiko,
        ];
    }

    private function getChartData($mwenyekitiId)
    {
        // Get ONLY this Mwenyekiti's Balozi IDs
        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');

        // If no Balozi, return empty data
        if ($baloziIds->isEmpty()) {
            return [
                'monthlyWatu' => [],
                'monthlyMeetings' => [],
                'monthlyComplaints' => [],
                'genderDistribution' => [],
                'ageGroups' => [],
            ];
        }

        // Monthly trends - ONLY for this Mwenyekiti's area
        $monthlyWatu = [];
        $monthlyMeetings = [];
        $monthlyComplaints = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('M Y');
            
            // Only Watu registered by THIS Mwenyekiti's Balozi
            $monthlyWatu[] = [
                'month' => $monthKey,
                'count' => Watu::whereIn('created_by', $baloziIds)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count()
            ];

            // Only meetings by THIS Mwenyekiti
            $monthlyMeetings[] = [
                'month' => $monthKey,
                'count' => MtaaMeeting::where('organizer_id', $mwenyekitiId)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count()
            ];

            // Only complaints from THIS Mwenyekiti's Balozi
            $monthlyComplaints[] = [
                'month' => $monthKey,
                'count' => Malalamiko::whereIn('created_by', $baloziIds)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count()
            ];
        }

        // Gender distribution - ONLY from this Mwenyekiti's Balozi
        $genderDistribution = Watu::whereIn('created_by', $baloziIds)
            ->select('gender', DB::raw('count(*) as count'))
            ->groupBy('gender')
            ->get()
            ->map(function($item) {
                return [
                    'gender' => ucfirst($item->gender ?: 'Unknown'),
                    'count' => $item->count
                ];
            });

        // Age groups - ONLY from this Mwenyekiti's Balozi
        $ageGroups = Watu::whereIn('created_by', $baloziIds)
            ->whereNotNull('date_of_birth')
            ->get()
            ->groupBy(function($person) {
                $age = Carbon::parse($person->date_of_birth)->age;
                if ($age < 18) return '0-17';
                if ($age < 35) return '18-34';
                if ($age < 50) return '35-49';
                if ($age < 65) return '50-64';
                return '65+';
            })
            ->map(function($group, $key) {
                return [
                    'age_group' => $key,
                    'count' => $group->count()
                ];
            })->values();

        return [
            'monthlyWatu' => $monthlyWatu,
            'monthlyMeetings' => $monthlyMeetings,
            'monthlyComplaints' => $monthlyComplaints,
            'genderDistribution' => $genderDistribution,
            'ageGroups' => $ageGroups,
        ];
    }

    private function getRecentActivities($mwenyekitiId)
    {
        // Get ONLY this Mwenyekiti's Balozi IDs
        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');
        $activities = collect();

        // Recent Watu registrations - ONLY by this Mwenyekiti's Balozi
        $recentWatu = Watu::whereIn('created_by', $baloziIds)
            ->with(['balozi' => function($query) {
                $query->select('id', 'first_name', 'last_name');
            }])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($watu) {
                return [
                    'type' => 'watu_registration',
                    'title' => "New person registered: {$watu->first_name} {$watu->last_name}",
                    'description' => "Registered by " . ($watu->balozi->first_name ?? 'Unknown') . " " . ($watu->balozi->last_name ?? ''),
                    'time' => $watu->created_at,
                    'icon' => 'fas fa-user-plus',
                    'color' => 'success'
                ];
            });

        // Recent meetings - ONLY by this Mwenyekiti
        $recentMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->latest()
            ->take(3)
            ->get()
            ->map(function($meeting) {
                return [
                    'type' => 'meeting',
                    'title' => $meeting->title,
                    'description' => "Meeting scheduled for " . Carbon::parse($meeting->meeting_date)->format('M d, Y'),
                    'time' => $meeting->created_at,
                    'icon' => 'fas fa-calendar',
                    'color' => 'primary'
                ];
            });

        // Recent meeting requests - ONLY from this Mwenyekiti's Balozi
        $recentRequests = MtaaMeetingRequest::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->with(['balozi' => function($query) {
            $query->select('id', 'first_name', 'last_name');
        }])
        ->latest()
        ->take(3)
        ->get()
        ->map(function($request) {
            return [
                'type' => 'meeting_request',
                'title' => $request->title,
                'description' => "Request from " . ($request->balozi->first_name ?? '') . " " . ($request->balozi->last_name ?? ''),
                'time' => $request->created_at,
                'icon' => 'fas fa-calendar-check',
                'color' => $request->status === 'pending' ? 'warning' : ($request->status === 'approved' ? 'success' : 'danger')
            ];
        });

        // Recent announcements - ONLY by this Mwenyekiti
        $recentAnnouncements = Matangazoyakawaida::where('created_by', $mwenyekitiId)
            ->latest()
            ->take(3)
            ->get()
            ->map(function($announcement) {
                return [
                    'type' => 'announcement',
                    'title' => $announcement->title,
                    'description' => "General announcement - " . $announcement->category,
                    'time' => $announcement->created_at,
                    'icon' => 'fas fa-bullhorn',
                    'color' => 'info'
                ];
            });

        return $activities
            ->merge($recentWatu)
            ->merge($recentMeetings)
            ->merge($recentRequests)
            ->merge($recentAnnouncements)
            ->sortByDesc('time')
            ->take(10)
            ->values();
    }

    private function getQuickActions($mwenyekitiId)
    {
        // Get pending requests count - ONLY from this Mwenyekiti's Balozi
        $pendingRequestsCount = MtaaMeetingRequest::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })->where('status', 'pending')->count();

        return [
            [
                'title' => 'Schedule Meeting',
                'description' => 'Create a new community meeting',
                'route' => 'mwenyekiti.meetings.create',
                'icon' => 'fas fa-calendar-plus',
                'color' => 'primary'
            ],
            [
                'title' => 'Create Announcement',
                'description' => 'Post a new announcement',
                'route' => 'mwenyekiti.matangazo.create',
                'icon' => 'fas fa-bullhorn',
                'color' => 'success'
            ],
            [
                'title' => 'Add Balozi',
                'description' => 'Register a new Balozi',
                'route' => 'mwenyekiti.balozi.create',
                'icon' => 'fas fa-user-plus',
                'color' => 'info'
            ],
            [
                'title' => 'Meeting Requests',
                'description' => $pendingRequestsCount . ' pending requests',
                'route' => 'mwenyekiti.meeting-requests.index',
                'icon' => 'fas fa-clock',
                'color' => 'warning'
            ]
        ];
    }

    public function getAreaStats()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        // Get ONLY this Mwenyekiti's Balozi
        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');

        // Statistics by Mtaa/Area - ONLY from this Mwenyekiti's Balozi
        $areaStats = Watu::whereIn('created_by', $baloziIds)
            ->select('mtaa', DB::raw('count(*) as total_people'))
            ->whereNotNull('mtaa')
            ->groupBy('mtaa')
            ->orderByDesc('total_people')
            ->get();

        // Statistics by Balozi - ONLY this Mwenyekiti's Balozi
        $baloziStats = Balozi::where('mwenyekiti_id', $mwenyekitiId)
            ->withCount([
                'watu as watu_entries_count',
                'mahitajiMaalumu as mahitaji_maalumu_count',
                'kayaMaskini as kaya_maskini_count'
            ])
            ->get();

        return response()->json([
            'areaStats' => $areaStats,
            'baloziStats' => $baloziStats
        ]);
    }
}