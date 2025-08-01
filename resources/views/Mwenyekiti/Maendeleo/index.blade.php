<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maendeleo ya Kila Siku | Mwenyekiti Dashboard</title>
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
            --success-color: #37b025;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --green-color: #059669;
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

        .sidebar.collapsed .menu-icon {
            margin-right: 0;
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
            width: 100%;
            margin: 0;
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

        .stat-card.own {
            border-left-color: var(--green-color);
        }

        .stat-card.balozi {
            border-left-color: var(--primary-color);
        }

        .stat-card.month {
            border-left-color: var(--success-color);
        }

        .stat-card.total {
            border-left-color: var(--warning-color);
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

        .stat-card.own .stat-icon {
            background: var(--green-color);
        }

        .stat-card.balozi .stat-icon {
            background: var(--primary-color);
        }

        .stat-card.month .stat-icon {
            background: var(--success-color);
        }

        .stat-card.total .stat-icon {
            background: var(--warning-color);
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

        /* View Type Tabs */
        .view-tabs {
            background: white;
            padding: 20px 24px 0;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .tab-buttons {
            display: flex;
            gap: 8px;
            border-bottom: 1px solid var(--border-color);
        }

        .tab-button {
            padding: 12px 20px;
            border: none;
            background: none;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .tab-button:hover {
            color: var(--text-color);
            background: var(--secondary-color);
        }

        .tab-button.active {
            color: var(--green-color);
            border-bottom-color: var(--green-color);
        }

        /* Balozi Selection */
        .balozi-selection {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .selection-header {
            margin-bottom: 20px;
        }

        .selection-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .balozi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .balozi-card {
            padding: 20px;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
            position: relative;
        }

        .balozi-card:hover {
            border-color: var(--green-color);
            background: rgba(5, 150, 105, 0.05);
            transform: translateY(-2px);
        }

        .balozi-card.selected {
            border-color: var(--green-color);
            background: rgba(5, 150, 105, 0.05);
        }

        .balozi-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .balozi-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--green-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
        }

        .balozi-details h4 {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .balozi-meta {
            font-size: 14px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .record-count {
            background: var(--green-color);
            color: white;
            padding: 2px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Search and Filters */
        .filters-section {
            background: white;
            padding: 20px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .filters-row {
            display: grid;
            grid-template-columns: 2fr 1fr auto;
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
            border-color: var(--green-color);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }

        /* Maendeleo Table */
        .maendeleo-section {
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

        .maendeleo-table {
            width: 100%;
            border-collapse: collapse;
        }

        .maendeleo-table th,
        .maendeleo-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .maendeleo-table th {
            background: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
        }

        .maendeleo-table td {
            font-size: 14px;
        }

        .maendeleo-table tr:hover {
            background: rgba(5, 150, 105, 0.05);
        }

        /* Date Badge */
        .date-badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            background: rgba(5, 150, 105, 0.1);
            color: var(--green-color);
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
            background: var(--green-color);
            color: white;
        }

        .btn-primary:hover {
            background: #047857;
        }

        .btn-secondary {
            background: var(--border-color);
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background: var(--text-muted);
            color: white;
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-danger {
            background: var(--error-color);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
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

        /* Pagination */
        .pagination-wrapper {
            padding: 20px;
            display: flex;
            justify-content: center;
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

            .balozi-grid {
                grid-template-columns: 1fr;
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

            .maendeleo-table th,
            .maendeleo-table td {
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
            <h1>Maendeleo ya Kila Siku</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-top">
                        <div class="header-left">
                            <h1 class="page-title">Maendeleo ya Kila Siku</h1>
                            <p class="page-subtitle">Dhibiti maendeleo yako na uangalie yale ya Balozi wako</p>
                        </div>
                        <div class="header-actions">
                            <a href="{{ route('mwenyekiti.maendeleo.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Ongeza Maendeleo
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
                    <div class="stat-card own">
                        <div class="stat-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['own_total']) }}</div>
                        <div class="stat-label">Maendeleo Yangu</div>
                    </div>

                    <div class="stat-card balozi">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['balozi_total']) }}</div>
                        <div class="stat-label">Maendeleo ya Balozi</div>
                    </div>

                    <div class="stat-card month">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['own_this_month'] + $stats['balozi_this_month']) }}</div>
                        <div class="stat-label">Mwezi Huu</div>
                    </div>

                    <div class="stat-card total">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['total_all']) }}</div>
                        <div class="stat-label">Jumla Yote</div>
                    </div>
                </div>

                <!-- View Type Tabs -->
                <div class="view-tabs">
                    <div class="tab-buttons">
                        <a href="{{ route('mwenyekiti.maendeleo.index', ['view_type' => 'mine']) }}" 
                           class="tab-button {{ $viewType === 'mine' ? 'active' : '' }}">
                            <i class="fas fa-user"></i>
                            Maendeleo Yangu ({{ $stats['own_total'] }})
                        </a>
                        <a href="{{ route('mwenyekiti.maendeleo.index', ['view_type' => 'balozi']) }}" 
                           class="tab-button {{ $viewType === 'balozi' ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            Maendeleo ya Balozi ({{ $stats['balozi_total'] }})
                        </a>
                    </div>
                </div>

                <!-- Balozi Selection (Only for Balozi view) -->
                @if($viewType === 'balozi')
                    <div class="balozi-selection">
                        <div class="selection-header">
                            <h3 class="selection-title">Chagua Balozi ili Kuona Maendeleo Yake</h3>
                            <p style="color: var(--text-muted); font-size: 14px;">Bofya jina la Balozi ili kuona maendeleo yake ya kila siku</p>
                        </div>

                        <div class="balozi-grid">
                            @forelse($balozis as $balozi)
                                <a href="{{ route('mwenyekiti.maendeleo.index', ['view_type' => 'balozi', 'balozi_id' => $balozi->id]) }}" 
                                   class="balozi-card {{ $selectedBaloziId == $balozi->id ? 'selected' : '' }}">
                                    <div class="balozi-info">
                                        <div class="balozi-avatar">
                                            {{ strtoupper(substr($balozi->first_name, 0, 1) . substr($balozi->last_name, 0, 1)) }}
                                        </div>
                                        <div class="balozi-details">
                                            <h4>{{ $balozi->first_name }} {{ $balozi->last_name }}</h4>
                                            <div class="balozi-meta">
                                                <i class="fas fa-phone" style="font-size: 12px;"></i>
                                                {{ $balozi->phone }}
                                            </div>
                                        </div>
                                    </div>
                                    @if($balozi->maendeleo_ya_siku_count > 0)
                                        <span class="record-count">{{ $balozi->maendeleo_ya_siku_count }}</span>
                                    @endif
                                </a>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-users"></i>
                                    <h3>Hakuna Balozi</h3>
                                    <p>Haujaongeza Balozi yoyote bado</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endif

                <!-- Search and Filters -->
                @if($viewType === 'mine' || ($viewType === 'balozi' && $selectedBalozi))
                    <div class="filters-section">
                        <form method="GET" action="{{ route('mwenyekiti.maendeleo.index') }}">
                            <input type="hidden" name="view_type" value="{{ $viewType }}">
                            @if($selectedBaloziId)
                                <input type="hidden" name="balozi_id" value="{{ $selectedBaloziId }}">
                            @endif
                            <div class="filters-row">
                                <div class="filter-group">
                                    <label class="filter-label">Tafuta</label>
                                    <input type="text" name="search" class="filter-input" 
                                           placeholder="Tafuta katika maelezo au maoni..."
                                           value="{{ request('search') }}">
                                </div>
                                <div class="filter-group">
                                    <label class="filter-label">Tarehe</label>
                                    <input type="date" name="tarehe" class="filter-input" 
                                           value="{{ request('tarehe') }}">
                                </div>
                                <div class="filter-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Tafuta
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Maendeleo Table -->
                @if($maendeleo->count() > 0)
                    <div class="maendeleo-section">
                        <div class="section-header">
                            <h3>
                                @if($viewType === 'mine')
                                    Maendeleo Yangu ya Kila Siku
                                @elseif($selectedBalozi)
                                    Maendeleo ya {{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }}
                                @else
                                    Maendeleo ya Kila Siku
                                @endif
                            </h3>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('mwenyekiti.maendeleo.export', ['view_type' => $viewType, 'balozi_id' => $selectedBaloziId]) }}" 
                                   class="btn btn-success btn-sm">
                                    <i class="fas fa-download"></i> Export CSV
                                </a>
                            </div>
                        </div>

                        <div class="table-container">
                            <table class="maendeleo-table">
                                <thead>
                                    <tr>
                                        <th>Tarehe</th>
                                        <th>Maelezo</th>
                                        <th>Maoni</th>
                                        @if($viewType === 'balozi')
                                            <th>Ameongezwa na</th>
                                        @endif
                                        <th>Vitendo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($maendeleo as $record)
                                        <tr>
                                            <td>
                                                <span class="date-badge">
                                                    {{ \Carbon\Carbon::parse($record->tarehe)->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ Str::limit($record->maelezo, 100) }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($record->maoni)
                                                    <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ Str::limit($record->maoni, 80) }}
                                                    </div>
                                                @else
                                                    <span style="color: var(--text-muted); font-style: italic;">Hakuna maoni</span>
                                                @endif
                                            </td>
                                            @if($viewType === 'balozi')
                                                <td>
                                                    @if($record->createdBy)
                                                        <strong>{{ $record->createdBy->first_name }} {{ $record->createdBy->last_name }}</strong>
                                                    @else
                                                        <span style="color: var(--text-muted);">Mwenyekiti</span>
                                                    @endif
                                                </td>
                                            @endif
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('mwenyekiti.maendeleo.show', $record->id) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fas fa-eye"></i> Angalia
                                                    </a>
                                                    @if($viewType === 'mine')
                                                        <a href="{{ route('mwenyekiti.maendeleo.edit', $record->id) }}" 
                                                           class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Hariri
                                                        </a>
                                                        <form method="POST" action="{{ route('mwenyekiti.maendeleo.destroy', $record->id) }}" 
                                                              style="display: inline;" 
                                                              onsubmit="return confirm('Je, una uhakika kuwa unataka kufuta rekodi hii?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i> Futa
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
                        @if($maendeleo->hasPages())
                            <div class="pagination-wrapper">
                                {{ $maendeleo->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                @elseif($viewType === 'mine' || ($viewType === 'balozi' && $selectedBalozi))
                    <div class="maendeleo-section">
                        <div class="empty-state">
                            <i class="fas fa-chart-line"></i>
                            <h3>Hakuna Maendeleo</h3>
                            @if($viewType === 'mine')
                                <p>Hujaongeza maendeleo yoyote ya kila siku bado</p>
                                <div style="margin-top: 16px;">
                                    <a href="{{ route('mwenyekiti.maendeleo.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Ongeza Maendeleo ya Leo
                                    </a>
                                </div>
                            @else
                                <p>{{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }} hajaongeza maendeleo yoyote bado</p>
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
        });
    </script>
</body>
</html>