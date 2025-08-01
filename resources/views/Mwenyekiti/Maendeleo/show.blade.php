<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angalia Maendeleo ya Siku | Mwenyekiti Dashboard</title>
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
            --green-color: #37b025;
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
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Page Header */
        .page-header {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--green-color);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: var(--text-muted);
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 24px;
        }

        /* Main Progress Card */
        .progress-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .progress-header {
            padding: 24px;
            background: linear-gradient(135deg, var(--green-color) 0%, #047857 100%);
            color: white;
            text-align: center;
        }

        .progress-date {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .progress-day {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 16px;
        }

        .progress-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .progress-body {
            padding: 32px;
        }

        .progress-section {
            margin-bottom: 32px;
        }

        .progress-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-content {
            background: var(--secondary-color);
            padding: 24px;
            border-radius: var(--radius-md);
            border-left: 4px solid var(--green-color);
        }

        .progress-text {
            font-size: 16px;
            line-height: 1.8;
            color: var(--text-color);
            white-space: pre-wrap;
        }

        .empty-content {
            color: var(--text-muted);
            font-style: italic;
            text-align: center;
            padding: 24px;
        }

        /* Sidebar Info */
        .sidebar-info {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Creator Info Card */
        .creator-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .creator-header {
            padding: 20px;
            background: var(--green-color);
            color: white;
            text-align: center;
        }

        .creator-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 24px;
            margin: 0 auto 12px;
        }

        .creator-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .creator-role {
            font-size: 14px;
            opacity: 0.9;
        }

        .creator-body {
            padding: 20px;
        }

        .creator-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .creator-info-item:last-child {
            border-bottom: none;
        }

        .creator-info-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            background: rgba(5, 150, 105, 0.1);
            color: var(--green-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .creator-info-content {
            flex: 1;
        }

        .creator-info-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .creator-info-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        /* Timeline Card */
        .timeline-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .timeline-header {
            padding: 20px 24px;
            background: var(--info-color);
            color: white;
        }

        .timeline-header h3 {
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .timeline-body {
            padding: 20px;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
        }

        .timeline-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--green-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-text {
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 2px;
        }

        .timeline-date {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Action Buttons */
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

        /* Statistics Section */
        .stats-section {
            background: rgba(5, 150, 105, 0.05);
            padding: 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--green-color);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
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

            .content-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .header-content {
                flex-direction: column;
                align-items: stretch;
            }

            .header-actions {
                justify-content: stretch;
            }

            .progress-body {
                padding: 20px;
            }

            .progress-section {
                margin-bottom: 24px;
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
            <h1>Angalia Maendeleo</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('mwenyekiti.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-separator">/</span>
                    <a href="{{ route('mwenyekiti.maendeleo.index') }}">Maendeleo ya Kila Siku</a>
                    <span class="breadcrumb-separator">/</span>
                    <span>{{ $maendeleo->tarehe->format('d/m/Y') }}</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-content">
                        <div class="header-left">
                            <h1 class="page-title">Maendeleo ya Siku</h1>
                            <p class="page-subtitle">
                                Angalia maelezo kamili ya maendeleo ya tarehe 
                                {{ $maendeleo->tarehe->format('d/m/Y') }} 
                                ({{ $maendeleo->tarehe->locale('sw')->dayName }})
                            </p>
                        </div>
                        <div class="header-actions">
                            <a href="{{ route('mwenyekiti.maendeleo.index') }}" 
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Rudi Orodha
                            </a>
                            @if($maendeleo->created_by == session('mwenyekiti_id'))
                                <a href="{{ route('mwenyekiti.maendeleo.edit', $maendeleo->id) }}" 
                                   class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Hariri
                                </a>
                            @endif
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

                <!-- Content Grid -->
                <div class="content-grid">
                    <!-- Main Progress Information -->
                    <div>
                        <!-- Progress Card -->
                        <div class="progress-card">
                            <div class="progress-header">
                                <div class="progress-date">
                                    {{ $maendeleo->tarehe->format('d') }}
                                </div>
                                <div class="progress-day">
                                    {{ $maendeleo->tarehe->locale('sw')->monthName }} {{ $maendeleo->tarehe->format('Y') }}
                                    <br>
                                    {{ $maendeleo->tarehe->locale('sw')->dayName }}
                                </div>
                                <div class="progress-badge">
                                    <i class="fas fa-chart-line"></i>
                                    Maendeleo ya Siku
                                </div>
                            </div>

                            <div class="progress-body">
                                <!-- Main Description -->
                                <div class="progress-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-list-alt"></i>
                                        Maelezo ya Maendeleo
                                    </h3>
                                    <div class="section-content">
                                        <div class="progress-text">{{ $maendeleo->maelezo }}</div>
                                    </div>
                                </div>

                                <!-- Comments/Notes -->
                                <div class="progress-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-comment-alt"></i>
                                        Maoni na Maelezo ya Ziada
                                    </h3>
                                    <div class="section-content">
                                        @if($maendeleo->maoni)
                                            <div class="progress-text">{{ $maendeleo->maoni }}</div>
                                        @else
                                            <div class="empty-content">
                                                <i class="fas fa-comment-slash" style="font-size: 24px; margin-bottom: 8px; opacity: 0.5;"></i>
                                                <p>Hakuna maoni yaliyoongezwa</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Progress Statistics -->
                                <div class="stats-section">
                                    <div class="stats-grid">
                                        <div class="stat-item">
                                            <div class="stat-value">{{ strlen($maendeleo->maelezo) }}</div>
                                            <div class="stat-label">Herufi za Maelezo</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-value">{{ str_word_count($maendeleo->maelezo) }}</div>
                                            <div class="stat-label">Maneno ya Maelezo</div>
                                        </div>
                                        @if($maendeleo->maoni)
                                            <div class="stat-item">
                                                <div class="stat-value">{{ strlen($maendeleo->maoni) }}</div>
                                                <div class="stat-label">Herufi za Maoni</div>
                                            </div>
                                        @endif
                                        <div class="stat-item">
                                            <div class="stat-value">{{ $maendeleo->created_at->diffInDays(now()) }}</div>
                                            <div class="stat-label">Siku Zilizopita</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Information -->
                    <div class="sidebar-info">
                        <!-- Creator Information -->
                        <div class="creator-card">
                            <div class="creator-header">
                                <div class="creator-avatar">
                                    @if($maendeleo->createdBy)
                                        {{ strtoupper(substr($maendeleo->createdBy->first_name, 0, 1) . substr($maendeleo->createdBy->last_name, 0, 1)) }}
                                    @else
                                        MW
                                    @endif
                                </div>
                                <div class="creator-name">
                                    @if($maendeleo->createdBy)
                                        {{ $maendeleo->createdBy->first_name }} {{ $maendeleo->createdBy->last_name }}
                                    @else
                                        Mwenyekiti
                                    @endif
                                </div>
                                <div class="creator-role">
                                    @if($maendeleo->created_by == session('mwenyekiti_id'))
                                        Mwenyekiti (Wewe)
                                    @else
                                        Balozi
                                    @endif
                                </div>
                            </div>
                            <div class="creator-body">
                                @if($maendeleo->createdBy && $maendeleo->created_by != session('mwenyekiti_id'))
                                    @if($maendeleo->createdBy->phone)
                                        <div class="creator-info-item">
                                            <div class="creator-info-icon">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="creator-info-content">
                                                <div class="creator-info-label">Simu</div>
                                                <div class="creator-info-value">{{ $maendeleo->createdBy->phone }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($maendeleo->createdBy->email)
                                        <div class="creator-info-item">
                                            <div class="creator-info-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="creator-info-content">
                                                <div class="creator-info-label">Barua Pepe</div>
                                                <div class="creator-info-value">{{ $maendeleo->createdBy->email }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($maendeleo->createdBy->street_village)
                                        <div class="creator-info-item">
                                            <div class="creator-info-icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="creator-info-content">
                                                <div class="creator-info-label">Mahali</div>
                                                <div class="creator-info-value">{{ $maendeleo->createdBy->street_village }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($maendeleo->createdBy->shina)
                                        <div class="creator-info-item">
                                            <div class="creator-info-icon">
                                                <i class="fas fa-tree"></i>
                                            </div>
                                            <div class="creator-info-content">
                                                <div class="creator-info-label">Shina</div>
                                                <div class="creator-info-value">{{ $maendeleo->createdBy->shina }} - {{ $maendeleo->createdBy->shina_number }}</div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="creator-info-item">
                                        <div class="creator-info-icon">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="creator-info-content">
                                            <div class="creator-info-label">Cheo</div>
                                            <div class="creator-info-value">Mwenyekiti wa Kata</div>
                                        </div>
                                    </div>
                                    <div class="creator-info-item">
                                        <div class="creator-info-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="creator-info-content">
                                            <div class="creator-info-label">Hali</div>
                                            <div class="creator-info-value">Mkuu wa Maendeleo</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="timeline-card">
                            <div class="timeline-header">
                                <h3>
                                    <i class="fas fa-clock"></i>
                                    Historia ya Rekodi
                                </h3>
                            </div>
                            <div class="timeline-body">
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-text">Rekodi imeongezwa</div>
                                        <div class="timeline-date">{{ $maendeleo->created_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>

                                @if($maendeleo->updated_at->ne($maendeleo->created_at))
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="fas fa-edit"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-text">Rekodi imebadilishwa</div>
                                            <div class="timeline-date">{{ $maendeleo->updated_at->format('d/m/Y H:i') }}</div>
                                        </div>
                                    </div>
                                @endif

                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-text">Rekodi imeangaziwa</div>
                                        <div class="timeline-date">{{ now()->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons (if owner) -->
                        @if($maendeleo->created_by == session('mwenyekiti_id'))
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                <a href="{{ route('mwenyekiti.maendeleo.edit', $maendeleo->id) }}" 
                                   class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Hariri Rekodi
                                </a>
                                <form method="POST" 
                                      action="{{ route('mwenyekiti.maendeleo.destroy', $maendeleo->id) }}"
                                      onsubmit="return confirm('Je, una uhakika unataka kufuta rekodi hii ya maendeleo? Haitaweza kurejeshwa.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="width: 100%;">
                                        <i class="fas fa-trash"></i> Futa Rekodi
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
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
        });
    </script>
</body>
</html>