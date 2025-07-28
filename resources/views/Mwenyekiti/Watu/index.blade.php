<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watu wa Jamii | Mwenyekiti Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: rgba(79, 70, 229, 0.1);
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --success-color: #10b981;
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

        /* Sidebar - Complete Implementation (matching MeetingRequest) */
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
    text-decoration: none;
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
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
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

.sidebar.collapsed .menu-item {
    justify-content: center;
    padding: 10px;
}

.sidebar.collapsed .menu-icon {
    margin-right: 0;
}

/* Mobile Responsive - Matching MeetingRequest */
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

    .balozi-grid {
        grid-template-columns: 1fr;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .filters-grid {
        grid-template-columns: 1fr;
    }

    .search-group {
        grid-column: span 1;
    }

    .button-group {
        flex-direction: column;
    }

    .people-table {
        font-size: 12px;
    }

    .people-table th,
    .people-table td {
        padding: 8px 12px;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .content-area {
        padding: 20px;
        max-width: 100%;
    }

    .filters-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .search-group {
        grid-column: span 2;
    }
}

@media (min-width: 1025px) {
    .mobile-header {
        display: none;
    }
    
    .content-area {
        padding: 24px;
        max-width: 100%;
    }
}

/* Main content area - FIXED */
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

/* Content Area - FIXED */
.content-area {
    padding: 24px;
    max-width: 100%;
    width: 100%;
    margin: 0;
}

/* Mobile Header - FIXED */
.mobile-header {
    display: none;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    background: white;
    border-bottom: 1px solid var(--border-color);
    position: sticky;
    top: 0;
    z-index: 100;
}

.mobile-header-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-color);
}

.mobile-menu-btn {
    background: none;
    border: none;
    font-size: 20px;
    color: var(--text-color);
    cursor: pointer;
    padding: 8px;
    border-radius: var(--radius-sm);
    transition: var(--transition);
}

.mobile-menu-btn:hover {
    background: var(--secondary-color);
}

/* Sidebar Overlay - FIXED */
.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: none;
    opacity: 0;
    transition: var(--transition);
}

.sidebar-overlay.active {
    display: block;
    opacity: 1;
}

