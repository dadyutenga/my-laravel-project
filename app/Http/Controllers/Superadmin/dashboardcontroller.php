<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total users count and growth
        $totalUsers = User::count();
        $newUsersLastMonth = User::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $userGrowth = $this->calculateGrowthPercentage(
            User::where('created_at', '>=', Carbon::now()->subMonths(2))->where('created_at', '<', Carbon::now()->subMonth())->count(),
            $newUsersLastMonth
        );

        // Get admin users count and new admins
        $totalAdmins = Admin::count();
        $newAdmins = Admin::where('created_at', '>=', Carbon::now()->subMonth())->count();

        // Calculate system load (example metric - you can modify based on your needs)
        $systemLoad = [
            'percentage' => rand(20, 60), // Replace with actual system load calculation
            'trend' => rand(-5, 5)
        ];

        // Get support tickets (placeholder - replace with actual ticket model if you have one)
        $supportTickets = [
            'open' => 18,
            'resolved' => 5
        ];

        // Get recent activities
        $recentActivities = $this->getRecentActivities();

        // Get system logs
        $systemLogs = $this->getSystemLogs();

        return view('superadmin.dashboard', compact(
            'totalUsers',
            'userGrowth',
            'totalAdmins',
            'newAdmins',
            'systemLoad',
            'supportTickets',
            'recentActivities',
            'systemLogs'
        ));
    }

    private function calculateGrowthPercentage($previous, $current)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        
        return round((($current - $previous) / $previous) * 100, 1);
    }

    private function getRecentActivities()
    {
        // You can replace this with actual activity logging from your database
        return [
            [
                'type' => 'user',
                'icon' => 'user-plus',
                'color' => 'purple',
                'title' => 'New admin user created',
                'time' => Carbon::now()->subMinutes(10)->diffForHumans()
            ],
            [
                'type' => 'security',
                'icon' => 'key',
                'color' => 'green',
                'title' => 'System permissions updated',
                'time' => Carbon::now()->subHour()->diffForHumans()
            ],
            [
                'type' => 'system',
                'icon' => 'shield-alt',
                'color' => 'blue',
                'title' => 'Security audit completed',
                'time' => Carbon::now()->subHours(2)->diffForHumans()
            ],
            [
                'type' => 'alert',
                'icon' => 'exclamation-circle',
                'color' => 'orange',
                'title' => 'System alert resolved',
                'time' => Carbon::now()->subHours(4)->diffForHumans()
            ]
        ];
    }

    private function getSystemLogs()
    {
        // You can replace this with actual logs from your database
        return [
            [
                'id' => 'LOG-1234',
                'user' => 'admin@system.com',
                'action' => 'User Permission Update',
                'date' => Carbon::now()->format('M d, Y'),
                'status' => 'Success',
                'status_class' => 'completed'
            ],
            [
                'id' => 'LOG-1235',
                'user' => 'security@system.com',
                'action' => 'Security Scan',
                'date' => Carbon::now()->subHours(2)->format('M d, Y'),
                'status' => 'In Progress',
                'status_class' => 'in-progress'
            ],
            [
                'id' => 'LOG-1236',
                'user' => 'system@admin.com',
                'action' => 'Backup Creation',
                'date' => Carbon::now()->subHours(5)->format('M d, Y'),
                'status' => 'Success',
                'status_class' => 'completed'
            ]
        ];
    }

    public function getAdminStats()
    {
        $activeAdmins = Admin::where('is_active', true)->count();
        $inactiveAdmins = Admin::where('is_active', false)->count();
        
        return [
            'total' => $activeAdmins + $inactiveAdmins,
            'active' => $activeAdmins,
            'inactive' => $inactiveAdmins
        ];
    }

    public function getUserStats()
    {
        $today = Carbon::today();
        $lastMonth = Carbon::now()->subMonth();

        return [
            'total' => User::count(),
            'new_today' => User::whereDate('created_at', $today)->count(),
            'new_this_month' => User::where('created_at', '>=', $lastMonth)->count()
        ];
    }
}