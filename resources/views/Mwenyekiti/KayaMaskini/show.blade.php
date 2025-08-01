<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angalia Kaya Maskini | Mwenyekiti Dashboard</title>
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
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: var(--text-muted);
        }

        /* Main Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 24px;
        }

        /* Personal Information Card */
        .info-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .info-header {
            padding: 20px 24px;
            background: var(--primary-light);
            border-bottom: 1px solid var(--border-color);
        }

        .info-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-body {
            padding: 24px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .info-value.empty {
            color: var(--text-muted);
            font-style: italic;
        }

        /* Gender Badge */
        .gender-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .gender-male {
            background: #dbeafe;
            color: #1e40af;
        }

        .gender-female {
            background: #fce7f3;
            color: #be185d;
        }

        /* Household Members Section */
        .household-section {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .household-header {
            display: flex;
            align-items: center;
            justify-content: between;
            margin-bottom: 16px;
        }

        .household-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .household-count {
            background: var(--info-color);
            color: white;
            padding: 2px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
        }

        .members-list {
            display: grid;
            gap: 12px;
        }

        .member-item {
            padding: 16px;
            background: var(--secondary-color);
            border-radius: var(--radius-md);
            border-left: 4px solid var(--primary-color);
        }

        .member-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .member-name {
            font-weight: 600;
            color: var(--text-color);
        }

        .member-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
            font-size: 14px;
        }

        .member-detail {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .member-detail-label {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 500;
        }

        .member-detail-value {
            color: var(--text-color);
        }

        /* Sidebar Info */
        .sidebar-info {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Balozi Info Card */
        .balozi-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .balozi-header {
            padding: 20px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            text-align: center;
        }

        .balozi-avatar {
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

        .balozi-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .balozi-title {
            font-size: 14px;
            opacity: 0.9;
        }

        .balozi-body {
            padding: 20px;
        }

        .balozi-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .balozi-info-item:last-child {
            border-bottom: none;
        }

        .balozi-info-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            background: var(--primary-light);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .balozi-info-content {
            flex: 1;
        }

        .balozi-info-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .balozi-info-value {
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
            background: var(--success-color);
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
            background: var(--success-color);
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
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: var(--border-color);
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background: var(--text-muted);
            color: white;
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

            .info-grid {
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

            .member-details {
                grid-template-columns: 1fr;
                gap: 8px;
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
            <h1>Angalia Kaya Maskini</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('mwenyekiti.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-separator">/</span>
                    <a href="{{ route('mwenyekiti.kaya-maskini.index') }}">Kaya Maskini</a>
                    <span class="breadcrumb-separator">/</span>
                    <span>{{ $kayaMaskini->first_name }} {{ $kayaMaskini->last_name }}</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-content">
                        <div class="header-left">
                            <h1 class="page-title">Taarifa za Kaya Maskini</h1>
                            <p class="page-subtitle">Angalia maelezo kamili ya {{ $kayaMaskini->first_name }} {{ $kayaMaskini->middle_name }} {{ $kayaMaskini->last_name }}</p>
                        </div>
                        <div class="header-actions">
                            <a href="{{ route('mwenyekiti.kaya-maskini.index', ['balozi_id' => $kayaMaskini->created_by]) }}" 
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Rudi Orodha
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

                <!-- Content Grid -->
                <div class="content-grid">
                    <!-- Main Information -->
                    <div>
                        <!-- Personal Information -->
                        <div class="info-card">
                            <div class="info-header">
                                <h3>
                                    <i class="fas fa-user"></i>
                                    Taarifa za Kibinafsi
                                </h3>
                            </div>
                            <div class="info-body">
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Jina la Kwanza</div>
                                        <div class="info-value">{{ $kayaMaskini->first_name }}</div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Jina la Kati</div>
                                        <div class="info-value {{ !$kayaMaskini->middle_name ? 'empty' : '' }}">
                                            {{ $kayaMaskini->middle_name ?: 'Hakijazaliswa' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Jina la Mwisho</div>
                                        <div class="info-value">{{ $kayaMaskini->last_name }}</div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Jinsia</div>
                                        <div class="info-value">
                                            <span class="gender-badge gender-{{ $kayaMaskini->gender }}">
                                                {{ $kayaMaskini->gender == 'male' ? 'Mume' : 'Mke' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Nambari ya Simu</div>
                                        <div class="info-value {{ !$kayaMaskini->phone ? 'empty' : '' }}">
                                            {{ $kayaMaskini->phone ?: 'Haijazaliswa' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Mtaa</div>
                                        <div class="info-value">{{ $kayaMaskini->street }}</div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Idadi ya Watu Nyumbani</div>
                                        <div class="info-value">
                                            <strong style="color: var(--primary-color); font-size: 16px;">
                                                {{ $kayaMaskini->household_count ?: '0' }} Watu
                                            </strong>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Tarehe ya Kuongezwa</div>
                                        <div class="info-value">{{ $kayaMaskini->created_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>

                                <!-- Description -->
                                @if($kayaMaskini->description)
                                    <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border-color);">
                                        <div class="info-item">
                                            <div class="info-label">Maelezo ya Ziada</div>
                                            <div class="info-value" style="white-space: pre-line; line-height: 1.6;">{{ $kayaMaskini->description }}</div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Household Members -->
                                @if(!empty($householdMembers) && count($householdMembers) > 0)
                                    <div class="household-section">
                                        <div class="household-header">
                                            <h4 class="household-title">
                                                <i class="fas fa-users"></i>
                                                Wanafamilia
                                                <span class="household-count">{{ count($householdMembers) }}</span>
                                            </h4>
                                        </div>
                                        <div class="members-list">
                                            @foreach($householdMembers as $index => $member)
                                                <div class="member-item">
                                                    <div class="member-header">
                                                        <div class="member-name">
                                                            {{ $member['name'] ?? 'Jina halijazaliswa' }}
                                                        </div>
                                                        <small style="color: var(--text-muted);">#{{ $index + 1 }}</small>
                                                    </div>
                                                    <div class="member-details">
                                                        @if(isset($member['age']))
                                                            <div class="member-detail">
                                                                <div class="member-detail-label">Umri</div>
                                                                <div class="member-detail-value">{{ $member['age'] }} miaka</div>
                                                            </div>
                                                        @endif

                                                        @if(isset($member['gender']))
                                                            <div class="member-detail">
                                                                <div class="member-detail-label">Jinsia</div>
                                                                <div class="member-detail-value">{{ $member['gender'] == 'male' ? 'Mume' : 'Mke' }}</div>
                                                            </div>
                                                        @endif

                                                        @if(isset($member['relationship']))
                                                            <div class="member-detail">
                                                                <div class="member-detail-label">Uhusiano</div>
                                                                <div class="member-detail-value">{{ $member['relationship'] }}</div>
                                                            </div>
                                                        @endif

                                                        @if(isset($member['occupation']))
                                                            <div class="member-detail">
                                                                <div class="member-detail-label">Kazi</div>
                                                                <div class="member-detail-value">{{ $member['occupation'] ?: 'Haijazaliswa' }}</div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="household-section">
                                        <div class="household-header">
                                            <h4 class="household-title">
                                                <i class="fas fa-users"></i>
                                                Wanafamilia
                                            </h4>
                                        </div>
                                        <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
                                            <i class="fas fa-users" style="font-size: 32px; margin-bottom: 12px; opacity: 0.5;"></i>
                                            <p>Hakuna taarifa za wanafamilia zilizohifadhiwa</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Information -->
                    <div class="sidebar-info">
                        <!-- Balozi Information -->
                        <div class="balozi-card">
                            <div class="balozi-header">
                                <div class="balozi-avatar">
                                    {{ strtoupper(substr($kayaMaskini->createdBy->first_name, 0, 1) . substr($kayaMaskini->createdBy->last_name, 0, 1)) }}
                                </div>
                                <div class="balozi-name">{{ $kayaMaskini->createdBy->first_name }} {{ $kayaMaskini->createdBy->last_name }}</div>
                                <div class="balozi-title">Balozi Aliyeongeza</div>
                            </div>
                            <div class="balozi-body">
                                <div class="balozi-info-item">
                                    <div class="balozi-info-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="balozi-info-content">
                                        <div class="balozi-info-label">Simu</div>
                                        <div class="balozi-info-value">{{ $kayaMaskini->createdBy->phone ?: 'Haijazaliswa' }}</div>
                                    </div>
                                </div>

                                @if($kayaMaskini->createdBy->email)
                                    <div class="balozi-info-item">
                                        <div class="balozi-info-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="balozi-info-content">
                                            <div class="balozi-info-label">Barua Pepe</div>
                                            <div class="balozi-info-value">{{ $kayaMaskini->createdBy->email }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if($kayaMaskini->createdBy->street_village)
                                    <div class="balozi-info-item">
                                        <div class="balozi-info-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="balozi-info-content">
                                            <div class="balozi-info-label">Mahali</div>
                                            <div class="balozi-info-value">{{ $kayaMaskini->createdBy->street_village }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if($kayaMaskini->createdBy->shina)
                                    <div class="balozi-info-item">
                                        <div class="balozi-info-icon">
                                            <i class="fas fa-tree"></i>
                                        </div>
                                        <div class="balozi-info-content">
                                            <div class="balozi-info-label">Shina</div>
                                            <div class="balozi-info-value">{{ $kayaMaskini->createdBy->shina }} - {{ $kayaMaskini->createdBy->shina_number }}</div>
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
                                        <div class="timeline-date">{{ $kayaMaskini->created_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>

                                @if($kayaMaskini->updated_at->ne($kayaMaskini->created_at))
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="fas fa-edit"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-text">Rekodi imebadilishwa</div>
                                            <div class="timeline-date">{{ $kayaMaskini->updated_at->format('d/m/Y H:i') }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
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