/* Alert Styles */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            border: 1px solid;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success {
            background: #d1fae5;
            border-color: #10b981;
            color: #047857;
        }

        .alert-error {
            background: #fee2e2;
            border-color: #ef4444;
            color: #dc2626;
        }

        /* Balozi Selector */
        .balozi-selector {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .selector-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--text-color);
        }

        .balozi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 16px;
        }

        .balozi-card {
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 16px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
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
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
            box-shadow: var(--shadow-sm);
        }

        .balozi-details h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .balozi-meta {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Stats Section */
        .stats-section {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .stat-card {
            text-align: center;
            padding: 20px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            transition: var(--transition);
            background: white;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Filters Section */
        .filters-section {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .filters-header {
            margin-bottom: 20px;
            text-align: center;
        }

        .filters-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .filters-subtitle {
            font-size: 14px;
            color: var(--text-muted);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .search-group {
            grid-column: span 2;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 6px;
            color: var(--text-muted);
            width: 16px;
        }

        .form-input,
        .form-select {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
            background: white;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .search-input-wrapper {
            position: relative;
        }

        .search-input {
            padding-right: 40px;
            font-size: 16px;
            font-weight: 500;
        }

        .clear-search {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 14px;
            padding: 4px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .clear-search:hover {
            color: var(--error-color);
            background: rgba(239, 68, 68, 0.1);
        }

        .search-help {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
            font-style: italic;
        }

        .button-group {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 12px 16px;
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
            min-height: 40px;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background: var(--border-color);
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-full {
            width: 100%;
            justify-content: center;
        }

        .search-summary {
            background: var(--info-color);
            color: white;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-top: 16px;
        }

        .search-summary-content {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        /* People Section */
        .people-section {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .section-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            background: var(--secondary-color);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .people-table {
            width: 100%;
            border-collapse: collapse;
        }

        .people-table th,
        .people-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .people-table th {
            background: var(--secondary-color);
            font-weight: 600;
            font-size: 14px;
            color: var(--text-color);
        }

        .people-table td {
            font-size: 14px;
        }

        .people-table tbody tr {
            transition: var(--transition);
        }

        .people-table tbody tr:hover {
            background: var(--secondary-color);
        }

        .person-name {
            font-weight: 500;
            color: var(--text-color);
        }

        .person-meta {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 2px;
        }

        .badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .badge-male {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-female {
            background: #fce7f3;
            color: #be185d;
        }

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
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .pagination {
            padding: 20px 24px;
            border-top: 1px solid var(--border-color);
            background: var(--secondary-color);
        }

        /* Responsive Design */
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

            .balozi-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .search-group {
                grid-column: span 1;
            }

            .button-group {
                flex-direction: column;
            }

            .people-table {
                font-size: 12px;
            }

            .people-table th,
            .people-table td {
                padding: 8px 12px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .content-area {
                padding: 20px;
                max-width: 100%;
            }

            .filters-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .search-group {
                grid-column: span 2;
            }
        }

        @media (min-width: 1025px) {
            .mobile-header {
                display: none;
            }
            
            .content-area {
                padding: 24px;
                max-width: 100%;
            }
        }
        
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Include Shared Sidebar -->
        @include('Mwenyekiti.shared.sidebar-menu')

        <!-- Mobile Header (shown only on mobile) -->
        <div class="mobile-header">
            <button class="mobile-menu-btn" onclick="toggleMobileSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="mobile-header-title">Watu wa Jamii</h1>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Content Area -->
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">Watu wa Jamii</h1>
                    <p class="page-subtitle">Chagua Balozi kuona watu waliowasajili katika jamii yako</p>
                </div>

                <!-- Success/Error Messages -->
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

                <!-- Balozi Selector -->
                <div class="balozi-selector">
                    <h2 class="selector-title">Chagua Balozi</h2>
                    <div class="balozi-grid">
                        @forelse($balozis as $balozi)
                            <a href="{{ route('mwenyekiti.watu.index', ['balozi_id' => $balozi->id]) }}" 
                               class="balozi-card {{ $selectedBaloziId == $balozi->id ? 'selected' : '' }}">
                                <div class="balozi-info">
                                    <div class="balozi-avatar">
                                        {{ strtoupper(substr($balozi->first_name, 0, 1)) }}{{ strtoupper(substr($balozi->last_name, 0, 1)) }}
                                    </div>
                                    <div class="balozi-details">
                                        <h3>{{ $balozi->first_name }} {{ $balozi->last_name }}</h3>
                                        <div class="balozi-meta">
                                            <i class="fas fa-phone"></i> {{ $balozi->phone }}
                                            <br>
                                            <i class="fas fa-users"></i> {{ $balozi->watu_count }} watu
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-user-tie"></i>
                                <h3>Hakuna Balozi</h3>
                                <p>Bado haujasajili Balozi yoyote</p>
                                <a href="{{ route('mwenyekiti.balozi.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ongeza Balozi
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                @if($selectedBalozi)
                    <!-- Statistics -->
                    <div class="stats-section">
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-number">{{ number_format($stats['total_people']) }}</div>
                                <div class="stat-label">Jumla ya Watu</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ number_format($stats['males']) }}</div>
                                <div class="stat-label">Wanaume</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ number_format($stats['females']) }}</div>
                                <div class="stat-label">Wanawake</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ number_format($stats['children']) }}</div>
                                <div class="stat-label">Watoto</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ number_format($stats['adults']) }}</div>
                                <div class="stat-label">Wazima</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ number_format($stats['seniors']) }}</div>
                                <div class="stat-label">Wazee</div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Filters -->
                    <div class="filters-section">
                        <form method="GET" action="{{ route('mwenyekiti.watu.index') }}" id="searchForm">
                            <input type="hidden" name="balozi_id" value="{{ $selectedBaloziId }}">
                            
                            <div class="filters-header">
                                <h3 class="filters-title">
                                    <i class="fas fa-filter"></i> Tafuta na Chuja Watu
                                </h3>
                                <p class="filters-subtitle">Tumia vichujio hapo chini kutafuta watu</p>
                            </div>
                            
                            <div class="filters-grid">
                                <!-- Enhanced Search Input -->
                                <div class="form-group search-group">
                                    <label class="form-label">
                                        <i class="fas fa-search"></i> Tafuta
                                    </label>
                                    <div class="search-input-wrapper">
                                        <input type="text" 
                                               name="search" 
                                               class="form-input search-input" 
                                               placeholder="Jina, NIDA, simu, mtaa..." 
                                               value="{{ request('search') }}"
                                               autocomplete="off">
                                        @if(request('search'))
                                            <button type="button" class="clear-search" onclick="clearSearch()">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                    <small class="search-help">
                                        Unaweza kutafuta kwa: jina kamili, NIDA, namba ya simu, mtaa, au sehemu yoyote ya taarifa
                                    </small>
                                </div>
                                
                                <!-- Gender Filter -->
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-venus-mars"></i> Jinsia
                                    </label>
                                    <select name="gender" class="form-select">
                                        <option value="">Jinsia zote</option>
                                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Mume</option>
                                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Mke</option>
                                    </select>
                                </div>
                                
                                <!-- Age Group Filter -->
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-birthday-cake"></i> Kundi la Umri
                                    </label>
                                    <select name="age_group" class="form-select">
                                        <option value="">Makundi yote</option>
                                        <option value="children" {{ request('age_group') == 'children' ? 'selected' : '' }}>
                                            Watoto (Chini ya 18)
                                        </option>
                                        <option value="adults" {{ request('age_group') == 'adults' ? 'selected' : '' }}>
                                            Wazima (18-59)
                                        </option>
                                        <option value="seniors" {{ request('age_group') == 'seniors' ? 'selected' : '' }}>
                                            Wazee (60+)
                                        </option>
                                    </select>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="form-group">
                                    <label class="form-label">&nbsp;</label>
                                    <div class="button-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Tafuta
                                        </button>
                                        <a href="{{ route('mwenyekiti.watu.index', ['balozi_id' => $selectedBaloziId]) }}" 
                                           class="btn btn-secondary">
                                            <i class="fas fa-undo"></i> Futa
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Export Button -->
                                <div class="form-group">
                                    <label class="form-label">&nbsp;</label>
                                    <a href="{{ route('mwenyekiti.watu.export', array_merge(request()->query(), ['balozi_id' => $selectedBaloziId])) }}" 
                                       class="btn btn-success btn-full">
                                        <i class="fas fa-download"></i> Pakua CSV
                                        @if(request()->filled('search') || request()->filled('gender') || request()->filled('age_group'))
                                            (Matokeo ya utafutaji)
                                        @else
                                            (Wote)
                                        @endif
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Search Results Summary -->
                            @if(request()->filled('search') || request()->filled('gender') || request()->filled('age_group'))
                                <div class="search-summary">
                                    <div class="search-summary-content">
                                        <i class="fas fa-info-circle"></i>
                                        <span>
                                            Unaonyesha matokeo ya: 
                                            @if(request('search'))
                                                <strong>"{{ request('search') }}"</strong>
                                            @endif
                                            @if(request('gender'))
                                                <strong>{{ request('gender') == 'male' ? 'Wanaume' : 'Wanawake' }}</strong>
                                            @endif
                                            @if(request('age_group'))
                                                <strong>
                                                    @if(request('age_group') == 'children') Watoto
                                                    @elseif(request('age_group') == 'adults') Wazima
                                                    @else Wazee @endif
                                                </strong>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>

                    <!-- People List -->
                    <div class="people-section">
                        <div class="section-header">
                            <h2 class="section-title">
                                Watu wa {{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }}
                            </h2>
                        </div>

                        @if($watu->count() > 0)
                            <table class="people-table">
                                <thead>
                                    <tr>
                                        <th>Jina</th>
                                        <th>Jinsia</th>
                                        <th>Umri</th>
                                        <th>Kitambulisho</th>
                                        <th>Simu</th>
                                        <th>Mahali</th>
                                        <th>Tarehe ya Usajili</th>
                                        <th>Vitendo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($watu as $mtu)
                                        <tr>
                                            <td>
                                                <div class="person-name">
                                                    {{ $mtu->first_name }} {{ $mtu->middle_name }} {{ $mtu->last_name }}
                                                </div>
                                                @if($mtu->phone)
                                                    <div class="person-meta">{{ $mtu->phone }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($mtu->gender)
                                                    <span class="badge badge-{{ $mtu->gender }}">
                                                        {{ $mtu->gender == 'male' ? 'Mume' : 'Mke' }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($mtu->date_of_birth)
                                                    {{ \Carbon\Carbon::parse($mtu->date_of_birth)->age }} miaka
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $mtu->national_id ?: '-' }}</td>
                                            <td>{{ $mtu->phone ?: '-' }}</td>
                                            <td>
                                                @if($mtu->mtaa)
                                                    {{ $mtu->mtaa }}
                                                    @if($mtu->shina)
                                                        <br><small>Shina: {{ $mtu->shina }} {{ $mtu->shina_number }}</small>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $mtu->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('mwenyekiti.watu.show', $mtu->id) }}" 
                                                   class="btn btn-secondary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $watu->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h3>Hakuna Watu</h3>
                                <p>
                                    @if(request()->filled('search') || request()->filled('gender') || request()->filled('age_group'))
                                        Hakuna matokeo yanayolingana na utaftaji wako
                                    @else
                                        {{ $selectedBalozi->first_name }} hajasajili mtu yoyote bado
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>
    </div>

    <script>
        // Clear search function
        function clearSearch() {
            document.querySelector('input[name="search"]').value = '';
            document.getElementById('searchForm').submit();
        }

        // Sidebar toggle functionality (matching MeetingRequest)
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('collapsed');
                });
            }

            // Close sidebar when clicking on overlay
            const sidebarOverlay = document.querySelector('.sidebar-overlay');
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.add('collapsed');
                    this.classList.remove('active');
                });
            }

            // Auto-submit form on filter change
            const genderSelect = document.querySelector('select[name="gender"]');
            const ageGroupSelect = document.querySelector('select[name="age_group"]');
            
            if (genderSelect) {
                genderSelect.addEventListener('change', function() {
                    document.getElementById('searchForm').submit();
                });
            }
            
            if (ageGroupSelect) {
                ageGroupSelect.addEventListener('change', function() {
                    document.getElementById('searchForm').submit();
                });
            }
            
            // Search on Enter key
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        document.getElementById('searchForm').submit();
                    }
                });
            }
        });
    </script>
</body>
</html>