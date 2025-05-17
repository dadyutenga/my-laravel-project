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
            User::where('created_at', '>=', Carbon::now()->subMonths(2))
                ->where('created_at', '<', Carbon::now()->subMonth())
                ->count(),
            $newUsersLastMonth
        );

        // Get admin users count and new admins
        $totalAdmins = Admin::count();
        $newAdmins = Admin::where('created_at', '>=', Carbon::now()->subMonth())->count();

        // Get real system load
        $systemLoad = $this->getSystemLoad();

        // Get support tickets
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

    private function getSystemLoad()
    {
        try {
            // CPU Usage (alternative method)
            if (function_exists('sys_getloadavg')) {
                $cpuLoad = sys_getloadavg();
                $cpuUsage = $cpuLoad[0];
            } else {
                // Windows alternative or fallback
                if (PHP_OS_FAMILY === 'Windows') {
                    $cmd = "wmic cpu get loadpercentage";
                    exec($cmd, $output);
                    $cpuUsage = isset($output[1]) ? ((int)$output[1] / 100) : 0.5;
                } else {
                    // Linux alternative
                    $load = shell_exec("top -bn1 | grep 'Cpu(s)' | awk '{print $2}'");
                    $cpuUsage = $load ? ((float)$load / 100) : 0.5;
                }
            }

            // Memory Usage
            if (PHP_OS_FAMILY === 'Windows') {
                $cmd = "wmic OS get FreePhysicalMemory,TotalVisibleMemorySize /Value";
                exec($cmd, $output);
                
                $memoryTotal = 0;
                $memoryFree = 0;
                
                foreach ($output as $line) {
                    if (strpos($line, 'FreePhysicalMemory') !== false) {
                        $memoryFree = (int)explode('=', $line)[1] * 1024;
                    }
                    if (strpos($line, 'TotalVisibleMemorySize') !== false) {
                        $memoryTotal = (int)explode('=', $line)[1] * 1024;
                    }
                }
            } else {
                // Linux memory info
                $memInfo = @file_get_contents('/proc/meminfo');
                if ($memInfo) {
                    preg_match('/MemTotal:\s+(\d+)/', $memInfo, $matches);
                    $memoryTotal = isset($matches[1]) ? $matches[1] * 1024 : 0;
                    
                    preg_match('/MemFree:\s+(\d+)/', $memInfo, $matches);
                    $memoryFree = isset($matches[1]) ? $matches[1] * 1024 : 0;
                } else {
                    // Fallback values
                    $memoryTotal = memory_get_peak_usage(true);
                    $memoryFree = memory_get_peak_usage(true) - memory_get_usage(true);
                }
            }

            $memoryUsed = $memoryTotal - $memoryFree;
            $memoryUsagePercentage = $memoryTotal > 0 ? round(($memoryUsed / $memoryTotal) * 100, 2) : 0;

            // Disk Usage
            $diskTotal = @disk_total_space('/');
            $diskFree = @disk_free_space('/');
            
            if ($diskTotal === false || $diskFree === false) {
                $diskTotal = 100 * 1024 * 1024 * 1024; // 100GB fallback
                $diskFree = 50 * 1024 * 1024 * 1024;   // 50GB fallback
            }
            
            $diskUsed = $diskTotal - $diskFree;
            $diskUsagePercentage = round(($diskUsed / $diskTotal) * 100, 2);

            // Calculate overall system load
            $overallLoad = round(($memoryUsagePercentage + $diskUsagePercentage) / 2, 2);

            // Get previous load for trend calculation
            $previousLoad = cache()->get('previous_system_load', $overallLoad);
            $trend = $overallLoad - $previousLoad;

            // Cache current load for next comparison
            cache()->put('previous_system_load', $overallLoad, now()->addMinutes(5));

            return [
                'percentage' => $overallLoad,
                'trend' => $trend,
                'details' => [
                    'cpu' => [
                        'load' => round($cpuUsage * 100, 2),
                        'cores' => php_sapi_name() !== 'cli' ? 1 : $this->getCPUCores()
                    ],
                    'memory' => [
                        'total' => $this->formatBytes($memoryTotal),
                        'used' => $this->formatBytes($memoryUsed),
                        'free' => $this->formatBytes($memoryFree),
                        'percentage' => $memoryUsagePercentage
                    ],
                    'disk' => [
                        'total' => $this->formatBytes($diskTotal),
                        'used' => $this->formatBytes($diskUsed),
                        'free' => $this->formatBytes($diskFree),
                        'percentage' => $diskUsagePercentage
                    ]
                ]
            ];
        } catch (\Exception $e) {
            // Fallback values if anything fails
            return [
                'percentage' => 45, // Default reasonable value
                'trend' => 0,
                'details' => [
                    'cpu' => [
                        'load' => 45,
                        'cores' => 1
                    ],
                    'memory' => [
                        'total' => $this->formatBytes(1024 * 1024 * 1024), // 1GB
                        'used' => $this->formatBytes(512 * 1024 * 1024),   // 512MB
                        'free' => $this->formatBytes(512 * 1024 * 1024),   // 512MB
                        'percentage' => 50
                    ],
                    'disk' => [
                        'total' => $this->formatBytes(50 * 1024 * 1024 * 1024), // 50GB
                        'used' => $this->formatBytes(25 * 1024 * 1024 * 1024),  // 25GB
                        'free' => $this->formatBytes(25 * 1024 * 1024 * 1024),  // 25GB
                        'percentage' => 50
                    ]
                ],
                'error' => $e->getMessage()
            ];
        }
    }

    private function getCPUCores()
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $cmd = "wmic cpu get NumberOfCores";
            exec($cmd, $output);
            return isset($output[1]) ? (int)$output[1] : 1;
        } else {
            return (int)shell_exec('nproc');
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
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