<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Management | Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee545;
            --primary-hover: #4ee546;
            --primary-light: rgba(70, 229, 118, 0.1);
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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid var(--border-color);
            background: white;
            position: relative;
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
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }

        .sidebar.collapsed .logo-text {
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
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 101;
        }

        .sidebar-toggle i {
            font-size: 12px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        /* Sidebar Menu */
        .sidebar-menu {
            padding: 20px 0;
            height: calc(100vh - var(--header-height));
            overflow-y: auto;
            overflow-x: hidden;
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .menu-section-title {
            padding: 0 20px 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.5px;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed .menu-section-title {
            opacity: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin: 2px 0;
        }

        .menu-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        .menu-item.active {
            background: var(--primary-light);
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
            background: var(--primary-color);
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            font-size: 16px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-text {
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            flex: 1;
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
        }

        /* Tooltip for collapsed sidebar */
        .sidebar.collapsed .menu-item {
            position: relative;
        }

        .sidebar.collapsed .menu-item:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
            margin-left: 10px;
            pointer-events: none;
        }

        .sidebar.collapsed .menu-item:hover::before {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: rgba(0, 0, 0, 0.8);
            margin-left: 5px;
            z-index: 1000;
            pointer-events: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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

        .header-actions {
            display: flex;
            gap: 12px;
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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Custom Scrollbar */
        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 2px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
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

            .sidebar-toggle {
                display: none;
            }
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none !important;
            }
        }

        /* Button Styles */
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

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: white;
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .stat-title {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .stat-icon.blue { background: #dbeafe; color: #3b82f6; }
        .stat-icon.yellow { background: #fef3c7; color: #f59e0b; }
        .stat-icon.green { background: #d1fae5; color: #10b981; }
        .stat-icon.gray { background: #f3f4f6; color: #6b7280; }
        .stat-icon.red { background: #fee2e2; color: #ef4444; }

        /* Filters */
        .filters-container {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-control {
            padding: 8px 12px;
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

        /* Tickets Table */
        .tickets-container {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .bulk-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .tickets-table {
            width: 100%;
            border-collapse: collapse;
        }

        .tickets-table th,
        .tickets-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .tickets-table th {
            background: var(--secondary-color);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .tickets-table tbody tr:hover {
            background: var(--secondary-color);
        }

        .ticket-number {
            font-weight: 600;
            color: var(--primary-color);
        }

        .ticket-title {
            font-weight: 500;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
        }

        .badge-status-open { background: #fef3c7; color: #92400e; }
        .badge-status-in_progress { background: #dbeafe; color: #1e40af; }
        .badge-status-resolved { background: #d1fae5; color: #065f46; }
        .badge-status-closed { background: #f3f4f6; color: #374151; }

        .badge-priority-low { background: #d1fae5; color: #065f46; }
        .badge-priority-medium { background: #fef3c7; color: #92400e; }
        .badge-priority-high { background: #fed7aa; color: #9a3412; }
        .badge-priority-urgent { background: #fee2e2; color: #991b1b; }

        .actions {
            display: flex;
            gap: 8px;
        }

        .pagination-wrapper {
            padding: 20px 24px;
            border-top: 1px solid var(--border-color);
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

        .checkbox {
            width: 16px;
            height: 16px;
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

            .sidebar-toggle {
                display: none;
            }
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none !important;
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
                        <h1 class="page-title">Tickets Management</h1>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('admin.tickets.export', request()->query()) }}" class="btn btn-secondary">
                            <i class="fas fa-download"></i>
                            Export CSV
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

                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <div class="stat-title">Total Tickets</div>
                                <div class="stat-value">{{ $stats['total'] }}</div>
                            </div>
                            <div class="stat-icon blue">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <div class="stat-title">Open</div>
                                <div class="stat-value">{{ $stats['open'] }}</div>
                            </div>
                            <div class="stat-icon yellow">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <div class="stat-title">In Progress</div>
                                <div class="stat-value">{{ $stats['in_progress'] }}</div>
                            </div>
                            <div class="stat-icon blue">
                                <i class="fas fa-cog"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <div class="stat-title">Resolved</div>
                                <div class="stat-value">{{ $stats['resolved'] }}</div>
                            </div>
                            <div class="stat-icon green">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <div class="stat-title">Unassigned</div>
                                <div class="stat-value">{{ $stats['unassigned'] }}</div>
                            </div>
                            <div class="stat-icon gray">
                                <i class="fas fa-user-slash"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <div class="stat-title">High Priority</div>
                                <div class="stat-value">{{ $stats['high_priority'] }}</div>
                            </div>
                            <div class="stat-icon red">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filters-container">
                    <form method="GET" id="filters-form">
                        <div class="filters-grid">
                            <div class="form-group">
                                <label class="form-label">Search</label>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Ticket number, title, or description..." 
                                       value="{{ request('search') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Priority</label>
                                <select name="priority" class="form-control">
                                    <option value="">All Priorities</option>
                                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">User Type</label>
                                <select name="user_type" class="form-control">
                                    <option value="">All User Types</option>
                                    <option value="balozi" {{ request('user_type') == 'balozi' ? 'selected' : '' }}>Balozi</option>
                                    <option value="mwenyekiti" {{ request('user_type') == 'mwenyekiti' ? 'selected' : '' }}>Mwenyekiti</option>
                                    <option value="admin" {{ request('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Assigned To</label>
                                <select name="assigned_to" class="form-control">
                                    <option value="">All Admins</option>
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}" {{ request('assigned_to') == $admin->id ? 'selected' : '' }}>
                                            {{ $admin->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Date From</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Date To</label>
                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>

                            <div class="form-group" style="align-self: end;">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tickets Table -->
                <div class="tickets-container">
                    <div class="table-header">
                        <h3>Tickets ({{ $tickets->total() }})</h3>
                        <div class="bulk-actions">
                            <button type="button" class="btn btn-sm btn-secondary" onclick="toggleBulkActions()">
                                <i class="fas fa-tasks"></i>
                                Bulk Actions
                            </button>
                        </div>
                    </div>

                    <!-- Bulk Actions Form -->
                    <form id="bulk-form" action="{{ route('admin.tickets.bulk-action') }}" method="POST" style="display: none;">
                        @csrf
                        <div style="padding: 16px 24px; background: #f8fafc; border-bottom: 1px solid var(--border-color);">
                            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                                <select name="action" class="form-control" style="width: auto;">
                                    <option value="">Choose Action</option>
                                    <option value="assign">Assign to Admin</option>
                                    <option value="status_change">Change Status</option>
                                    <option value="delete">Delete</option>
                                </select>
                                
                                <select name="assigned_to" class="form-control" style="width: auto; display: none;" id="assign-select">
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                
                                <select name="new_status" class="form-control" style="width: auto; display: none;" id="status-select">
                                    <option value="open">Open</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="closed">Closed</option>
                                </select>
                                
                                <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                                <button type="button" class="btn btn-sm btn-secondary" onclick="toggleBulkActions()">Cancel</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="tickets-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all" class="checkbox"></th>
                                    <th>Ticket #</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>User Type</th>
                                    <th>Assigned To</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tickets as $ticket)
                                    <tr>
                                        <td><input type="checkbox" name="tickets[]" value="{{ $ticket->id }}" class="checkbox ticket-checkbox"></td>
                                        <td class="ticket-number">{{ $ticket->ticket_number }}</td>
                                        <td class="ticket-title" title="{{ $ticket->subject }}">{{ $ticket->subject }}</td>
                                        <td>
                                            <span class="badge badge-status-{{ $ticket->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-priority-{{ $ticket->priority }}">
                                                {{ ucfirst($ticket->priority) }}
                                            </span>
                                        </td>
                                        <td>{{ ucfirst($ticket->user_type) }}</td>
                                        <td>{{ $ticket->assignedAdmin ? $ticket->assignedAdmin->name : 'Unassigned' }}</td>
                                        <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" style="text-align: center; padding: 40px;">
                                            <i class="fas fa-inbox" style="font-size: 48px; color: var(--text-muted); margin-bottom: 16px;"></i>
                                            <p>No tickets found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($tickets->hasPages())
                        <div class="pagination-wrapper">
                            {{ $tickets->appends(request()->query())->links() }}
                        </div>
                    @endif
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

        // Bulk actions toggle
        function toggleBulkActions() {
            const form = document.getElementById('bulk-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        // Select all checkboxes
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.ticket-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        // Show/hide additional fields based on bulk action
        document.querySelector('select[name="action"]').addEventListener('change', function() {
            const assignSelect = document.getElementById('assign-select');
            const statusSelect = document.getElementById('status-select');
            
            assignSelect.style.display = 'none';
            statusSelect.style.display = 'none';
            
            if (this.value === 'assign') {
                assignSelect.style.display = 'block';
            } else if (this.value === 'status_change') {
                statusSelect.style.display = 'block';
            }
        });

        // Auto-submit on filter change (optional)
        document.querySelectorAll('select[name="status"], select[name="priority"], select[name="user_type"], select[name="assigned_to"]').forEach(select => {
            select.addEventListener('change', function() {
                document.getElementById('filters-form').submit();
            });
        });
    </script>
</body>
</html>