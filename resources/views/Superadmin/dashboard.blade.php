<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: rgba(79, 70, 229, 0.1);
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
        <!-- Include the sidebar -->
        @include('Superadmin.shared.sidebar-menu')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="page-title">Dashboard</h1>
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="#" class="breadcrumb-link">Home</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Dashboard</span>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                        <div class="notification-badge"></div>
                    </div>
                    <div class="header-action">
                        <i class="fas fa-envelope"></i>
                        <div class="notification-badge"></div>
                    </div>
                    <div class="user-profile">
                        <div class="user-avatar">
                            JS
                        </div>
                        <div class="user-info">
                            <div class="user-name">John Smith</div>
                            <div class="user-role">Administrator</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <h2 class="dashboard-title">Overview</h2>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Total Revenue</div>
                            <div class="stat-icon purple">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stat-value">$24,780</div>
                        <div class="stat-description">
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i>
                                12.5%
                            </div>
                            vs previous month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Total Orders</div>
                            <div class="stat-icon green">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                        <div class="stat-value">1,482</div>
                        <div class="stat-description">
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i>
                                8.2%
                            </div>
                            vs previous month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">New Customers</div>
                            <div class="stat-icon blue">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-value">385</div>
                        <div class="stat-description">
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i>
                                4.7%
                            </div>
                            vs previous month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Conversion Rate</div>
                            <div class="stat-icon orange">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                        <div class="stat-value">3.42%</div>
                        <div class="stat-description">
                            <div class="stat-trend down">
                                <i class="fas fa-arrow-down"></i>
                                1.8%
                            </div>
                            vs previous month
                        </div>
                    </div>
                </div>

                <!-- Charts and Activity -->
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>
                            <div class="card-actions">
                                <button class="card-action">View All</button>
                            </div>
                        </div>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon purple">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">New order #1234 from John Doe</div>
                                    <div class="activity-time">5 minutes ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon green">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">New customer registered</div>
                                    <div class="activity-time">1 hour ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon blue">
                                    <i class="fas fa-comment"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">New comment on product #5678</div>
                                    <div class="activity-time">3 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon orange">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Order #9012 has been shipped</div>
                                    <div class="activity-time">5 hours ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Orders</h3>
                        <div class="card-actions">
                            <button class="card-action">View All</button>
                        </div>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD-1234</td>
                                <td>John Doe</td>
                                <td>May 15, 2023</td>
                                <td>$125.00</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>
                                    <i class="fas fa-ellipsis-h table-action"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-1235</td>
                                <td>Jane Smith</td>
                                <td>May 14, 2023</td>
                                <td>$245.99</td>
                                <td><span class="status-badge in-progress">In Progress</span></td>
                                <td>
                                    <i class="fas fa-ellipsis-h table-action"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-1236</td>
                                <td>Robert Johnson</td>
                                <td>May 14, 2023</td>
                                <td>$89.50</td>
                                <td><span class="status-badge pending">Pending</span></td>
                                <td>
                                    <i class="fas fa-ellipsis-h table-action"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-1237</td>
                                <td>Emily Davis</td>
                                <td>May 13, 2023</td>
                                <td>$352.75</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>
                                    <i class="fas fa-ellipsis-h table-action"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD-1238</td>
                                <td>Michael Wilson</td>
                                <td>May 13, 2023</td>
                                <td>$78.25</td>
                                <td><span class="status-badge cancelled">Cancelled</span></td>
                                <td>
                                    <i class="fas fa-ellipsis-h table-action"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Quick Actions -->
                <h2 class="dashboard-title">Quick Actions</h2>
                <div class="quick-actions">
                    <div class="quick-action-card">
                        <div class="quick-action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="quick-action-title">Add Product</div>
                        <div class="quick-action-description">Create a new product listing</div>
                    </div>
                    <div class="quick-action-card">
                        <div class="quick-action-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="quick-action-title">Add Customer</div>
                        <div class="quick-action-description">Create a new customer account</div>
                    </div>
                    <div class="quick-action-card">
                        <div class="quick-action-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="quick-action-title">Create Invoice</div>
                        <div class="quick-action-description">Generate a new invoice</div>
                    </div>
                    <div class="quick-action-card">
                        <div class="quick-action-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="quick-action-title">View Reports</div>
                        <div class="quick-action-description">Access detailed analytics</div>
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
                sidebar.classList.remove('collapsed');
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

<Actions>
  <Action name="Add dark mode toggle" description="Implement dark/light theme switching" />
  <Action name="Create user profile page" description="Build a user profile settings page" />
  <Action name="Add notification system" description="Implement real-time notifications" />
  <Action name="Create product management page" description="Build CRUD interface for products" />
  <Action name="Add data export functionality" description="Allow exporting data to CSV/Excel" />
</Actions>
