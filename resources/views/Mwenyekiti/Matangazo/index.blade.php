<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matangazo Management | Prototype System</title>
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

        /* Include all sidebar CSS from previous files */
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

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

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
            border-radius: 16px 16px 0 0;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(79, 70, 229, 0.2);
        }

        .stat-card.general::before {
            background: linear-gradient(90deg, var(--success-color), #34d399, #37b025);
        }

        .stat-card.meeting::before {
            background: linear-gradient(90deg, var(--info-color), #60a5fa, #3b82f6);
        }

        .stat-card.active::before {
            background: linear-gradient(90deg, var(--warning-color), #fbbf24, #f59e0b);
        }

        .stat-card.urgent::before {
            background: linear-gradient(90deg, var(--error-color), #f87171, #dc2626);
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

        .stat-icon.general {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
            color: var(--success-color);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2);
        }

        .stat-icon.meeting {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(59, 130, 246, 0.05));
            color: var(--info-color);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
        }

        .stat-icon.active {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05));
            color: var(--warning-color);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.2);
        }

        .stat-icon.urgent {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
            color: var(--error-color);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.2);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .content-tabs {
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .tab-header {
            display: flex;
            border-bottom: 1px solid var(--border-color);
        }

        .tab-button {
            flex: 1;
            padding: 15px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
            color: var(--text-muted);
            transition: var(--transition);
            position: relative;
        }

        .tab-button.active {
            color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--primary-color);
        }

        .tab-content {
            padding: 20px;
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .announcement-card {
            background-color: white;
            border-radius: var(--radius-md);
            padding: 20px;
            border: 1px solid var(--border-color);
            margin-bottom: 15px;
            transition: var(--transition);
        }

        .announcement-card:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
        }

        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .announcement-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 5px;
        }

        .announcement-meta {
            display: flex;
            gap: 15px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .announcement-content {
            color: var(--text-color);
            line-height: 1.6;
            margin: 10px 0;
        }

        .announcement-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.active {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-badge.expired {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .status-badge.draft {
            background-color: rgba(107, 114, 128, 0.1);
            color: var(--text-muted);
        }

        .priority-badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .priority-badge.urgent {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .priority-badge.high {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .priority-badge.normal {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .priority-badge.low {
            background-color: rgba(107, 114, 128, 0.1);
            color: var(--text-muted);
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

            .tab-header {
                flex-direction: column;
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
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <div class="dashboard-content">
                <div class="page-header">
                    <h2 class="dashboard-title">Matangazo Management</h2>
                    <a href="{{ route('mwenyekiti.matangazo.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Create New Announcement
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
                    <div class="stat-card general">
                        <div class="stat-header">
                            <div class="stat-info">
                                <div class="stat-title">General Announcements</div>
                                <div class="stat-value">{{ $totalGeneral }}</div>
                            </div>
                            <div class="stat-icon general">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card meeting">
                        <div class="stat-header">
                            <div class="stat-info">
                                <div class="stat-title">Meeting Announcements</div>
                                <div class="stat-value">{{ $totalMeeting }}</div>
                            </div>
                            <div class="stat-icon meeting">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card active">
                        <div class="stat-header">
                            <div class="stat-info">
                                <div class="stat-title">Active Announcements</div>
                                <div class="stat-value">{{ $activeGeneral }}</div>
                            </div>
                            <div class="stat-icon active">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card urgent">
                        <div class="stat-header">
                            <div class="stat-info">
                                <div class="stat-title">Urgent Announcements</div>
                                <div class="stat-value">{{ $urgentGeneral }}</div>
                            </div>
                            <div class="stat-icon urgent">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Announcements Tabs -->
                <div class="content-tabs">
                    <div class="tab-header">
                        <button class="tab-button active" onclick="switchTab('general')">
                            <i class="fas fa-bullhorn"></i>
                            General Announcements ({{ $generalAnnouncements->total() }})
                        </button>
                        <button class="tab-button" onclick="switchTab('meeting')">
                            <i class="fas fa-calendar-alt"></i>
                            Meeting Announcements ({{ $meetingAnnouncements->total() }})
                        </button>
                    </div>

                    <!-- General Announcements Tab -->
                    <div id="general-tab" class="tab-content active">
                        @forelse($generalAnnouncements as $announcement)
                            <div class="announcement-card">
                                <div class="announcement-header">
                                    <div>
                                        <div class="announcement-title">{{ $announcement->title }}</div>
                                        <div class="announcement-meta">
                                            <span><i class="fas fa-calendar"></i> {{ $announcement->formatted_date }}</span>
                                            <span><i class="fas fa-map-marker-alt"></i> {{ $announcement->mtaa }}</span>
                                            <span><i class="fas fa-eye"></i> {{ $announcement->views_count }} views</span>
                                        </div>
                                    </div>
                                    <div style="display: flex; gap: 5px; flex-direction: column; align-items: flex-end;">
                                        <span class="status-badge {{ $announcement->status }}">{{ $announcement->status }}</span>
                                        <span class="priority-badge {{ $announcement->priority }}">{{ $announcement->priority }}</span>
                                    </div>
                                </div>
                                
                                <div class="announcement-content">
                                    {{ $announcement->short_content }}
                                </div>

                                <div class="announcement-actions">
                                    <a href="{{ route('mwenyekiti.matangazo.show', ['id' => $announcement->id, 'type' => 'general']) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                    <a href="{{ route('mwenyekiti.matangazo.edit', ['id' => $announcement->id, 'type' => 'general']) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('mwenyekiti.matangazo.destroy', ['id' => $announcement->id, 'type' => 'general']) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px;">
                                <i class="fas fa-bullhorn" style="font-size: 48px; color: var(--text-muted); margin-bottom: 15px;"></i>
                                <h3>No General Announcements Yet</h3>
                                <p style="color: var(--text-muted); margin-bottom: 20px;">Create your first general announcement to get started.</p>
                                <a href="{{ route('mwenyekiti.matangazo.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Create First Announcement
                                </a>
                            </div>
                        @endforelse

                        @if($generalAnnouncements->hasPages())
                            <div style="margin-top: 20px;">
                                {{ $generalAnnouncements->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>

                    <!-- Meeting Announcements Tab -->
                    <div id="meeting-tab" class="tab-content">
                        @forelse($meetingAnnouncements as $announcement)
                            <div class="announcement-card">
                                <div class="announcement-header">
                                    <div>
                                        <div class="announcement-title">{{ $announcement->title }}</div>
                                        <div class="announcement-meta">
                                            <span><i class="fas fa-calendar"></i> {{ $announcement->created_at->format('d/m/Y') }}</span>
                                            <span><i class="fas fa-map-marker-alt"></i> {{ $announcement->mtaa }}</span>
                                            @if($announcement->mtaaMeeting)
                                                <span><i class="fas fa-clock"></i> Meeting: {{ $announcement->mtaaMeeting->meeting_date->format('d/m/Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="announcement-content">
                                    {{ Str::limit($announcement->content, 150) }}
                                </div>

                                <div class="announcement-actions">
                                    <a href="{{ route('mwenyekiti.matangazo.show', ['id' => $announcement->id, 'type' => 'meeting']) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                    <a href="{{ route('mwenyekiti.matangazo.edit', ['id' => $announcement->id, 'type' => 'meeting']) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('mwenyekiti.matangazo.destroy', ['id' => $announcement->id, 'type' => 'meeting']) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px;">
                                <i class="fas fa-calendar-alt" style="font-size: 48px; color: var(--text-muted); margin-bottom: 15px;"></i>
                                <h3>No Meeting Announcements Yet</h3>
                                <p style="color: var(--text-muted); margin-bottom: 20px;">Create announcements for your upcoming meetings.</p>
                                <a href="{{ route('mwenyekiti.matangazo.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Create Meeting Announcement
                                </a>
                            </div>
                        @endforelse

                        @if($meetingAnnouncements->hasPages())
                            <div style="margin-top: 20px;">
                                {{ $meetingAnnouncements->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>

    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.add('active');
            
            // Add active class to clicked button
            event.target.closest('.tab-button').classList.add('active');
        }

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