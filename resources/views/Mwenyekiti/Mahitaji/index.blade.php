<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watu wenye Mahitaji Maalumu | Mwenyekiti Dashboard</title>
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
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --purple-color: #8b5cf6;
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
            border-left-color: var(--purple-color);
        }

        .stat-card.male {
            border-left-color: var(--primary-color);
        }

        .stat-card.female {
            border-left-color: #ec4899;
        }

        .stat-card.month {
            border-left-color: var(--success-color);
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
            background: var(--purple-color);
        }

        .stat-card.male .stat-icon {
            background: var(--primary-color);
        }

        .stat-card.female .stat-icon {
            background: #ec4899;
        }

        .stat-card.month .stat-icon {
            background: var(--success-color);
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
            border-color: var(--purple-color);
            background: rgba(139, 92, 246, 0.05);
            transform: translateY(-2px);
        }

        .balozi-card.selected {
            border-color: var(--purple-color);
            background: rgba(139, 92, 246, 0.05);
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
            background: var(--purple-color);
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
            background: var(--purple-color);
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
            border-color: var(--purple-color);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        /* Mahitaji Table */
        .mahitaji-section {
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

        .export-btn {
            padding: 8px 16px;
            background: var(--success-color);
            color: white;
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
        }

        .export-btn:hover {
            background: #059669;
        }

        .table-container {
            overflow-x: auto;
        }

        .mahitaji-table {
            width: 100%;
            border-collapse: collapse;
        }

        .mahitaji-table th,
        .mahitaji-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .mahitaji-table th {
            background: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
        }

        .mahitaji-table td {
            font-size: 14px;
        }

        .mahitaji-table tr:hover {
            background: rgba(139, 92, 246, 0.05);
        }

        /* Gender Badges */
        .gender-badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
        }

        .gender-male {
            background: #dbeafe;
            color: #1e40af;
        }

        .gender-female {
            background: #fce7f3;
            color: #be185d;
        }

        /* Disability Type Badge */
        .disability-badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            background: rgba(139, 92, 246, 0.1);
            color: var(--purple-color);
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
            background: var(--purple-color);
            color: white;
        }

        .btn-primary:hover {
            background: #7c3aed;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
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

            .mahitaji-table th,
            .mahitaji-table td {
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
            <h1>Watu wenye Mahitaji Maalumu</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-top">
                        <div class="header-left">
                            <h1 class="page-title">Watu wenye Mahitaji Maalumu</h1>
                            <p class="page-subtitle">Dhibiti na uangalie rekodi zote za watu wenye mahitaji maalumu kutoka kwa Balozi wako</p>
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
                            <i class="fas fa-wheelchair"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['total']) }}</div>
                        <div class="stat-label">Jumla ya Watu wenye Mahitaji</div>
                    </div>

                    <div class="stat-card male">
                        <div class="stat-icon">
                            <i class="fas fa-male"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['male']) }}</div>
                        <div class="stat-label">Wanaume</div>
                    </div>

                    <div class="stat-card female">
                        <div class="stat-icon">
                            <i class="fas fa-female"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['female']) }}</div>
                        <div class="stat-label">Wanawake</div>
                    </div>

                    <div class="stat-card month">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['this_month']) }}</div>
                        <div class="stat-label">Mwezi Huu</div>
                    </div>
                </div>

                <!-- Balozi Selection -->
                <div class="balozi-selection">
                    <div class="selection-header">
                        <h3 class="selection-title">Chagua Balozi ili Kuona Rekodi za Watu wenye Mahitaji Maalumu</h3>
                        <p style="color: var(--text-muted); font-size: 14px;">Bofya jina la Balozi ili kuona rekodi zake zote za watu wenye mahitaji maalumu</p>
                    </div>

                    <div class="balozi-grid">
                        @forelse($balozis as $balozi)
                            <a href="{{ route('mwenyekiti.mahitaji.index', ['balozi_id' => $balozi->id]) }}" 
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
                                @if($balozi->mahitaji_maalumu_count > 0)
                                    <span class="record-count">{{ $balozi->mahitaji_maalumu_count }}</span>
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

                <!-- Search and Filters -->
                @if($selectedBalozi)
                    <div class="filters-section">
                        <form method="GET" action="{{ route('mwenyekiti.mahitaji.index') }}">
                            <input type="hidden" name="balozi_id" value="{{ $selectedBaloziId }}">
                            <div class="filters-row">
                                <div class="filter-group">
                                    <label class="filter-label">Tafuta</label>
                                    <input type="text" name="search" class="filter-input" 
                                           placeholder="Tafuta kwa jina, simu, au aina ya ulemavu..."
                                           value="{{ request('search') }}">
                                </div>
                                <div class="filter-group">
                                    <label class="filter-label">Jinsia</label>
                                    <select name="gender" class="filter-select">
                                        <option value="">Yote</option>
                                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Mume</option>
                                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Mke</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label class="filter-label">Aina ya Ulemavu</label>
                                    <input type="text" name="disability_type" class="filter-input" 
                                           placeholder="Andika aina ya ulemavu..."
                                           value="{{ request('disability_type') }}">
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

                <!-- Mahitaji Table -->
                @if($selectedBalozi && $mahitaji->count() > 0)
                    <div class="mahitaji-section">
                        <div class="section-header">
                            <h3>Watu wenye Mahitaji Maalumu wa {{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }}</h3>
                            <a href="{{ route('mwenyekiti.mahitaji.export', $selectedBalozi->id) }}" 
                               class="export-btn">
                                <i class="fas fa-download"></i> Export CSV
                            </a>
                        </div>

                        <div class="table-container">
                            <table class="mahitaji-table">
                                <thead>
                                    <tr>
                                        <th>Jina Kamili</th>
                                        <th>Umri</th>
                                        <th>Jinsia</th>
                                        <th>Simu</th>
                                        <th>NIDA</th>
                                        <th>Aina ya Ulemavu</th>
                                        <th>Tarehe</th>
                                        <th>Vitendo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahitaji as $mtu)
                                        <tr>
                                            <td>
                                                <strong>{{ $mtu->first_name }} {{ $mtu->middle_name }} {{ $mtu->last_name }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $mtu->age ?: '-' }}</strong>
                                                @if($mtu->age)
                                                    <small style="color: var(--text-muted);">miaka</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="gender-badge gender-{{ $mtu->gender }}">
                                                    {{ $mtu->gender == 'male' ? 'Mume' : 'Mke' }}
                                                </span>
                                            </td>
                                            <td>{{ $mtu->phone ?: '-' }}</td>
                                            <td>{{ $mtu->nida_number ?: '-' }}</td>
                                            <td>
                                                @if($mtu->disability_type)
                                                    <span class="disability-badge" title="{{ $mtu->disability_type }}">
                                                        {{ Str::limit($mtu->disability_type, 30) }}
                                                    </span>
                                                @else
                                                    <span style="color: var(--text-muted); font-style: italic;">Haijazaliswa</span>
                                                @endif
                                            </td>
                                            <td>{{ $mtu->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('mwenyekiti.mahitaji.show', $mtu->id) }}" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i> Angalia
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($mahitaji->hasPages())
                            <div class="pagination-wrapper">
                                {{ $mahitaji->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                @elseif($selectedBalozi)
                    <div class="mahitaji-section">
                        <div class="empty-state">
                            <i class="fas fa-wheelchair"></i>
                            <h3>Hakuna Rekodi za Watu wenye Mahitaji Maalumu</h3>
                            <p>{{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }} hajaongeza rekodi yoyote ya watu wenye mahitaji maalumu bado</p>
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

        // Load Balozi statistics on hover
        function loadBaloziStats(baloziId) {
            fetch(`{{ route('mwenyekiti.mahitaji.balozi-stats', '') }}/${baloziId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Balozi Stats:', data);
                    // You can display this in a tooltip or modal if needed
                })
                .catch(error => console.error('Error loading stats:', error));
        }
    </script>
</body>
</html>