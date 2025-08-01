<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ripoti na Takwimu | Mwenyekiti Dashboard</title>
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

        /* Date Filter */
        .date-filter {
            background: white;
            padding: 20px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .filter-form {
            display: flex;
            align-items: end;
            gap: 16px;
            flex-wrap: wrap;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 150px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .form-input {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
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

        /* Stats Overview */
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border-left: 4px solid var(--primary-color);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .stat-icon.primary {
            background: var(--primary-color);
        }

        .stat-icon.success {
            background: var(--success-color);
        }

        .stat-icon.info {
            background: var(--info-color);
        }

        .stat-icon.warning {
            background: var(--warning-color);
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            margin-top: 8px;
        }

        .stat-change.positive {
            color: var(--success-color);
        }

        .stat-change.negative {
            color: var(--error-color);
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 24px;
            margin-bottom: 24px;
        }

        .chart-card {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        /* Reports Grid */
        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .report-card {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
        }

        .report-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .report-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 16px;
        }

        .report-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .report-description {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .report-action {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            font-weight: 500;
            font-size: 14px;
        }

        /* Recent Activity */
        .recent-activity {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }

        .activity-header {
            display: flex;
            align-items: center;
            justify-content: between;
            margin-bottom: 20px;
        }

        .activity-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .activity-list {
            space-y: 16px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            background: var(--primary-color);
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 12px;
            color: var(--text-muted);
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

            .stats-overview {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .charts-section {
                grid-template-columns: 1fr;
            }

            .reports-grid {
                grid-template-columns: 1fr;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group {
                min-width: 100%;
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
                    <h1 class="page-title">Ripoti na Takwimu</h1>
                    <p class="page-subtitle">Uchambuzi wa takwimu za jamii yako</p>
                </div>

                <!-- Date Filter -->
                <div class="date-filter">
                    <form method="GET" class="filter-form">
                        <div class="form-group">
                            <label class="form-label">Kuanzia</label>
                            <input type="date" name="start_date" value="{{ $startDate }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mpaka</label>
                            <input type="date" name="end_date" value="{{ $endDate }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Chuja
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Stats Overview -->
                <div class="stats-overview">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon primary">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                        <div class="stat-number">{{ number_format($totalBalozi) }}</div>
                        <div class="stat-label">Jumla ya Balozi</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon success">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-number">{{ number_format($totalWatu) }}</div>
                        <div class="stat-label">Jumla ya Watu</div>
                        @if($growthPercentage != 0)
                            <div class="stat-change {{ $growthPercentage > 0 ? 'positive' : 'negative' }}">
                                <i class="fas fa-{{ $growthPercentage > 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($growthPercentage) }}% kutoka mwezi uliopita
                            </div>
                        @endif
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon info">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="stat-number">{{ number_format($totalMeetings) }}</div>
                        <div class="stat-label">Mikutano</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon warning">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                        </div>
                        <div class="stat-number">{{ number_format($totalMatangazo) }}</div>
                        <div class="stat-label">Matangazo</div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-section">
                    <!-- Gender Distribution Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Mgawanyo wa Jinsia</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>

                    <!-- Age Groups Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Makundi ya Umri</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="ageChart"></canvas>
                        </div>
                    </div>

                    <!-- Registration Trends Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Mwelekeo wa Usajili</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="registrationChart"></canvas>
                        </div>
                    </div>

                    <!-- Meeting Statistics Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Takwimu za Mikutano</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="meetingChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Detailed Reports -->
                <div class="reports-grid">
                    <a href="{{ route('mwenyekiti.reports.show', 'demographics') }}" class="report-card">
                        <div class="report-icon" style="background: var(--primary-color);">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="report-title">Takwimu za Kijamii</h3>
                        <p class="report-description">Uchambuzi wa makundi ya umri, jinsia na mahali pa makazi</p>
                        <div class="report-action">
                            <span>Ona ripoti kamili</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('mwenyekiti.reports.show', 'registrations') }}" class="report-card">
                        <div class="report-icon" style="background: var(--success-color);">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="report-title">Ripoti ya Usajili</h3>
                        <p class="report-description">Mwelekeo wa usajili wa watu wapya na takwimu za kila Balozi</p>
                        <div class="report-action">
                            <span>Ona ripoti kamili</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('mwenyekiti.reports.show', 'meetings') }}" class="report-card">
                        <div class="report-icon" style="background: var(--info-color);">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 class="report-title">Ripoti ya Mikutano</h3>
                        <p class="report-description">Takwimu za mikutano, mahudhurio na mafanikio</p>
                        <div class="report-action">
                            <span>Ona ripoti kamili</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('mwenyekiti.reports.show', 'balozi-performance') }}" class="report-card">
                        <div class="report-icon" style="background: var(--warning-color);">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="report-title">Utendaji wa Balozi</h3>
                        <p class="report-description">Uchambuzi wa kazi za Balozi na mchanguko wao</p>
                        <div class="report-action">
                            <span>Ona ripoti kamili</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('mwenyekiti.reports.show', 'services') }}" class="report-card">
                        <div class="report-icon" style="background: var(--error-color);">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="report-title">Ripoti ya Huduma</h3>
                        <p class="report-description">Takwimu za maombi ya huduma na udhamini</p>
                        <div class="report-action">
                            <span>Ona ripoti kamili</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('mwenyekiti.reports.export', 'watu') }}" class="report-card">
                        <div class="report-icon" style="background: #6b7280;">
                            <i class="fas fa-download"></i>
                        </div>
                        <h3 class="report-title">Pakua Takwimu</h3>
                        <p class="report-description">Pakua takwimu zote katika muundo wa CSV</p>
                        <div class="report-action">
                            <span>Pakua sasa</span>
                            <i class="fas fa-download"></i>
                        </div>
                    </a>
                </div>

                <!-- Top Performing Balozi -->
                @if($baloziPerformance->count() > 0)
                <div class="recent-activity">
                    <div class="activity-header">
                        <h3 class="activity-title">Balozi Bora</h3>
                    </div>
                    <div class="activity-list">
                        @foreach($baloziPerformance->take(5) as $balozi)
                        <div class="activity-item">
                            <div class="activity-icon">
                                {{ strtoupper(substr($balozi->first_name, 0, 1)) }}{{ strtoupper(substr($balozi->last_name, 0, 1)) }}
                            </div>
                            <div class="activity-content">
                                <div class="activity-text">
                                    <strong>{{ $balozi->first_name }} {{ $balozi->last_name }}</strong>
                                </div>
                                <div class="activity-time">
                                    {{ number_format($balozi->watu_count) }} watu wamesajiliwa
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>
    </div>

    <script>
        // Chart.js Configuration
        Chart.defaults.font.family = 'Inter';
        Chart.defaults.font.size = 12;
        Chart.defaults.color = '#6b7280';

        // Gender Distribution Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Wanaume', 'Wanawake'],
                datasets: [{
                    data: [
                        {{ $genderStats['male'] ?? 0 }},
                        {{ $genderStats['female'] ?? 0 }}
                    ],
                    backgroundColor: ['#4ee546', '#ec4899'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Age Groups Chart
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($ageGroups)) !!},
                datasets: [{
                    label: 'Idadi',
                    data: {!! json_encode(array_values($ageGroups)) !!},
                    backgroundColor: '#10b981',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Registration Trends Chart
        const registrationCtx = document.getElementById('registrationChart').getContext('2d');
        new Chart(registrationCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($registrationTrends)) !!},
                datasets: [{
                    label: 'Usajili wa Kila Mwezi',
                    data: {!! json_encode(array_values($registrationTrends)) !!},
                    borderColor: '#4ee546',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Meeting Statistics Chart
        const meetingCtx = document.getElementById('meetingChart').getContext('2d');
        new Chart(meetingCtx, {
            type: 'doughnut',
            data: {
                labels: ['Zilizokamilika', 'Zijazo', 'Zilizositishwa'],
                datasets: [{
                    data: [
                        {{ $meetingStats['completed'] }},
                        {{ $meetingStats['upcoming'] }},
                        {{ $meetingStats['cancelled'] }}
                    ],
                    backgroundColor: ['#10b981', '#3b82f6', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('collapsed');
                });
            }

            const sidebarOverlay = document.querySelector('.sidebar-overlay');
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.add('collapsed');
                    this.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>