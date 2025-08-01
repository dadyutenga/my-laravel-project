<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaya Maskini | Mwenyekiti Dashboard</title>
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

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: var(--text-muted);
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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 14px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* Quick Actions */
        .quick-actions {
            background: rgba(79, 70, 229, 0.05);
            border: 1px solid rgba(79, 70, 229, 0.2);
            border-radius: var(--radius-md);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: var(--primary-color);
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
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .stat-card.total {
            border-left-color: var(--info-color);
        }

        .stat-card.male {
            border-left-color: var(--primary-color);
        }

        .stat-card.female {
            border-left-color: #ec4899;
        }

        .stat-card.household {
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
            background: var(--info-color);
        }

        .stat-card.male .stat-icon {
            background: var(--primary-color);
        }

        .stat-card.female .stat-icon {
            background: #ec4899;
        }

        .stat-card.household .stat-icon {
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

        .stat-trend {
            font-size: 12px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .trend-up {
            color: var(--success-color);
        }

        .trend-down {
            color: var(--error-color);
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
            display: flex;
            align-items: center;
            gap: 8px;
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
            border-color: var(--primary-color);
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .balozi-card.selected {
            border-color: var(--primary-color);
            background: var(--primary-light);
            box-shadow: var(--shadow-md);
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
            background: var(--primary-color);
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
            background: var(--info-color);
            color: white;
            padding: 4px 8px;
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
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        /* KayaMaskini Table */
        .kaya-maskini-section {
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
            display: flex;
            align-items: center;
            gap: 8px;
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
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .table-container {
            overflow-x: auto;
        }

        .kaya-maskini-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kaya-maskini-table th,
        .kaya-maskini-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .kaya-maskini-table th {
            background: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .kaya-maskini-table td {
            font-size: 14px;
        }

        .kaya-maskini-table tr:hover {
            background: var(--primary-light);
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
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
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

        .alert-info {
            background: #dbeafe;
            color: #1d4ed8;
            border: 1px solid #93c5fd;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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

            .kaya-maskini-table th,
            .kaya-maskini-table td {
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

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .kaya-maskini-table {
                font-size: 12px;
            }

            .kaya-maskini-table th,
            .kaya-maskini-table td {
                padding: 6px;
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
            <h1>Kaya Maskini</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('mwenyekiti.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-separator">/</span>
                    <span>Kaya Maskini</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-top">
                        <div class="header-left">
                            <h1 class="page-title">
                                <i class="fas fa-home"></i>
                                Kaya Maskini
                            </h1>
                            <p class="page-subtitle">Dhibiti na uangalie rekodi zote za Kaya Maskini kutoka kwa Balozi wako</p>
                        </div>
                        <div class="header-actions">
                            <div class="quick-actions">
                                <i class="fas fa-info-circle"></i>
                                <span>{{ number_format($stats['total']) }} Kaya Maskini zimesajiliwa</span>
                            </div>
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

                @if(session('info'))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        {{ session('info') }}
                    </div>
                @endif

                <!-- Statistics Grid -->
                <div class="stats-grid">
                    <div class="stat-card total">
                        <div class="stat-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['total'] ?? 0) }}</div>
                        <div class="stat-label">Jumla ya Kaya Maskini</div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i>
                            <span>Kaya zote zilizosajiliwa</span>
                        </div>
                    </div>

                    <div class="stat-card male">
                        <div class="stat-icon">
                            <i class="fas fa-male"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['male'] ?? 0) }}</div>
                        <div class="stat-label">Wanaume</div>
                        <div class="stat-trend">
                            <span>{{ $stats['total'] > 0 ? round(($stats['male'] / $stats['total']) * 100, 1) : 0 }}% ya jumla</span>
                        </div>
                    </div>

                    <div class="stat-card female">
                        <div class="stat-icon">
                            <i class="fas fa-female"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['female'] ?? 0) }}</div>
                        <div class="stat-label">Wanawake</div>
                        <div class="stat-trend">
                            <span>{{ $stats['total'] > 0 ? round(($stats['female'] / $stats['total']) * 100, 1) : 0 }}% ya jumla</span>
                        </div>
                    </div>

                    <div class="stat-card household">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['total_household_members'] ?? 0) }}</div>
                        <div class="stat-label">Jumla ya Watu Nyumbani</div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i>
                            <span>Wastani: {{ $stats['total'] > 0 ? round($stats['total_household_members'] / $stats['total'], 1) : 0 }} kwa kaya</span>
                        </div>
                    </div>
                </div>

                <!-- Balozi Selection -->
                <div class="balozi-selection">
                    <div class="selection-header">
                        <h3 class="selection-title">
                            <i class="fas fa-user-tie"></i>
                            Chagua Balozi ili Kuona Rekodi za Kaya Maskini
                        </h3>
                        <p style="color: var(--text-muted); font-size: 14px;">Bofya jina la Balozi ili kuona rekodi zake zote za Kaya Maskini</p>
                    </div>

                    <div class="balozi-grid">
                        @forelse($balozis ?? [] as $balozi)
                            <a href="{{ route('mwenyekiti.kaya-maskini.index', ['balozi_id' => $balozi->id]) }}" 
                               class="balozi-card {{ ($selectedBaloziId ?? 0) == $balozi->id ? 'selected' : '' }}"
                               onclick="showLoading(this)">
                                <div class="balozi-info">
                                    <div class="balozi-avatar">
                                        {{ strtoupper(substr($balozi->first_name ?? 'B', 0, 1) . substr($balozi->last_name ?? 'L', 0, 1)) }}
                                    </div>
                                    <div class="balozi-details">
                                        <h4>{{ $balozi->first_name ?? 'Balozi' }} {{ $balozi->last_name ?? '' }}</h4>
                                        <div class="balozi-meta">
                                            <i class="fas fa-phone" style="font-size: 12px;"></i>
                                            {{ $balozi->phone ?? 'Hakuna nambari' }}
                                        </div>
                                    </div>
                                </div>
                                @if(($balozi->kaya_maskini_count ?? 0) > 0)
                                    <span class="record-count">{{ $balozi->kaya_maskini_count }}</span>
                                @endif
                            </a>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h3>Hakuna Balozi</h3>
                                <p>Haujaongeza Balozi yoyote bado. Ongeza Balozi ili kuanza kusajili Kaya Maskini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Search and Filters -->
                @if(isset($selectedBalozi) && $selectedBalozi)
                    <div class="filters-section">
                        <form method="GET" action="{{ route('mwenyekiti.kaya-maskini.index') }}" id="filter-form">
                            <input type="hidden" name="balozi_id" value="{{ $selectedBaloziId }}">
                            <div class="filters-row">
                                <div class="filter-group">
                                    <label class="filter-label">Tafuta</label>
                                    <input type="text" name="search" class="filter-input" 
                                           placeholder="Tafuta kwa jina, simu, au mtaa..."
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
                                    <button type="submit" class="btn btn-primary" id="search-btn">
                                        <i class="fas fa-search"></i> Tafuta
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- KayaMaskini Table -->
                @if(isset($selectedBalozi) && $selectedBalozi && isset($kayaMaskini) && $kayaMaskini->count() > 0)
                    <div class="kaya-maskini-section">
                        <div class="section-header">
                            <h3>
                                <i class="fas fa-table"></i>
                                Kaya Maskini za {{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }}
                                <span style="font-size: 14px; color: var(--text-muted); font-weight: normal;">({{ $kayaMaskini->total() }} rekodi)</span>
                            </h3>
                            <a href="{{ route('mwenyekiti.kaya-maskini.export', $selectedBalozi->id) }}" 
                               class="export-btn"
                               onclick="showExportLoading(this)">
                                <i class="fas fa-download"></i> Export CSV
                            </a>
                        </div>

                        <div class="table-container">
                            <table class="kaya-maskini-table">
                                <thead>
                                    <tr>
                                        <th>Jina Kamili</th>
                                        <th>Jinsia</th>
                                        <th>Simu</th>
                                        <th>Mtaa</th>
                                        <th>Idadi ya Watu Nyumbani</th>
                                        <th>Maelezo</th>
                                        <th>Tarehe</th>
                                        <th>Vitendo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kayaMaskini as $kaya)
                                        <tr>
                                            <td>
                                                <strong>{{ $kaya->first_name }} {{ $kaya->middle_name }} {{ $kaya->last_name }}</strong>
                                            </td>
                                            <td>
                                                <span class="gender-badge gender-{{ $kaya->gender }}">
                                                    {{ $kaya->gender == 'male' ? 'Mume' : 'Mke' }}
                                                </span>
                                            </td>
                                            <td>{{ $kaya->phone ?: '-' }}</td>
                                            <td>{{ $kaya->street ?? '-' }}</td>
                                            <td>
                                                <strong>{{ $kaya->household_count ?: '0' }}</strong>
                                            </td>
                                            <td>
                                                <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ Str::limit($kaya->description ?? '', 100) ?: 'Hakuna maelezo' }}
                                                </div>
                                            </td>
                                            <td>{{ $kaya->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('mwenyekiti.kaya-maskini.show', $kaya->id) }}" 
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
                        @if($kayaMaskini->hasPages())
                            <div class="pagination-wrapper">
                                {{ $kayaMaskini->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                @elseif(isset($selectedBalozi) && $selectedBalozi)
                    <div class="kaya-maskini-section">
                        <div class="empty-state">
                            <i class="fas fa-home"></i>
                            <h3>Hakuna Rekodi za Kaya Maskini</h3>
                            <p>{{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }} hajaongeza rekodi yoyote ya Kaya Maskini bado</p>
                            @if(request('search') || request('gender'))
                                <div style="margin-top: 16px;">
                                    <a href="{{ route('mwenyekiti.kaya-maskini.index', ['balozi_id' => $selectedBaloziId]) }}" 
                                       class="btn btn-primary">
                                        <i class="fas fa-times"></i> Ondoa Kichujio
                                    </a>
                                </div>
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
            const genderSelect = document.querySelector('select[name="gender"]');
            
            if (searchInput) {
                let timeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        showSearchLoading();
                        this.form.submit();
                    }, 500);
                });
            }

            if (genderSelect) {
                genderSelect.addEventListener('change', function() {
                    showSearchLoading();
                    this.form.submit();
                });
            }
        });

        // Loading states
        function showLoading(element) {
            element.classList.add('loading');
            const content = element.innerHTML;
            element.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; gap: 8px;"><div class="spinner"></div> Inapakia...</div>';
        }

        function showSearchLoading() {
            const searchBtn = document.getElementById('search-btn');
            if (searchBtn) {
                searchBtn.disabled = true;
                searchBtn.innerHTML = '<div class="spinner"></div> Inatafuta...';
            }
        }

        function showExportLoading(element) {
            element.classList.add('loading');
            const originalContent = element.innerHTML;
            element.innerHTML = '<div class="spinner"></div> Inaexport...';
            
            // Reset after 3 seconds
            setTimeout(() => {
                element.classList.remove('loading');
                element.innerHTML = originalContent;
            }, 3000);
        }

        // Load Balozi statistics on hover (if needed)
        function loadBaloziStats(baloziId) {
            fetch(`{{ route('mwenyekiti.kaya-maskini.balozi-stats', '') }}/${baloziId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Balozi Stats:', data);
                    // You can display this in a tooltip or modal if needed
                })
                .catch(error => console.error('Error loading stats:', error));
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[name="search"]');
                if (searchInput) {
                    searchInput.focus();
                }
            }
        });
    </script>
</body>
</html>