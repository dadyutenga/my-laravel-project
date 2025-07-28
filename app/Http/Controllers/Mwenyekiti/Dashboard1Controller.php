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

        // Get all statistics
        $stats = $this->getOverviewStats($mwenyekitiId);
        $charts = $this->getChartData($mwenyekitiId);
        $recentActivities = $this->getRecentActivities($mwenyekitiId);
        $quickActions = $this->getQuickActions($mwenyekitiId);

        return view('Mwenyekiti.dashboard', compact('stats', 'charts', 'recentActivities', 'quickActions'));
    }

    private function getOverviewStats($mwenyekitiId)
    {
        // Get Balozi under this Mwenyekiti
        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');

        // Total People (Watu) registered by Balozi under this Mwenyekiti
        $totalWatu = Watu::whereIn('created_by', $baloziIds)->count();
        $newWatuThisMonth = Watu::whereIn('created_by', $baloziIds)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total Balozi under this Mwenyekiti
        $totalBalozi = $baloziIds->count();
        
        // Active Balozi based on recent activity (those who have registered people recently)
        $activeBaloziThisMonth = Balozi::where('mwenyekiti_id', $mwenyekitiId)
            ->whereHas('watu', function($query) {
                $query->where('created_at', '>=', now()->subMonth());
            })
            ->count();

        // If no recent activity, count active Balozi based on is_active status
        if ($activeBaloziThisMonth === 0) {
            $activeBaloziThisMonth = Balozi::where('mwenyekiti_id', $mwenyekitiId)
                ->where('is_active', true)
                ->count();
        }

        // Meetings Statistics
        $totalMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)->count();
        $upcomingMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->where('meeting_date', '>', now())
            ->whereNull('outcome')
            ->count();

        // Meeting Requests from Balozi
        $pendingMeetingRequests = MtaaMeetingRequest::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })->where('status', 'pending')->count();

        // Announcements
        $totalAnnouncements = MatangazoYaKawaida::where('created_by', $mwenyekitiId)->count() +
                             Matangazo::where('created_by', $mwenyekitiId)->count();
        $activeAnnouncements = MatangazoYaKawaida::where('created_by', $mwenyekitiId)
            ->where('effective_date', '<=', now())
            ->where(function($query) {
                $query->whereNull('expiry_date')
                      ->orWhere('expiry_date', '>=', now());
            })->count();

        // Udhamini (Sponsorship forms)
        $totalUdhamini = Udhamini::where('created_by', $mwenyekitiId)->count();
        $udhaminiThisMonth = Udhamini::where('created_by', $mwenyekitiId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Special Needs People
        $totalMahitajiMaalumu = MahitajiMaalumu::whereIn('created_by', $baloziIds)->count();
        
        // Poor Families
        $totalKayaMaskini = KayaMaskini::whereIn('created_by', $baloziIds)->count();

        // Complaints
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
        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');

        // Monthly registration trends for the last 6 months
        $monthlyWatu = [];
        $monthlyMeetings = [];
        $monthlyComplaints = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('M Y');
            
            $monthlyWatu[] = [
                'month' => $monthKey,
                'count' => Watu::whereIn('created_by', $baloziIds)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count()
            ];

            $monthlyMeetings[] = [
                'month' => $monthKey,
                'count' => MtaaMeeting::where('organizer_id', $mwenyekitiId)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count()
            ];

            $monthlyComplaints[] = [
                'month' => $monthKey,
                'count' => Malalamiko::whereIn('created_by', $baloziIds)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count()
            ];
        }

        // Gender distribution
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

        // Age groups
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
        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');
        $activities = collect();

        // Recent Watu registrations
        $recentWatu = Watu::whereIn('created_by', $baloziIds)
            ->with('balozi')
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

        // Recent meetings
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

        // Recent meeting requests
        $recentRequests = MtaaMeetingRequest::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->with('balozi')
        ->latest()
        ->take(3)
        ->get()
        ->map(function($request) {
            return [
                'type' => 'meeting_request',
                'title' => $request->title,
                'description' => "Request from " . ($request->balozi->first_name ?: '') . " " . ($request->balozi->last_name ?: ''),
                'time' => $request->created_at,
                'icon' => 'fas fa-calendar-check',
                'color' => $request->status === 'pending' ? 'warning' : ($request->status === 'approved' ? 'success' : 'danger')
            ];
        });

        // Recent announcements
        $recentAnnouncements = MatangazoYaKawaida::where('created_by', $mwenyekitiId)
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
        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');

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
                'description' => MtaaMeetingRequest::whereHas('balozi', function($query) use ($mwenyekitiId) {
                    $query->where('mwenyekiti_id', $mwenyekitiId);
                })->where('status', 'pending')->count() . ' pending requests',
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

        $baloziIds = Balozi::where('mwenyekiti_id', $mwenyekitiId)->pluck('id');

        // Statistics by Mtaa/Area
        $areaStats = Watu::whereIn('created_by', $baloziIds)
            ->select('mtaa', DB::raw('count(*) as total_people'))
            ->whereNotNull('mtaa')
            ->groupBy('mtaa')
            ->orderByDesc('total_people')
            ->get();

        // Statistics by Balozi - fixed relationship names
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