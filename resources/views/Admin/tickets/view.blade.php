<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket #{{ $ticket->ticket_number }} | Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: rgba(79, 70, 229, 0.1);
            --secondary-color: #f8fafc;
            --text-color: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid var(--border-color);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: all 0.3s ease;
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
            background: white;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-color);
            font-weight: 700;
            font-size: 18px;
        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            border-radius: 8px;
            font-size: 16px;
        }

        .logo-text {
            transition: opacity 0.3s ease;
            white-space: nowrap;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
        }

        .sidebar-nav {
            padding: 20px 0;
            height: calc(100vh - var(--header-height));
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .nav-section-title {
            padding: 0 20px 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.5px;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
            margin: 2px 0;
        }

        .nav-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary-color);
            font-weight: 500;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary-color);
        }

        .nav-icon {
            width: 20px;
            margin-right: 12px;
            font-size: 16px;
            text-align: center;
        }

        .nav-text {
            transition: opacity 0.3s ease;
            white-space: nowrap;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--primary-color);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-badge {
            opacity: 0;
        }

        .sidebar-toggle {
            position: absolute;
            top: 20px;
            right: -12px;
            width: 24px;
            height: 24px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            border: 2px solid white;
            transition: transform 0.3s ease;
        }

        .sidebar-toggle i {
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .content-header {
            background: white;
            padding: 20px 30px;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: var(--shadow-sm);
        }

        .content-body {
            padding: 30px;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-color);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary { background: var(--primary-color); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-secondary { background: white; color: var(--text-color); border: 1px solid var(--border-color); }
        .btn-success { background: var(--success-color); color: white; }
        .btn-warning { background: var(--warning-color); color: white; }
        .btn-danger { background: var(--error-color); color: white; }

        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            background: var(--secondary-color);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .card-body {
            padding: 24px;
        }

        .ticket-header {
            padding: 30px 24px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
        }

        .ticket-number {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .ticket-title {
            font-size: 20px;
            font-weight: 500;
            opacity: 0.95;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .meta-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .meta-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            width: fit-content;
        }

        .badge-status-open { background: #fef3c7; color: #92400e; }
        .badge-status-in_progress { background: #dbeafe; color: #1e40af; }
        .badge-status-resolved { background: #d1fae5; color: #065f46; }
        .badge-status-closed { background: #f3f4f6; color: #374151; }

        .badge-priority-low { background: #d1fae5; color: #065f46; }
        .badge-priority-medium { background: #fef3c7; color: #92400e; }
        .badge-priority-high { background: #fed7aa; color: #9a3412; }
        .badge-priority-urgent { background: #fee2e2; color: #991b1b; }

        .description {
            background: var(--secondary-color);
            padding: 20px;
            border-radius: var(--radius-md);
            white-space: pre-wrap;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .attachments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }

        .attachment-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--secondary-color);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--text-color);
            transition: all 0.2s;
        }

        .attachment-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        .attachment-icon {
            font-size: 20px;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .creator-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: var(--secondary-color);
            border-radius: var(--radius-md);
            margin-bottom: 20px;
        }

        .creator-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .admin-response {
            background: #f0f9ff;
            border-left: 4px solid var(--info-color);
            padding: 20px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
        }

        .response-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            color: var(--info-color);
            font-weight: 600;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .content-body {
                padding: 20px;
            }

            .main-grid {
                grid-template-columns: 1fr;
            }
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
            <div class="content-header">
                <div class="header-content">
                    <div style="display: flex; align-items: center;">
                        <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div>
                            <h1 class="page-title">Ticket Details</h1>
                            <div class="breadcrumb">
                                <a href="{{ route('admin.tickets.index') }}">Tickets</a>
                                <span>/</span>
                                <span>#{{ $ticket->ticket_number }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Back to Tickets
                        </a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul style="margin: 8px 0 0 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="main-grid">
                    <!-- Main Content -->
                    <div>
                        <!-- Ticket Info -->
                        <div class="card">
                            <div class="ticket-header">
                                <div class="ticket-number">#{{ $ticket->ticket_number }}</div>
                                <div class="ticket-title">{{ $ticket->subject }}</div>
                            </div>

                            <div class="card-body">
                                <div class="meta-grid">
                                    <div class="meta-item">
                                        <div class="meta-label">Status</div>
                                        <div class="meta-value">
                                            <span class="badge badge-status-{{ $ticket->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">Priority</div>
                                        <div class="meta-value">
                                            <span class="badge badge-priority-{{ $ticket->priority }}">
                                                {{ ucfirst($ticket->priority) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">Created At</div>
                                        <div class="meta-value">{{ $ticket->created_at->format('M d, Y H:i') }}</div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">Last Updated</div>
                                        <div class="meta-value">{{ $ticket->updated_at->format('M d, Y H:i') }}</div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">User Type</div>
                                        <div class="meta-value">{{ ucfirst($ticket->user_type) }}</div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">Assigned To</div>
                                        <div class="meta-value">{{ $ticket->assignedAdmin ? $ticket->assignedAdmin->name : 'Unassigned' }}</div>
                                    </div>
                                </div>

                                <!-- Creator Info -->
                                @if($creator)
                                    <div class="creator-info">
                                        <div class="creator-avatar">
                                            {{ strtoupper(substr($creator->name ?? $creator->jina ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight: 600;">{{ $creator->name ?? $creator->jina ?? 'Unknown User' }}</div>
                                            <div style="font-size: 12px; color: var(--text-muted);">
                                                {{ ucfirst($ticket->user_type) }}
                                                @if(isset($creator->email))
                                                    • {{ $creator->email }}
                                                @endif
                                                @if(isset($creator->simu))
                                                    • {{ $creator->simu }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Description -->
                                <h3 style="margin-bottom: 12px;">Description</h3>
                                <div class="description">{{ $ticket->description }}</div>

                                <!-- Attachments -->
                                @if($ticket->attachments && count(json_decode($ticket->attachments, true)) > 0)
                                    <h3 style="margin-bottom: 12px;">Attachments</h3>
                                    <div class="attachments-grid">
                                        @foreach(json_decode($ticket->attachments, true) as $index => $attachment)
                                            <a href="{{ route('tickets.download-attachment', [$ticket->id, $index]) }}" class="attachment-item">
                                                <div class="attachment-icon">
                                                    <i class="fas fa-file"></i>
                                                </div>
                                                <div>
                                                    <div style="font-weight: 500;">{{ $attachment['original_name'] }}</div>
                                                    <div style="font-size: 12px; color: var(--text-muted);">
                                                        {{ number_format($attachment['size'] / 1024, 1) }} KB
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Admin Response -->
                                @if($ticket->admin_response)
                                    <div class="admin-response">
                                        <div class="response-header">
                                            <div>
                                                <i class="fas fa-reply"></i>
                                                Admin Response
                                            </div>
                                            <div style="font-size: 12px; font-weight: normal;">
                                                {{ $ticket->updated_at->format('M d, Y H:i') }}
                                            </div>
                                        </div>
                                        <div>{{ $ticket->admin_response }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Actions -->
                    <div>
                        <!-- Assignment -->
                        <div class="card" style="margin-bottom: 24px;">
                            <div class="card-header">
                                <h3 class="card-title">Assignment</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.tickets.assign', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Assign to Admin</label>
                                        <select name="assigned_to" class="form-control" required>
                                            <option value="">Select Admin</option>
                                            @foreach($admins as $admin)
                                                <option value="{{ $admin->id }}" {{ $ticket->assigned_to == $admin->id ? 'selected' : '' }}>
                                                    {{ $admin->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                                        <i class="fas fa-user-plus"></i>
                                        Assign Ticket
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Status Update -->
                        <div class="card" style="margin-bottom: 24px;">
                            <div class="card-header">
                                <h3 class="card-title">Update Status</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.tickets.update-status', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Resolution (if resolving)</label>
                                        <textarea name="admin_response" class="form-control" placeholder="Describe how this ticket was resolved...">{{ $ticket->admin_response }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success" style="width: 100%;">
                                        <i class="fas fa-save"></i>
                                        Update Status
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Admin Response -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Response</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.tickets.respond', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Your Response</label>
                                        <textarea name="admin_response" class="form-control" rows="4" placeholder="Write your response to the user..." required>{{ $ticket->admin_response }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                                        <i class="fas fa-reply"></i>
                                        Send Response
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <script>
        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Desktop sidebar toggle
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                });
            }

            // Mobile menu toggle
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-open');
                    sidebarOverlay.classList.toggle('active');
                });
            }

            // Close sidebar when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('active');
                });
            }
        });

        // Auto-resize textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });

        // Confirmation for status changes
        document.querySelector('form[action*="update-status"]').addEventListener('submit', function(e) {
            const status = this.querySelector('select[name="status"]').value;
            if (status === 'closed') {
                if (!confirm('Are you sure you want to close this ticket? This action cannot be undone.')) {
                    e.preventDefault();
                }
            }
        });
    </script>
</body>
</html>