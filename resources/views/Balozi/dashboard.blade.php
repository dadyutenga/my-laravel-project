<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balozi Dashboard | Prototype System</title>
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

        /* Sidebar - Exactly matches previous views */
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

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            padding: 30px;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Dashboard Header */
        .dashboard-header {
            background-color: white;
            border-radius: var(--radius-md);
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 16px;
            font-weight: 500;
        }

        .user-role {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Dashboard Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            border-radius: var(--radius-md);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            border-left: 4px solid var(--primary-color);
        }

        .stat-card h3 {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 5px;
        }

        .stat-card .trend {
            font-size: 14px;
            color: var(--text-muted);
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-card {
            background-color: white;
            border-radius: var(--radius-md);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .action-card i {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 15px;
        }

        .action-card h4 {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 5px;
        }

        .action-card p {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Recent Activity */
        .recent-activity {
            background-color: white;
            border-radius: var(--radius-md);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary-color);
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item i {
            color: var(--primary-color);
            margin-right: 15px;
            font-size: 16px;
        }

        .activity-item span {
            font-size: 14px;
            color: var(--text-color);
        }

        .activity-item .time {
            margin-left: auto;
            font-size: 13px;
            color: var(--text-muted);
        }

        /* Mobile menu toggle */
        .mobile-menu-toggle {
            display: none;
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

        .mobile-menu-toggle:hover {
            background-color: var(--secondary-color);
            color: var(--primary-color);
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

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.collapsed {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar - Same as previous views -->
        @include('Balozi.shared.sidebar-menu')
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Dashboard Header -->
            <div class="dashboard-header">
                <div class="header-left">
                    <div class="mobile-menu-toggle" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="dashboard-title">Balozi Dashboard</h1>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ substr(auth()->user()->name ?? 'B', 0, 1) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name ?? 'Balozi' }}</div>
                        <div class="user-role">Balozi User</div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Service Requests</h3>
                    <div class="number">120</div>
                    <div class="trend">5% vs last month</div>
                </div>
                <div class="stat-card">
                    <h3>Meetings Scheduled</h3>
                    <div class="number">45</div>
                    <div class="trend">10% vs last month</div>
                </div>
                <div class="stat-card">
                    <h3>Community Members</h3>
                    <div class="number">500</div>
                    <div class="trend">3% vs last week</div>
                </div>
                <div class="stat-card">
                    <h3>Complaints Filed</h3>
                    <div class="number">25</div>
                    <div class="trend">8% vs last week</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <h2 class="section-title">
                <i class="fas fa-bolt"></i>
                Quick Actions
            </h2>
            <div class="actions-grid">
                <div class="action-card">
                    <i class="fas fa-file-alt"></i>
                    <h4>Request Services</h4>
                    <p>Submit new service requests</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-envelope"></i>
                    <h4>Request Meetings</h4>
                    <p>Schedule meetings with officials</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-users"></i>
                    <h4>Community</h4>
                    <p>Manage community interactions</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-home"></i>
                    <h4>Register Kaya Maskini</h4>
                    <p>Add new household registrations</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-user-plus"></i>
                    <h4>Register Watu</h4>
                    <p>Register new individuals</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-exclamation-circle"></i>
                    <h4>Tuma Malalamiko</h4>
                    <p>File new complaints</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h2 class="section-title">
                    <i class="fas fa-history"></i>
                    Recent Activity
                </h2>
                <ul class="activity-list">
                    <li class="activity-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Service request submitted</span>
                        <span class="time">1 hour ago</span>
                    </li>
                    <li class="activity-item">
                        <i class="fas fa-envelope"></i>
                        <span>Meeting scheduled with Mwenyekiti</span>
                        <span class="time">3 hours ago</span>
                    </li>
                    <li class="activity-item">
                        <i class="fas fa-users"></i>
                        <span>Community member added</span>
                        <span class="time">Today, 9:30 AM</span>
                    </li>
                    <li class="activity-item">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Complaint filed</span>
                        <span class="time">Yesterday</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle functionality
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('collapsed');
                    document.querySelector('.sidebar-overlay').classList.toggle('active');
                });
            }

            // Sidebar toggle functionality
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('collapsed');
                });
            }

            // Close sidebar when clicking on overlay
            const overlay = document.querySelector('.sidebar-overlay');
            if (overlay) {
                overlay.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.add('collapsed');
                    this.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>