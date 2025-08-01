<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #4ee546;
            --primary-light: rgba(79, 70, 229, 0.1);
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --error-color: #ef4444;
            --success-color: #37b025;
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

        /* Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
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
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
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

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Header */
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

        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .stat-icon.purple {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .stat-icon.green {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .stat-icon.blue {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .stat-icon.orange {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-description {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: var(--text-muted);
        }

        .stat-trend {
            display: flex;
            align-items: center;
            margin-right: 5px;
            font-weight: 500;
        }

        .stat-trend.up {
            color: var(--success-color);
        }

        .stat-trend.down {
            color: var(--error-color);
        }

        .stat-trend i {
            font-size: 10px;
            margin-right: 2px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .dashboard-card {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
        }

        .card-actions {
            display: flex;
            gap: 10px;
        }

        .card-action {
            padding: 6px 10px;
            background-color: var(--secondary-color);
            border-radius: var(--radius-md);
            font-size: 13px;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .card-action:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .card-action.active {
            background-color: var(--primary-color);
            color: white;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .activity-icon.purple {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .activity-icon.green {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .activity-icon.blue {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .activity-icon.orange {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .activity-time {
            font-size: 12px;
            color: var(--text-muted);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table th {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            background-color: var(--secondary-color);
        }

        .data-table th:first-child {
            border-top-left-radius: var(--radius-md);
        }

        .data-table th:last-child {
            border-top-right-radius: var(--radius-md);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table td {
            font-size: 14px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge.completed {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-badge.in-progress {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .status-badge.pending {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .status-badge.cancelled {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .table-action {
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
        }

        .table-action:hover {
            color: var(--primary-color);
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .quick-action-card {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .quick-action-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
        }

        .quick-action-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 15px;
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .quick-action-title {
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .quick-action-description {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
                transform: translateX(calc(var(--sidebar-collapsed-width) * -1));
            }

            .sidebar.collapsed {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.collapsed ~ .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                right: -30px;
                transform: rotate(180deg);
            }

            .sidebar.collapsed .sidebar-toggle {
                transform: rotate(0);
            }

            .header {
                padding: 0 15px;
            }

            .breadcrumb {
                display: none;
            }

            .dashboard-content {
                padding: 20px 15px;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .header-action:not(.mobile-menu-toggle) {
                display: none;
            }
        }

        /* Mobile menu */
        .mobile-menu-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                margin-right: 15px;
            }
        }

        /* Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Admin.shared.sidebar-menu')
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <div class="page-title">Admin Dashboard</div>
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Home</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Dashboard</span>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-action mobile-menu-toggle" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge"></span>
                    </div>
                    <div class="user-profile">
                        @if($admin->details?->picture)
                            <img src="{{ asset('storage/' . $admin->details->picture) }}" alt="Profile Picture" class="user-avatar" style="object-fit: cover;">
                        @else
                            <div class="user-avatar">{{ substr($admin->name, 0, 1) }}</div>
                        @endif
                        <div class="user-info">
                            <div class="user-name">{{ $admin->name }}</div>
                            <div class="user-role">{{ $admin->isSuperAdmin() ? 'Super Admin' : 'System Admin' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="dashboard-title">Control Center</div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card" style="background: linear-gradient(135deg, #ffffff, #f0f4ff);">
                        <div class="stat-header">
                            <div class="stat-title">Mwenyekiti Profiles</div>
                            <div class="stat-icon purple">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ $stats['mwenyekiti_count'] }}</div>
                        <div class="stat-description">
                            <span class="stat-trend {{ $trends['mwenyekiti_trend']['direction'] }}">
                                <i class="fas fa-arrow-{{ $trends['mwenyekiti_trend']['direction'] }}"></i> {{ $trends['mwenyekiti_trend']['percentage'] }}%
                            </span> vs last month
                        </div>
                    </div>
                    <div class="stat-card" style="background: linear-gradient(135deg, #ffffff, #e6f4ea);">
                        <div class="stat-header">
                            <div class="stat-title">Balozi Profiles</div>
                            <div class="stat-icon green">
                                <i class="fas fa-user-friends"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ $stats['balozi_count'] }}</div>
                        <div class="stat-description">
                            <span class="stat-trend {{ $trends['balozi_trend']['direction'] }}">
                                <i class="fas fa-arrow-{{ $trends['balozi_trend']['direction'] }}"></i> {{ $trends['balozi_trend']['percentage'] }}%
                            </span> vs last month
                        </div>
                    </div>
                    <div class="stat-card" style="background: linear-gradient(135deg, #ffffff, #e6f0ff);">
                        <div class="stat-header">
                            <div class="stat-title">Active Accounts</div>
                            <div class="stat-icon blue">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ $stats['mwenyekiti_accounts'] + $stats['balozi_accounts'] }}</div>
                        <div class="stat-description">
                            <span class="stat-trend up">
                                <i class="fas fa-arrow-up"></i> {{ $trends['tickets_trend']['percentage'] }}%
                            </span> vs last week
                        </div>
                    </div>
                    <div class="stat-card" style="background: linear-gradient(135deg, #ffffff, #fff4e6);">
                        <div class="stat-header">
                            <div class="stat-title">Sessions Online</div>
                            <div class="stat-icon orange">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ $stats['active_sessions'] }}</div>
                        <div class="stat-description">
                            <span class="stat-trend {{ $trends['sessions_trend']['direction'] }}">
                                <i class="fas fa-arrow-{{ $trends['sessions_trend']['direction'] }}"></i> {{ $trends['sessions_trend']['percentage'] }}%
                            </span> vs yesterday
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <a href="{{ route('admin.mwenyekiti.create') }}" class="quick-action-card" style="background: linear-gradient(135deg, #ffffff, #f0f4ff);">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--primary-color), #6366f1); color: white;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="quick-action-title">Add Mwenyekiti</div>
                        <div class="quick-action-description">Create a new Mwenyekiti profile</div>
                    </a>
                    <a href="/admin/mwenyekiti/create-account" class="quick-action-card" style="background: linear-gradient(135deg, #ffffff, #f0f4ff);">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--primary-color), #6366f1); color: white;">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="quick-action-title">Mwenyekiti Account</div>
                        <div class="quick-action-description">Set up Mwenyekiti auth account</div>
                    </a>
                    <a href="{{ route('admin.mwenyekiti.manage') }}" class="quick-action-card" style="background: linear-gradient(135deg, #ffffff, #e6f4ea);">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--success-color), #34d399); color: white;">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="quick-action-title">Manage Mwenyekiti</div>
                        <div class="quick-action-description">Edit or view Mwenyekiti details</div>
                    </a>
                    <a href="{{ route('admin.balozi.manage') }}" class="quick-action-card" style="background: linear-gradient(135deg, #ffffff, #e6f4ea);">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--success-color), #34d399); color: white;">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="quick-action-title">Manage Balozi</div>
                        <div class="quick-action-description">Oversee Balozi accounts</div>
                    </a>
                    <a href="{{ route('admin.tickets') }}" class="quick-action-card" style="background: linear-gradient(135deg, #ffffff, #e6f0ff);">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--info-color), #60a5fa); color: white;">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="quick-action-title">Support Tickets</div>
                        <div class="quick-action-description">Handle user support requests</div>
                    </a>
                    <a href="{{ route('admin.profile') }}" class="quick-action-card" style="background: linear-gradient(135deg, #ffffff, #fff4e6);">
                        <div class="quick-action-icon" style="background: linear-gradient(135deg, var(--warning-color), #fbbf24); color: white;">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="quick-action-title">My Profile</div>
                        <div class="quick-action-description">Update your admin settings</div>
                    </a>
                </div>

                <!-- Recent Activity -->
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-title">Recent Activity</div>
                            <div class="card-actions">
                                <button class="card-action active">All</button>
                                <button class="card-action">Users</button>
                                <button class="card-action">System</button>
                            </div>
                        </div>
                        <div class="activity-list">
                            @forelse($recentActivities as $activity)
                                <div class="activity-item">
                                    <div class="activity-icon {{ $activity['color'] }}">
                                        <i class="{{ $activity['icon'] }}"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">{{ $activity['title'] }}</div>
                                        <div class="activity-time">{{ $activity['time'] }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="activity-item">
                                    <div class="activity-icon blue">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">System initialized</div>
                                        <div class="activity-time">Welcome to your dashboard</div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
            
            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.toggle('active');
            });
            
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            });
            
            // Card actions
            const cardActions = document.querySelectorAll('.card-action');
            cardActions.forEach(action => {
                action.addEventListener('click', function() {
                    const parent = this.parentElement;
                    parent.querySelectorAll('.card-action').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>