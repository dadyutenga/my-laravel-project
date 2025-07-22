<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mwenyekiti;
use App\Models\MwenyekitiAuth;
use App\Models\Balozi;
use App\Models\BaloziAuth;
use App\Models\Admin;
use App\Models\Sessions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        
        // Make sure we have an Admin instance and load details relationship
        if (!$admin instanceof \App\Models\Admin) {
            abort(500, 'Authenticated user is not an instance of the Admin model.');
        }
        
        // Eager load the details relationship
        $admin->load('details');
        
        // Debug: Check if details are loaded
        // dd($admin->details); // Uncomment this line to debug
        
        // Get real stats
        $stats = [
            'mwenyekiti_count' => Mwenyekiti::count(),
            'mwenyekiti_accounts' => MwenyekitiAuth::where('is_active', true)->count(),
            'balozi_count' => Balozi::count(),
            'balozi_accounts' => BaloziAuth::where('is_active', true)->count(),
            'support_tickets' => 0, // You can add this when you have tickets table
            'active_sessions' => $this->getActiveSessions(),
        ];
        
        // Get trends (comparing with last month)
        $trends = [
            'mwenyekiti_trend' => $this->getMwenyekitiTrend(),
            'balozi_trend' => $this->getBaloziTrend(),
            'tickets_trend' => $this->getTicketsTrend(),
            'sessions_trend' => $this->getSessionsTrend(),
        ];
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities();
        
        return view('Admin.dashboard', compact('admin', 'stats', 'trends', 'recentActivities'));
    }
    
    private function getActiveSessions()
    {
        // Count active sessions from our Sessions model
        return Sessions::active()->whereNull('logout_at')->count();
    }
    
    private function getMwenyekitiTrend()
    {
        $currentMonth = Mwenyekiti::whereMonth('created_at', now()->month)
                                  ->whereYear('created_at', now()->year)
                                  ->count();
        
        $lastMonth = Mwenyekiti::whereMonth('created_at', now()->subMonth()->month)
                               ->whereYear('created_at', now()->subMonth()->year)
                               ->count();
        
        if ($lastMonth == 0) return ['percentage' => 0, 'direction' => 'up'];
        
        $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
        
        return [
            'percentage' => abs($percentage),
            'direction' => $percentage >= 0 ? 'up' : 'down'
        ];
    }
    
    private function getBaloziTrend()
    {
        $currentMonth = Balozi::whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                              ->count();
        
        $lastMonth = Balozi::whereMonth('created_at', now()->subMonth()->month)
                           ->whereYear('created_at', now()->subMonth()->year)
                           ->count();
        
        if ($lastMonth == 0) return ['percentage' => 0, 'direction' => 'up'];
        
        $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
        
        return [
            'percentage' => abs($percentage),
            'direction' => $percentage >= 0 ? 'up' : 'down'
        ];
    }
    
    private function getTicketsTrend()
    {
        // Since tickets table might not exist yet, return demo data
        return ['percentage' => 12, 'direction' => 'up'];
    }
    
    private function getSessionsTrend()
    {
        $currentMonth = Sessions::thisMonth()->count();
        $lastMonth = Sessions::whereMonth('login_at', now()->subMonth()->month)
                            ->whereYear('login_at', now()->subMonth()->year)
                            ->count();
        
        if ($lastMonth == 0) return ['percentage' => 0, 'direction' => 'up'];
        
        $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
        
        return [
            'percentage' => abs($percentage),
            'direction' => $percentage >= 0 ? 'up' : 'down'
        ];
    }
    
    private function getRecentActivities()
    {
        $activities = collect();
        
        // Get recent Mwenyekiti additions
        $recentMwenyekiti = Mwenyekiti::latest()->take(3)->get();
        foreach ($recentMwenyekiti as $mwenyekiti) {
            $activities->push([
                'icon' => 'fas fa-user-plus',
                'color' => 'purple',
                'title' => "Mwenyekiti added: {$mwenyekiti->first_name} {$mwenyekiti->last_name}",
                'time' => $mwenyekiti->created_at->diffForHumans(),
            ]);
        }
        
        // Get recent Balozi additions
        $recentBalozi = Balozi::latest()->take(2)->get();
        foreach ($recentBalozi as $balozi) {
            $activities->push([
                'icon' => 'fas fa-users-cog',
                'color' => 'green',
                'title' => "Balozi added: {$balozi->first_name} {$balozi->last_name}",
                'time' => $balozi->created_at->diffForHumans(),
            ]);
        }
        
        // Get recent login sessions
        $recentSessions = Sessions::with(['admin', 'mwenyekiti', 'balozi'])
                                 ->latest('login_at')
                                 ->take(3)
                                 ->get();
        
        foreach ($recentSessions as $session) {
            $user = $session->getUser();
            $userName = '';
            
            if ($session->user_type === 'admin' && $user) {
                $userName = $user->name;
            } elseif ($session->user_type === 'mwenyekiti' && $user) {
                $userName = $user->first_name . ' ' . $user->last_name;
            } elseif ($session->user_type === 'balozi' && $user) {
                $userName = $user->first_name . ' ' . $user->last_name;
            }
            
            if ($userName) {
                $activities->push([
                    'icon' => 'fas fa-sign-in-alt',
                    'color' => 'blue',
                    'title' => ucfirst($session->user_type) . " login: {$userName}",
                    'time' => $session->login_at->diffForHumans(),
                ]);
            }
        }
        
        // Sort by creation time and take latest 5
        return $activities->sortByDesc(function($activity) {
            return $activity['time'];
        })->take(5)->values();
    }
}
