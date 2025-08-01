<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Details | Prototype System</title>
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
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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

        .detail-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-muted);
        }

        .detail-value {
            color: var(--text-color);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
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

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: var(--radius-md);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.scheduled {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .status-badge.completed {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-badge.upcoming {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .outcome-form {
            background-color: #f8fafc;
            padding: 20px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
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

        /* Mobile Responsiveness */
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

            .detail-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .page-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .btn-group {
                flex-wrap: wrap;
            }
        }

        /* Sidebar Overlay for Mobile */
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
                    <h2 class="dashboard-title">Meeting Details</h2>
                    <div class="btn-group">
                        @if(!$meeting->outcome && $meeting->meeting_date <= now())
                            <button onclick="toggleOutcomeForm()" class="btn btn-success">
                                <i class="fas fa-pen"></i>
                                Record Outcome
                            </button>
                        @endif
                        @if(!$meeting->outcome)
                            <a href="{{ route('mwenyekiti.meetings.edit', $meeting->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                                Edit Meeting
                            </a>
                        @endif
                        <a href="{{ route('mwenyekiti.meetings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Back to List
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Meeting Details -->
                <div class="detail-container">
                    <h3 class="section-title">Meeting Information</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">Meeting ID:</div>
                        <div class="detail-value">#MTG-{{ str_pad($meeting->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Title (English):</div>
                        <div class="detail-value">{{ $meeting->title }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Kichwa (Kiswahili):</div>
                        <div class="detail-value">{{ $meeting->title_sw }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Meeting Date:</div>
                        <div class="detail-value">{{ $meeting->meeting_date->format('d/m/Y') }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Location (Mtaa):</div>
                        <div class="detail-value">{{ $meeting->mtaa }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Status:</div>
                        <div class="detail-value">
                            @if($meeting->outcome)
                                <span class="status-badge completed">Completed</span>
                            @elseif($meeting->meeting_date > now())
                                <span class="status-badge upcoming">Upcoming</span>
                            @else
                                <span class="status-badge scheduled">Scheduled</span>
                            @endif
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Organizer:</div>
                        <div class="detail-value">{{ $meeting->organizer->first_name }} {{ $meeting->organizer->last_name }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Created:</div>
                        <div class="detail-value">{{ $meeting->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>

                <!-- Meeting Agenda -->
                <div class="detail-container">
                    <h3 class="section-title">Meeting Agenda</h3>
                    <div style="line-height: 1.6; white-space: pre-line;">{{ $meeting->agenda }}</div>
                </div>

                <!-- Meeting Outcome (if exists) -->
                @if($meeting->outcome)
                    <div class="detail-container">
                        <h3 class="section-title">Meeting Outcome</h3>
                        <div style="line-height: 1.6; white-space: pre-line;">{{ $meeting->outcome }}</div>
                    </div>
                @endif

                <!-- Record Outcome Form (hidden by default) -->
                @if(!$meeting->outcome && $meeting->meeting_date <= now())
                    <div id="outcomeForm" class="detail-container" style="display: none;">
                        <h3 class="section-title">Record Meeting Outcome</h3>
                        <div class="outcome-form">
                            <form action="{{ route('mwenyekiti.meetings.record-outcome', $meeting->id) }}" method="POST">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="outcome">Meeting Outcome & Results</label>
                                    <textarea id="outcome" name="outcome" class="form-control" rows="6" 
                                              placeholder="Record what was discussed, decisions made, and action items..." required></textarea>
                                    <small style="color: var(--text-muted);">
                                        Include key decisions, action items, and next steps
                                    </small>
                                </div>

                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i>
                                        Record Outcome
                                    </button>
                                    <button type="button" onclick="toggleOutcomeForm()" class="btn btn-secondary">
                                        <i class="fas fa-times"></i>
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>

    <script>
        function toggleOutcomeForm() {
            const form = document.getElementById('outcomeForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
                form.scrollIntoView({ behavior: 'smooth' });
            } else {
                form.style.display = 'none';
            }
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