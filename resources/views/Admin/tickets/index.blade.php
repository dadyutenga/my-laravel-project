<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Management | Admin Dashboard</title>
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
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
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

        @media (max-width: 768px) {
            .container { padding: 12px; }
            .filters-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <h1 class="page-title">Tickets Management</h1>
                <div class="header-actions">
                    <a href="{{ route('admin.tickets.export', request()->query()) }}" class="btn btn-secondary">
                        <i class="fas fa-download"></i>
                        Export CSV
                    </a>
                </div>
            </div>
        </div>

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
                                <td class="ticket-title" title="{{ $ticket->subject }}">{{ $ticket->subject }}</td> <!-- Changed from title to subject -->
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

    <script>
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