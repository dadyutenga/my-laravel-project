<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | Mwenyekiti Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* Sidebar - Complete Implementation */
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

        /* Main content area */
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

        /* Content Area */
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
            align-items: center;
        }

        .btn {
            padding: 12px 20px;
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
        }

        /* Filters Section */
        .filters-section {
            background: white;
            padding: 20px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .filters-header {
            margin-bottom: 20px;
        }

        .filters-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            align-items: end;
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
        }

        .form-input,
        .form-select {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        /* Report Content */
        .report-content {
            display: grid;
            gap: 24px;
        }

        .content-section {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 400px;
            margin-bottom: 20px;
        }

        /* Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th,
        .data-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table th {
            background: var(--secondary-color);
            font-weight: 600;
            font-size: 14px;
            color: var(--text-color);
        }

        .data-table td {
            font-size: 14px;
        }

        .data-table tbody tr:hover {
            background: var(--secondary-color);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .stat-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .stat-name {
            font-size: 14px;
            color: var(--text-muted);
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
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        /* Loading State */
        .loading {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--border-color);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

            .content-area {
                padding: 16px;
            }

            .header-top {
                flex-direction: column;
                align-items: stretch;
            }

            .header-actions {
                justify-content: stretch;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .data-table {
                font-size: 12px;
            }

            .data-table th,
            .data-table td {
                padding: 8px 12px;
            }
        }

        /* Sidebar Overlay */
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
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Include Shared Sidebar -->
        @include('Mwenyekiti.shared.sidebar-menu')

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-top">
                        <div class="header-left">
                            <h1 class="page-title">{{ $title }}</h1>
                            <p class="page-subtitle">{{ $description }}</p>
                        </div>
                        <div class="header-actions">
                            <a href="{{ route('mwenyekiti.reports.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Rudi Ripoti
                            </a>
                            <a href="{{ route('mwenyekiti.reports.export', $type) }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" 
                               class="btn btn-success">
                                <i class="fas fa-download"></i> Pakua CSV
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="filters-section">
                    <form method="GET" class="filters-form">
                        <div class="filters-header">
                            <h3 class="filters-title">Chuja Takwimu</h3>
                        </div>
                        <div class="filters-grid">
                            <div class="form-group">
                                <label class="form-label">Kuanzia</label>
                                <input type="date" name="start_date" value="{{ $startDate }}" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mpaka</label>
                                <input type="date" name="end_date" value="{{ $endDate }}" class="form-input">
                            </div>
                            @if($balozis->count() > 0)
                            <div class="form-group">
                                <label class="form-label">Balozi</label>
                                <select name="balozi_id" class="form-select">
                                    <option value="">Balozi wote</option>
                                    @foreach($balozis as $balozi)
                                        <option value="{{ $balozi->id }}" {{ $baloziId == $balozi->id ? 'selected' : '' }}>
                                            {{ $balozi->first_name }} {{ $balozi->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Chuja
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Report Content -->
                <div class="report-content">
                    @if($type == 'demographics')
                        <!-- Demographics Report -->
                        @if(isset($data['genderByAge']) && $data['genderByAge']->count() > 0)
                        <div class="content-section">
                            <div class="section-header">
                                <h3 class="section-title">Mgawanyo wa Jinsia na Umri</h3>
                            </div>
                            <div class="chart-container">
                                <canvas id="genderAgeChart"></canvas>
                            </div>
                        </div>
                        @endif

                        @if(isset($data['locationDistribution']) && $data['locationDistribution']->count() > 0)
                        <div class="content-section">
                            <div class="section-header">
                                <h3 class="section-title">Mgawanyo wa Mahali pa Makazi</h3>
                            </div>
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Mtaa</th>
                                        <th>Wanaume</th>
                                        <th>Wanawake</th>
                                        <th>Jumla</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['locationDistribution'] as $mtaa => $residents)
                                        @php
                                            $males = $residents->where('gender', 'male')->sum('count');
                                            $females = $residents->where('gender', 'female')->sum('count');
                                            $total = $males + $females;
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $mtaa }}</strong></td>
                                            <td>{{ number_format($males) }}</td>
                                            <td>{{ number_format($females) }}</td>
                                            <td><strong>{{ number_format($total) }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                    @elseif($type == 'registrations')
                        <!-- Registration Report -->
                        @if(isset($data['dailyRegistrations']) && $data['dailyRegistrations']->count() > 0)
                        <div class="content-section">
                            <div class="section-header">
                                <h3 class="section-title">Usajili wa Kila Siku</h3>
                            </div>
                            <div class="chart-container">
                                <canvas id="dailyRegistrationChart"></canvas>
                            </div>
                        </div>
                        @endif

                        @if(isset($data['registrationsByBalozi']) && $data['registrationsByBalozi']->count() > 0)
                        <div class="content-section">
                            <div class="section-header">
                                <h3 class="section-title">Usajili kwa Balozi</h3>
                            </div>
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Balozi</th>
                                        <th>Simu</th>
                                        <th>Usajili Mpya</th>
                                        <th>Jumla ya Watu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['registrationsByBalozi'] as $balozi)
                                        <tr>
                                            <td><strong>{{ $balozi->first_name }} {{ $balozi->last_name }}</strong></td>
                                            <td>{{ $balozi->phone }}</td>
                                            <td>{{ number_format($balozi->watu_count) }}</td>
                                            <td>{{ number_format($balozi->watu()->count()) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                    @elseif($type == 'meetings')
                        <!-- Meetings Report -->
                        @if(isset($data['meetingTrends']) && $data['meetingTrends']->count() > 0)
                        <div class="content-section">
                            <div class="section-header">
                                <h3 class="section-title">Mwelekeo wa Mikutano</h3>
                            </div>
                            <div class="chart-container">
                                <canvas id="meetingTrendsChart"></canvas>
                            </div>
                        </div>
                        @endif

                        @if(isset($data['attendanceStats']) && $data['attendanceStats']->count() > 0)
                        <div class="content-section">
                            <div class="section-header">
                                <h3 class="section-title">Takwimu za Mahudhurio</h3>
                            </div>
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Mkutano</th>
                                        <th>Tarehe</th>
                                        <th>Hali</th>
                                        <th>Wahudhuriaji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['attendanceStats'] as $meeting)
                                        <tr>
                                            <td><strong>{{ $meeting->title }}</strong></td>
                                            <td>{{ Carbon\Carbon::parse($meeting->date)->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge badge-{{ $meeting->status }}">
                                                    {{ ucfirst($meeting->status) }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($meeting->attendees_count ?? 0) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                    @elseif($type == 'balozi-performance')
                        <!-- Balozi Performance Report -->
                        @if(isset($data['baloziMetrics']) && $data['baloziMetrics']->count() > 0)
                        <div class="content-section">
                            <div class="section-header">
                                <h3 class="section-title">Utendaji wa Balozi</h3>
                            </div>
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Balozi</th>
                                        <th>Simu</th>
                                        <th>Jumla ya Watu</th>
                                        <th>Usajili Mpya</th>
                                        <th>Kiwango</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['baloziMetrics'] as $balozi)
                                        @php
                                            $performance = $balozi->new_registrations > 0 ? 'Bora' : 
                                                          ($balozi->total_watu > 10 ? 'Wastani' : 'Chini');
                                            $badgeClass = $performance == 'Bora' ? 'success' : 
                                                         ($performance == 'Wastani' ? 'warning' : 'error');
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $balozi->first_name }} {{ $balozi->last_name }}</strong></td>
                                            <td>{{ $balozi->phone }}</td>
                                            <td>{{ number_format($balozi->total_watu) }}</td>
                                            <td>{{ number_format($balozi->new_registrations) }}</td>
                                            <td>
                                                <span class="badge badge-{{ $badgeClass }}">{{ $performance }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                    @elseif($type == 'services')
                        <!-- Services Report -->
                        @if(isset($data['serviceRequests']) && $data['serviceRequests']->count() > 0)
                        <div class="content-section">
                            <div class="section-header">
                                <h3 class="section-title">Maombi ya Huduma</h3>
                            </div>
                            <div class="chart-container">
                                <canvas id="serviceRequestsChart"></canvas>
                            </div>
                            
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Aina ya Huduma</th>
                                        <th>Yamekamilika</th>
                                        <th>Yanangoja</th>
                                        <th>Yamekataliwa</th>
                                        <th>Jumla</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['serviceRequests'] as $service => $statuses)
                                        @php
                                            $completed = $statuses->where('status', 'approved')->sum('count');
                                            $pending = $statuses->where('status', 'pending')->sum('count');
                                            $rejected = $statuses->where('status', 'rejected')->sum('count');
                                            $total = $completed + $pending + $rejected;
                                        @endphp
                                        <tr>
                                            <td><strong>{{ ucfirst($service) }}</strong></td>
                                            <td>{{ number_format($completed) }}</td>
                                            <td>{{ number_format($pending) }}</td>
                                            <td>{{ number_format($rejected) }}</td>
                                            <td><strong>{{ number_format($total) }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                    @else
                        <!-- No Data State -->
                        <div class="content-section">
                            <div class="empty-state">
                                <i class="fas fa-chart-bar"></i>
                                <h3>Hakuna Takwimu</h3>
                                <p>Hakuna takwimu za kuonyesha kwa sasa</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>
    </div>

    <script>
        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('collapsed');
                });
            }

            // Initialize charts based on report type
            @if($type == 'demographics' && isset($data['genderByAge']))
                initGenderAgeChart();
            @elseif($type == 'registrations' && isset($data['dailyRegistrations']))
                initDailyRegistrationChart();
            @elseif($type == 'meetings' && isset($data['meetingTrends']))
                initMeetingTrendsChart();
            @elseif($type == 'services' && isset($data['serviceRequests']))
                initServiceRequestsChart();
            @endif
        });

        @if($type == 'demographics' && isset($data['genderByAge']))
        function initGenderAgeChart() {
            const ctx = document.getElementById('genderAgeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Watoto', 'Vijana', 'Wazima', 'Wazee'],
                    datasets: [
                        {
                            label: 'Wanaume',
                            data: [
                                {{ $data['genderByAge']['male']['Watoto'] ?? 0 }},
                                {{ $data['genderByAge']['male']['Vijana'] ?? 0 }},
                                {{ $data['genderByAge']['male']['Wazima'] ?? 0 }},
                                {{ $data['genderByAge']['male']['Wazee'] ?? 0 }}
                            ],
                            backgroundColor: '#3b82f6'
                        },
                        {
                            label: 'Wanawake',
                            data: [
                                {{ $data['genderByAge']['female']['Watoto'] ?? 0 }},
                                {{ $data['genderByAge']['female']['Vijana'] ?? 0 }},
                                {{ $data['genderByAge']['female']['Wazima'] ?? 0 }},
                                {{ $data['genderByAge']['female']['Wazee'] ?? 0 }}
                            ],
                            backgroundColor: '#ec4899'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        @endif

        @if($type == 'registrations' && isset($data['dailyRegistrations']))
        function initDailyRegistrationChart() {
            const ctx = document.getElementById('dailyRegistrationChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        @foreach($data['dailyRegistrations'] as $registration)
                            '{{ \Carbon\Carbon::parse($registration->date)->format("d/m") }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Usajili wa Kila Siku',
                        data: [
                            @foreach($data['dailyRegistrations'] as $registration)
                                {{ $registration->count }},
                            @endforeach
                        ],
                        borderColor: '#4ee546',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        @endif

        @if($type == 'meetings' && isset($data['meetingTrends']))
        function initMeetingTrendsChart() {
            const ctx = document.getElementById('meetingTrendsChart').getContext('2d');
            
            const months = @json($data['meetingTrends']->keys());
            const completedData = [];
            const scheduledData = [];
            const cancelledData = [];

            months.forEach(month => {
                const monthData = @json($data['meetingTrends']);
                completedData.push(monthData[month].find(item => item.status === 'completed')?.count || 0);
                scheduledData.push(monthData[month].find(item => item.status === 'scheduled')?.count || 0);
                cancelledData.push(monthData[month].find(item => item.status === 'cancelled')?.count || 0);
            });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Yamekamilika',
                            data: completedData,
                            backgroundColor: '#37b025'
                        },
                        {
                            label: 'Yamepangwa',
                            data: scheduledData,
                            backgroundColor: '#f59e0b'
                        },
                        {
                            label: 'Yameghairiwa',
                            data: cancelledData,
                            backgroundColor: '#ef4444'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        @endif

        @if($type == 'services' && isset($data['serviceRequests']))
        function initServiceRequestsChart() {
            const ctx = document.getElementById('serviceRequestsChart').getContext('2d');
            
            const serviceData = @json($data['serviceRequests']);
            const labels = Object.keys(serviceData);
            const approvedData = [];
            const pendingData = [];
            const rejectedData = [];

            labels.forEach(service => {
                const statuses = serviceData[service];
                approvedData.push(statuses.find(item => item.status === 'approved')?.count || 0);
                pendingData.push(statuses.find(item => item.status === 'pending')?.count || 0);
                rejectedData.push(statuses.find(item => item.status === 'rejected')?.count || 0);
            });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels.map(label => label.charAt(0).toUpperCase() + label.slice(1)),
                    datasets: [
                        {
                            label: 'Yamekubaliwa',
                            data: approvedData,
                            backgroundColor: '#37b025'
                        },
                        {
                            label: 'Yanangoja',
                            data: pendingData,
                            backgroundColor: '#f59e0b'
                        },
                        {
                            label: 'Yamekataliwa',
                            data: rejectedData,
                            backgroundColor: '#ef4444'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        @endif
    </script>

    <style>
        /* Additional badge styles for performance indicators */
        .badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .badge-success {
            background: #d1fae5;
            color: #047857;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-error {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-scheduled {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-completed {
            background: #d1fae5;
            color: #047857;
        }

        .badge-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }
    </style>
</body>
</html>