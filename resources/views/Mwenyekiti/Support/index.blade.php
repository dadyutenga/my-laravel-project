<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maombi ya Msaada | Mwenyekiti Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #4ee546;
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --support-color: #8b5cf6;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
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
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* SIDEBAR STYLES */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid var(--border-color);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 100;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-color);
            transition: var(--transition);
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 8px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .sidebar-toggle:hover {
            background: var(--secondary-color);
            color: var(--text-color);
        }

        .sidebar-toggle i {
            font-size: 16px;
            transition: var(--transition);
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-section {
            margin-bottom: 24px;
        }

        .menu-section-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 20px;
            margin-bottom: 8px;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-section-title {
            display: none;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: var(--transition);
            border-right: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(79, 70, 229, 0.05);
            color: var(--primary-color);
        }

        .menu-item.active {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
            border-right-color: var(--primary-color);
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .menu-text {
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-text {
            display: none;
        }

        .sidebar.collapsed .menu-item {
            padding: 12px;
            justify-content: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }

        .content-area {
            padding: 24px;
            max-width: 100%;
        }

        /* Mobile Header */
        .mobile-header {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: white;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .mobile-menu-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-color);
            cursor: pointer;
        }

        /* Page Header */
        .page-header {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-left {
            flex: 1;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 14px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            text-align: center;
            transition: var(--transition);
            border-left: 4px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card.total {
            border-left-color: var(--support-color);
        }

        .stat-card.open {
            border-left-color: var(--info-color);
        }

        .stat-card.progress {
            border-left-color: var(--warning-color);
        }

        .stat-card.resolved {
            border-left-color: var(--success-color);
        }

        .stat-card.urgent {
            border-left-color: var(--error-color);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 20px;
            color: white;
        }

        .stat-card.total .stat-icon {
            background: var(--support-color);
        }

        .stat-card.open .stat-icon {
            background: var(--info-color);
        }

        .stat-card.progress .stat-icon {
            background: var(--warning-color);
        }

        .stat-card.resolved .stat-icon {
            background: var(--success-color);
        }

        .stat-card.urgent .stat-icon {
            background: var(--error-color);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Filters Section */
        .filters-section {
            background: white;
            padding: 20px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .filters-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 16px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .filter-input,
        .filter-select {
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .filter-input:focus,
        .filter-select:focus {
            outline: none;
            border-color: var(--support-color);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        /* Tickets Table */
        .tickets-section {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .section-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .section-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            flex: 1;
        }

        .table-container {
            overflow-x: auto;
        }

        .tickets-table {
            width: 100%;
            border-collapse: collapse;
        }

        .tickets-table th,
        .tickets-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .tickets-table th {
            background: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
        }

        .tickets-table td {
            font-size: 14px;
        }

        .tickets-table tr:hover {
            background: rgba(139, 92, 246, 0.05);
        }

        /* Status and Priority Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .badge.status-open {
            background: rgba(59, 130, 246, 0.1);
            color: #1d4ed8;
        }

        .badge.status-in_progress {
            background: rgba(245, 158, 11, 0.1);
            color: #b45309;
        }

        .badge.status-resolved {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
        }

        .badge.status-closed {
            background: rgba(107, 114, 128, 0.1);
            color: #374151;
        }

        .badge.priority-low {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
        }

        .badge.priority-medium {
            background: rgba(245, 158, 11, 0.1);
            color: #b45309;
        }

        .badge.priority-high {
            background: rgba(251, 146, 60, 0.1);
            color: #c2410c;
        }

        .badge.priority-urgent {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        /* Action Buttons */
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .btn-primary {
            background: var(--support-color);
            color: white;
        }

        .btn-primary:hover {
            background: #7c3aed;
        }

        .btn-secondary {
            background: var(--border-color);
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background: var(--text-muted);
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn-group {
            display: flex;
            gap: 4px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state h3 {
            margin-bottom: 8px;
            color: var(--text-color);
            font-size: 18px;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success {
            background: #d1fae5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fca5a5;
        }

        /* Truncate Text */
        .truncate {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-width);
                transform: translateX(-100%);
                z-index: 1001;
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar.collapsed ~ .main-content {
                margin-left: 0;
                width: 100%;
            }

            .mobile-header {
                display: flex;
            }

            .content-area {
                padding: 16px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .header-top {
                flex-direction: column;
                align-items: stretch;
            }

            .filters-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .table-container {
                font-size: 12px;
            }

            .tickets-table th,
            .tickets-table td {
                padding: 8px;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
            }

            .sidebar.mobile-open ~ .sidebar-overlay {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Include Shared Sidebar -->
        @include('Mwenyekiti.shared.sidebar-menu')

        <!-- Mobile Header -->
        <div class="mobile-header">
            <button class="mobile-menu-btn" id="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Maombi ya Msaada</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-top">
                        <div class="header-left">
                            <h1 class="page-title">Maombi ya Msaada</h1>
                            <p class="page-subtitle">Omba msaada kutoka kwa timu ya uongozi na fuatilia maombi yako</p>
                        </div>
                        <div class="header-actions">
                            <a href="{{ route('mwenyekiti.support.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Ombi Jipya
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
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

                <!-- Statistics Grid -->
                <div class="stats-grid">
                    <div class="stat-card total">
                        <div class="stat-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['total']) }}</div>
                        <div class="stat-label">Jumla ya Maombi</div>
                    </div>

                    <div class="stat-card open">
                        <div class="stat-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['open']) }}</div>
                        <div class="stat-label">Maombi Mapya</div>
                    </div>

                    <div class="stat-card progress">
                        <div class="stat-icon">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['in_progress']) }}</div>
                        <div class="stat-label">Yanayofanyiwa Kazi</div>
                    </div>

                    <div class="stat-card resolved">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['resolved']) }}</div>
                        <div class="stat-label">Yaliyotatuliwa</div>
                    </div>

                    @if($stats['urgent'] > 0)
                        <div class="stat-card urgent">
                            <div class="stat-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="stat-number">{{ number_format($stats['urgent']) }}</div>
                            <div class="stat-label">Ya Haraka</div>
                        </div>
                    @endif
                </div>

                <!-- Search and Filters -->
                <div class="filters-section">
                    <form method="GET" action="{{ route('mwenyekiti.support.index') }}">
                        <div class="filters-row">
                            <div class="filter-group">
                                <label class="filter-label">Tafuta</label>
                                <input type="text" name="search" class="filter-input" 
                                       placeholder="Tafuta katika kichwa au maelezo..."
                                       value="{{ request('search') }}">
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Hali</label>
                                <select name="status" class="filter-select">
                                    <option value="">Hali zote</option>
                                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Mapya</option>
                                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Yanayofanyiwa Kazi</option>
                                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Yaliyotatuliwa</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Yamefungwa</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Kipaumbele</label>
                                <select name="priority" class="filter-select">
                                    <option value="">Vipimo vyote</option>
                                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Chini</option>
                                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Wastani</option>
                                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Juu</option>
                                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Haraka</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Tafuta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tickets Table -->
                @if($tickets->count() > 0)
                    <div class="tickets-section">
                        <div class="section-header">
                            <h3>Maombi ya Msaada ({{ $tickets->total() }})</h3>
                        </div>

                        <div class="table-container">
                            <table class="tickets-table">
                                <thead>
                                    <tr>
                                        <th>Nambari</th>
                                        <th>Kichwa</th>
                                        <th>Hali</th>
                                        <th>Kipaumbele</th>
                                        <th>Tarehe</th>
                                        <th>Vitendo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>
                                                <strong>{{ $ticket->ticket_number }}</strong>
                                            </td>
                                            <td>
                                                <div class="truncate" title="{{ $ticket->title }}">
                                                    {{ $ticket->title }}
                                                </div>
                                                @if($ticket->assignedAdmin)
                                                    <small style="color: var(--text-muted);">
                                                        Amepewa: {{ $ticket->assignedAdmin->name }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge status-{{ $ticket->status }}">
                                                    @if($ticket->status == 'open')
                                                        <i class="fas fa-folder-open"></i> Mapya
                                                    @elseif($ticket->status == 'in_progress')
                                                        <i class="fas fa-spinner"></i> Yanafanyiwa Kazi
                                                    @elseif($ticket->status == 'resolved')
                                                        <i class="fas fa-check-circle"></i> Yametatuliwa
                                                    @else
                                                        <i class="fas fa-times-circle"></i> Yamefungwa
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge priority-{{ $ticket->priority }}">
                                                    @if($ticket->priority == 'low')
                                                        <i class="fas fa-arrow-down"></i> Chini
                                                    @elseif($ticket->priority == 'medium')
                                                        <i class="fas fa-minus"></i> Wastani
                                                    @elseif($ticket->priority == 'high')
                                                        <i class="fas fa-arrow-up"></i> Juu
                                                    @else
                                                        <i class="fas fa-exclamation"></i> Haraka
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <strong>{{ $ticket->created_at->format('d/m/Y') }}</strong>
                                                <br>
                                                <small style="color: var(--text-muted);">
                                                    {{ $ticket->created_at->format('H:i') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('mwenyekiti.support.show', $ticket->id) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($ticket->status == 'open')
                                                        <a href="{{ route('mwenyekiti.support.edit', $ticket->id) }}" 
                                                           class="btn btn-secondary btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @if($ticket->status == 'resolved')
                                                        <form method="POST" 
                                                              action="{{ route('mwenyekiti.support.close', $ticket->id) }}" 
                                                              style="display: inline;"
                                                              onsubmit="return confirm('Je, una uhakika ombi limetatuliwa vizuri?')">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-secondary btn-sm">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($tickets->hasPages())
                            <div style="padding: 20px; display: flex; justify-content: center;">
                                {{ $tickets->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <div class="tickets-section">
                        <div class="empty-state">
                            <i class="fas fa-headset"></i>
                            <h3>Hakuna Maombi ya Msaada</h3>
                            <p>
                                @if(request()->hasAny(['search', 'status', 'priority']))
                                    Hakuna maombi yanayolingana na utafutaji wako
                                @else
                                    Hujaomba msaada wowote bado
                                @endif
                            </p>
                            @if(!request()->hasAny(['search', 'status', 'priority']))
                                <br>
                                <a href="{{ route('mwenyekiti.support.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Omba Msaada wa Kwanza
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
    </div>

    <script>
        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Desktop sidebar toggle
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                });
            }

            // Mobile menu toggle
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-open');
                });
            }

            // Close mobile menu when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                });
            }

            // Auto-submit search form with debounce
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                let timeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        this.form.submit();
                    }, 500);
                });
            }

            // Auto-submit select filters
            const selectFilters = document.querySelectorAll('select[name="status"], select[name="priority"]');
            selectFilters.forEach(select => {
                select.addEventListener('change', function() {
                    this.form.submit();
                });
            });
        });
    </script>
</body>
</html>