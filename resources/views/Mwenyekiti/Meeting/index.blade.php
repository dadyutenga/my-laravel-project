<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Management | Prototype System</title>
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

        /* Complete Sidebar Styles */
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
            text-align: center;
        }

        .menu-text {
            transition: var(--transition);
            white-space: nowrap;
            overflow: hidden;
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
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .dashboard-content {
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
        }

        .btn {
            padding: 12px 20px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 12px;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
        }

        /* Enhanced Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #6366f1, #8b5cf6);
            border-radius: 10px 10px 0 0;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(79, 70, 229, 0.2);
        }

        .stat-card.total::before {
            background: linear-gradient(90deg, var(--primary-color), #6366f1, #8b5cf6);
        }

        .stat-card.month::before {
            background: linear-gradient(90deg, var(--info-color), #60a5fa, #3b82f6);
        }

        .stat-card.completed::before {
            background: linear-gradient(90deg, var(--success-color), #34d399, #059669);
        }

        .stat-card.upcoming::before {
            background: linear-gradient(90deg, var(--warning-color), #fbbf24, #f59e0b);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .stat-info {
            flex: 1;
        }

        .stat-title {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-color);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-icon {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            position: relative;
            transition: all 0.3s ease;
        }

        .stat-icon.total {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.15), rgba(79, 70, 229, 0.05));
            color: var(--primary-color);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.2);
        }

        .stat-icon.month {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(59, 130, 246, 0.05));
            color: var(--info-color);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
        }

        .stat-icon.completed {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
            color: var(--success-color);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2);
        }

        .stat-icon.upcoming {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05));
            color: var(--warning-color);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.2);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .table-container {
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background-color: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
        }

        .table tbody tr:hover {
            background-color: var(--primary-light);
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.scheduled {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .status-badge.completed {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-badge.upcoming {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .alert {
            padding: 12px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        /* Mobile */
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

            .page-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <div class="dashboard-content">
                <div class="page-header">
                    <h2 class="dashboard-title">Meeting Management</h2>
                    <a href="{{ route('mwenyekiti.meetings.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Schedule New Meeting
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Statistics Cards -->
                <div class="stats-row">
                    <div class="stat-card total">
                        <div class="stat-header">
                            <div class="stat-info">
                                <div class="stat-title">Total Meetings</div>
                                <div class="stat-value">{{ $totalMeetings }}</div>
                            </div>
                            <div class="stat-icon total">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card month">
                        <div class="stat-header">
                            <div class="stat-info">
                                <div class="stat-title">This Month</div>
                                <div class="stat-value">{{ $thisMonthMeetings }}</div>
                            </div>
                            <div class="stat-icon month">
                                <i class="fas fa-calendar-week"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card completed">
                        <div class="stat-header">
                            <div class="stat-info">
                                <div class="stat-title">Completed</div>
                                <div class="stat-value">{{ $completedMeetings }}</div>
                            </div>
                            <div class="stat-icon completed">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card upcoming">
                        <div class="stat-header">
                            <div class="stat-info">
                                <div class="stat-title">Upcoming</div>
                                <div class="stat-value">{{ $upcomingMeetings }}</div>
                            </div>
                            <div class="stat-icon upcoming">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Meetings Table -->
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Mtaa</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($meetings as $meeting)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $meeting->title }}</strong><br>
                                            <small style="color: var(--text-muted);">{{ $meeting->title_sw }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $meeting->meeting_date->format('d/m/Y') }}</td>
                                    <td>{{ $meeting->mtaa }}</td>
                                    <td>
                                        @if($meeting->outcome)
                                            <span class="status-badge completed">Completed</span>
                                        @elseif($meeting->meeting_date > now())
                                            <span class="status-badge upcoming">Upcoming</span>
                                        @else
                                            <span class="status-badge scheduled">Scheduled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 5px;">
                                            <a href="{{ route('mwenyekiti.meetings.show', $meeting->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i>
                                                View
                                            </a>
                                            @if(!$meeting->outcome)
                                                <a href="{{ route('mwenyekiti.meetings.edit', $meeting->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px;">
                                        <i class="fas fa-calendar-times" style="font-size: 48px; color: var(--text-muted); margin-bottom: 10px;"></i>
                                        <p>No meetings found</p>
                                        <a href="{{ route('mwenyekiti.meetings.create') }}" class="btn btn-primary" style="margin-top: 10px;">
                                            <i class="fas fa-plus"></i>
                                            Schedule First Meeting
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($meetings->hasPages())
                    <div class="pagination">
                        {{ $meetings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>

    <script>
        // Sidebar toggle functionality
        document.querySelector('.sidebar-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

        // Close sidebar when clicking on overlay
        document.querySelector('.sidebar-overlay')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('collapsed');
            this.classList.remove('active');
        });
    </script>
</body>
</html>