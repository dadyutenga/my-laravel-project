<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mwenyekiti Dashboard | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
           --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: rgba(16, 185, 129, 0.1);
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --error-color: #ef4444;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-sm: 0.25rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--text-color);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: white;
            border-right: 1px solid var(--border-color);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-color);
            font-weight: 700;
            font-size: 18px;
            transition: var(--transition);
        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary-color), #34d399);
            color: white;
            border-radius: var(--radius-sm);
            font-size: 16px;
        }

        .logo-text {
            transition: var(--transition);
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }

        .sidebar-toggle {
            position: absolute;
            top: 20px;
            right: -12px;
            width: 24px;
            height: 24px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            z-index: 10;
            border: 2px solid white;
            transition: var(--transition);
        }

        .sidebar-toggle i {
            font-size: 12px;
            transition: var(--transition);
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar-menu {
            padding: 20px 0;
            overflow-y: auto;
            height: calc(100vh - var(--header-height));
        }

        .menu-section {
            margin-bottom: 20px;
        }

        .menu-section-title {
            padding: 10px 20px;
            font-size: 12px;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 600;
            letter-spacing: 0.5px;
            white-space: nowrap;
            overflow: hidden;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-section-title {
            opacity: 0;
        }

        .menu-item {
            padding: 10px 20px;
            display: flex;
            align-items: center;
            color: var(--text-color);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            margin: 2px 0;
        }

        .menu-item:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .menu-item.active {
            background-color: var(--primary-light);
            color: var(--primary-color);
            font-weight: 500;
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: var(--primary-color);
        }

        .menu-icon {
            width: 20px;
            margin-right: 10px;
            font-size: 16px;
            text-align: center;
        }

        .menu-text {
            white-space: nowrap;
            overflow: hidden;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
            width: 0;
        }

        .menu-badge {
            margin-left: auto;
            background-color: var(--primary-color);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-badge {
            opacity: 0;
            width: 0;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .header {
            height: var(--header-height);
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            margin-left: 20px;
            color: var(--text-muted);
            font-size: 14px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin: 0 8px;
            color: var(--text-muted);
        }

        .breadcrumb-link {
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-link:hover {
            color: var(--primary-color);
        }

        .breadcrumb-current {
            color: var(--text-color);
            font-weight: 500;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-action {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .header-action:hover {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--error-color);
            border: 2px solid white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px;
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .user-profile:hover {
            background-color: var(--secondary-color);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
        }

        .user-role {
            font-size: 12px;
            color: var(--text-muted);
        }

        .dashboard-content {
            padding: 30px;
        }

        .welcome-section {
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .welcome-text {
            color: var(--text-muted);
            font-size: 16px;
        }

        /* Enhanced Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stats-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-color);
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stats-card-primary::before { background: var(--primary-color); }
        .stats-card-success::before { background: var(--success-color); }
        .stats-card-info::before { background: var(--info-color); }
        .stats-card-warning::before { background: var(--warning-color); }
        .stats-card-danger::before { background: var(--error-color); }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }

        .stats-card-primary .stats-icon { background: var(--primary-color); }
        .stats-card-success .stats-icon { background: var(--success-color); }
        .stats-card-info .stats-icon { background: var(--info-color); }
        .stats-card-warning .stats-icon { background: var(--warning-color); }
        .stats-card-danger .stats-icon { background: var(--error-color); }

        .stats-content {
            flex: 1;
        }

        .stats-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stats-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .stats-subtitle {
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .text-green { color: var(--success-color); }

        /* Main Grid Layout */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        /* Quick Actions */
        .quick-actions-section,
        .recent-activities-section {
            background: white;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .section-header {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .section-subtitle {
            font-size: 14px;
            color: var(--text-muted);
        }

        .quick-actions-grid {
            display: grid;
            gap: 16px;
        }

        .quick-action-card {
            display: flex;
            align-items: center;
            padding: 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: var(--transition);
            gap: 16px;
        }

        .quick-action-card:hover {
            border-color: var(--primary-color);
            background: var(--primary-light);
            transform: translateX(4px);
        }

        .quick-action-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            flex-shrink: 0;
        }

        .quick-action-primary .quick-action-icon { background: var(--primary-color); }
        .quick-action-success .quick-action-icon { background: var(--success-color); }
        .quick-action-info .quick-action-icon { background: var(--info-color); }
        .quick-action-warning .quick-action-icon { background: var(--warning-color); }

        .quick-action-content {
            flex: 1;
        }

        .quick-action-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .quick-action-description {
            font-size: 12px;
            color: var(--text-muted);
            margin: 0;
        }

        .quick-action-arrow {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Recent Activities */
        .activities-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: white;
            flex-shrink: 0;
        }

        .activity-primary { background: var(--primary-color); }
        .activity-success { background: var(--success-color); }
        .activity-info { background: var(--info-color); }
        .activity-warning { background: var(--warning-color); }
        .activity-danger { background: var(--error-color); }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .activity-description {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 12px;
            color: var(--text-muted);
        }

        .empty-activities {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
        }

        .empty-activities i {
            font-size: 32px;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        /* Charts Grid */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .chart-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .chart-header {
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .chart-subtitle {
            font-size: 14px;
            color: var(--text-muted);
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
            
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .dashboard-title {
                font-size: 24px;
            }
            
            .stats-value {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <header class="header">
                <div class="header-left">
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="page-title">Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="user-profile">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth('mwenyekiti')->user()->first_name ?? 'MW', 0, 2)) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ auth('mwenyekiti')->user()->first_name ?? 'Mwenyekiti' }} {{ auth('mwenyekiti')->user()->last_name ?? '' }}</div>
                            <div class="user-role">Mwenyekiti</div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="dashboard-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Welcome Section -->
                <div class="welcome-section">
                    <h1 class="dashboard-title">Welcome back, {{ session('mwenyekiti_first_name', 'Mwenyekiti') }}!</h1>
                    <p class="welcome-text">Here's what's happening in your community today.</p>
                </div>

                <!-- Stats Cards Grid -->
                <div class="stats-grid">
                    <!-- Total People Card -->
                    <div class="stats-card stats-card-success">
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-title">Jumla ya Watu</div>
                            <div class="stats-value">{{ number_format($stats['totalWatu']) }}</div>
                            <div class="stats-subtitle">
                                <i class="fas fa-arrow-up"></i>
                                +{{ $stats['newWatuThisMonth'] }} mwezi huu
                            </div>
                        </div>
                    </div>

                    <!-- Total Balozi Card -->
                    <div class="stats-card stats-card-primary">
                        <div class="stats-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-title">Balozi Hai</div>
                            <div class="stats-value">{{ number_format($stats['totalBalozi']) }}</div>
                            <div class="stats-subtitle">
                                <i class="fas fa-circle text-green"></i>
                                {{ $stats['activeBaloziThisMonth'] }} hai mwezi huu
                            </div>
                        </div>
                    </div>

                    <!-- Meetings Card -->
                    <div class="stats-card stats-card-info">
                        <div class="stats-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-title">Mikutano</div>
                            <div class="stats-value">{{ number_format($stats['totalMeetings']) }}</div>
                            <div class="stats-subtitle">
                                <i class="fas fa-clock"></i>
                                {{ $stats['upcomingMeetings'] }} zinazokuja
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card -->
                    <div class="stats-card stats-card-warning">
                        <div class="stats-icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-title">Maombi Yanayosubiri</div>
                            <div class="stats-value">{{ number_format($stats['pendingMeetingRequests']) }}</div>
                            <div class="stats-subtitle">
                                <i class="fas fa-exclamation-circle"></i>
                                Maombi ya mikutano
                            </div>
                        </div>
                    </div>

                    <!-- Announcements Card -->
                    <div class="stats-card stats-card-success">
                        <div class="stats-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-title">Matangazo</div>
                            <div class="stats-value">{{ number_format($stats['totalAnnouncements']) }}</div>
                            <div class="stats-subtitle">
                                <i class="fas fa-broadcast-tower"></i>
                                {{ $stats['activeAnnouncements'] }} yanayoendelea
                            </div>
                        </div>
                    </div>

                    <!-- Special Needs Card -->
                    <div class="stats-card stats-card-info">
                        <div class="stats-icon">
                            <i class="fas fa-wheelchair"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-title">Mahitaji Maalumu</div>
                            <div class="stats-value">{{ number_format($stats['totalMahitajiMaalumu']) }}</div>
                            <div class="stats-subtitle">
                                <i class="fas fa-heart"></i>
                                Watu wenye mahitaji maalumu
                            </div>
                        </div>
                    </div>

                    <!-- Poor Families Card -->
                    <div class="stats-card stats-card-warning">
                        <div class="stats-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-title">Kaya Maskini</div>
                            <div class="stats-value">{{ number_format($stats['totalKayaMaskini']) }}</div>
                            <div class="stats-subtitle">
                                <i class="fas fa-hands-helping"></i>
                                Kaya zinazohitaji msaada
                            </div>
                        </div>
                    </div>

                    <!-- Complaints Card -->
                    <div class="stats-card stats-card-danger">
                        <div class="stats-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-title">Malalamiko</div>
                            <div class="stats-value">{{ number_format($stats['totalMalalamiko']) }}</div>
                            <div class="stats-subtitle">
                                <i class="fas fa-clock"></i>
                                {{ $stats['pendingMalalamiko'] }} yanayosubiri
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Placeholder for future content -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Toggle sidebar on desktop
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.remove('active');
            });

            // Toggle sidebar on mobile
            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.toggle('active');
            });

            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            });
        });
    </script>
</body>
</html>