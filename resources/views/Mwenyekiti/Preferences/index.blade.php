<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mipanglio ya Akaunti | Mwenyekiti Dashboard</title>
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
            --success-color: #37b025;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --security-color: #37b025;
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
            max-width: 1000px;
            margin: 0 auto;
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
            color: var(--security-color);
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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 14px;
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            background: rgba(5, 150, 105, 0.1);
            color: var(--security-color);
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
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

        /* Preferences Layout */
        .preferences-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 24px;
        }

        /* Settings Navigation */
        .settings-nav {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 20px 0;
            height: fit-content;
            position: sticky;
            top: 24px;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section:last-child {
            margin-bottom: 0;
        }

        .nav-section-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 20px;
            margin-bottom: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: var(--transition);
            border-right: 3px solid transparent;
            cursor: pointer;
        }

        .nav-item:hover {
            background: rgba(5, 150, 105, 0.05);
            color: var(--security-color);
        }

        .nav-item.active {
            background: rgba(5, 150, 105, 0.1);
            color: var(--security-color);
            border-right-color: var(--security-color);
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        /* Settings Content */
        .settings-content {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .section-header {
            padding: 20px 24px;
            background: rgba(5, 150, 105, 0.05);
            border-bottom: 1px solid var(--border-color);
        }

        .section-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .section-description {
            font-size: 14px;
            color: var(--text-muted);
        }

        .section-body {
            padding: 24px;
        }

        /* Form Elements */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-label.required::after {
            content: ' *';
            color: var(--error-color);
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            font-family: inherit;
            transition: var(--transition);
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--security-color);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }

        .form-help {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .form-error {
            font-size: 12px;
            color: var(--error-color);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-group.has-error .form-input {
            border-color: var(--error-color);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Password Strength */
        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            height: 4px;
            background: var(--border-color);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-text {
            font-size: 12px;
            font-weight: 500;
        }

        .strength-feedback {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .strength-feedback ul {
            margin: 0;
            padding-left: 16px;
        }

        /* Current Info Card */
        .current-info-card {
            background: rgba(5, 150, 105, 0.05);
            border: 1px solid rgba(5, 150, 105, 0.2);
            border-radius: var(--radius-md);
            padding: 16px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(5, 150, 105, 0.1);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .info-value {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Security Activities */
        .activity-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(5, 150, 105, 0.1);
            color: var(--security-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-description {
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .activity-meta {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Action Buttons */
        .form-actions {
            padding: 20px 24px;
            background: var(--secondary-color);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
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
            background: var(--security-color);
            color: white;
        }

        .btn-primary:hover {
            background: #047857;
        }

        .btn-primary:disabled {
            background: var(--text-muted);
            cursor: not-allowed;
        }

        .btn-secondary {
            background: var(--border-color);
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background: var(--text-muted);
            color: white;
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

            .preferences-layout {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .settings-nav {
                position: static;
                order: 2;
            }

            .settings-content {
                order: 1;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                justify-content: center;
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
            <h1>Mipanglio</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('mwenyekiti.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-separator">/</span>
                    <span>Mipanglio ya Akaunti</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-content">
                        <div class="header-left">
                            <h1 class="page-title">
                                <i class="fas fa-user-cog"></i>
                                Mipanglio ya Akaunti
                            </h1>
                            <p class="page-subtitle">Dhibiti taarifa zako za kibinafsi na usalama wa akaunti</p>
                            <div class="security-badge">
                                <i class="fas fa-shield-alt"></i>
                                Akaunti Salama
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

                <!-- Preferences Layout -->
                <div class="preferences-layout">
                    <!-- Settings Navigation -->
                    <div class="settings-nav">
                        <div class="nav-section">
                            <div class="nav-section-title">Akaunti</div>
                            <div class="nav-item active" data-section="profile">
                                <div class="nav-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="nav-text">Taarifa za Msingi</div>
                            </div>
                            <div class="nav-item" data-section="password">
                                <div class="nav-icon">
                                    <i class="fas fa-key"></i>
                                </div>
                                <div class="nav-text">Badilisha Nenosiri</div>
                            </div>
                        </div>

                        <div class="nav-section">
                            <div class="nav-section-title">Usalama</div>
                            <div class="nav-item" data-section="security">
                                <div class="nav-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="nav-text">Historia ya Usalama</div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Content -->
                    <div class="settings-content">
                        <!-- Profile Section -->
                        <div class="content-section active" id="profile-section">
                            <div class="section-header">
                                <h3>
                                    <i class="fas fa-user"></i>
                                    Taarifa za Msingi
                                </h3>
                                <div class="section-description">
                                    Sasisha taarifa zako za kibinafsi na za mawasiliano
                                </div>
                            </div>

                            <form method="POST" action="{{ route('mwenyekiti.preferences.update-profile') }}" id="profile-form">
                                @csrf
                                @method('PUT')
                                <div class="section-body">
                                    <!-- Current Information -->
                                    <div class="current-info-card">
                                        <div class="info-item">
                                            <div class="info-label">Jina la Mtumiaji wa Sasa</div>
                                            <div class="info-value">{{ $mwenyekiti->username }}</div>
                                        </div>
                                        @if($mwenyekitiData->email)
                                            <div class="info-item">
                                                <div class="info-label">Barua Pepe ya Sasa</div>
                                                <div class="info-value">{{ $mwenyekitiData->email }}</div>
                                            </div>
                                        @endif
                                        @if($mwenyekitiData->phone)
                                            <div class="info-item">
                                                <div class="info-label">Nambari ya Simu ya Sasa</div>
                                                <div class="info-value">{{ $mwenyekitiData->phone }}</div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Form Fields -->
                                    <div class="form-row">
                                        <!-- Username -->
                                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                            <label class="form-label required" for="username">Jina la Mtumiaji</label>
                                            <input type="text" 
                                                   id="username" 
                                                   name="username" 
                                                   class="form-input" 
                                                   placeholder="Ingiza jina la mtumiaji"
                                                   value="{{ old('username', $mwenyekiti->username) }}"
                                                   maxlength="50"
                                                   required>
                                            <div class="form-help">Herufi, nambari, na alama (. _ -) pekee</div>
                                            @if($errors->has('username'))
                                                <div class="form-error">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $errors->first('username') }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label class="form-label" for="email">Barua Pepe</label>
                                            <input type="email" 
                                                   id="email" 
                                                   name="email" 
                                                   class="form-input" 
                                                   placeholder="mwenyekiti@email.com"
                                                   value="{{ old('email', $mwenyekitiData->email) }}">
                                            <div class="form-help">Si lazima, lakini inasaidia katika kurudi nenosiri</div>
                                            @if($errors->has('email'))
                                                <div class="form-error">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                        <label class="form-label" for="phone">Nambari ya Simu</label>
                                        <input type="tel" 
                                               id="phone" 
                                               name="phone" 
                                               class="form-input" 
                                               placeholder="+255712345678 au 0712345678"
                                               value="{{ old('phone', $mwenyekitiData->phone) }}">
                                        <div class="form-help">Ingiza nambari ya simu ya Tanzania</div>
                                        @if($errors->has('phone'))
                                            <div class="form-error">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $errors->first('phone') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="button" class="btn btn-secondary" onclick="window.location.reload()">
                                        <i class="fas fa-undo"></i> Futa Mabadiliko
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="profile-submit-btn">
                                        <i class="fas fa-save"></i> Hifadhi Mabadiliko
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Password Section -->
                        <div class="content-section" id="password-section">
                            <div class="section-header">
                                <h3>
                                    <i class="fas fa-key"></i>
                                    Badilisha Nenosiri
                                </h3>
                                <div class="section-description">
                                    Badilisha nenosiri lako kwa usalama zaidi
                                </div>
                            </div>

                            <form method="POST" action="{{ route('mwenyekiti.preferences.update-password') }}" id="password-form">
                                @csrf
                                @method('PUT')
                                <div class="section-body">
                                    <!-- Current Password -->
                                    <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                                        <label class="form-label required" for="current_password">Nenosiri la Sasa</label>
                                        <input type="password" 
                                               id="current_password" 
                                               name="current_password" 
                                               class="form-input" 
                                               placeholder="Ingiza nenosiri lako la sasa"
                                               required>
                                        <div class="form-help">Ingiza nenosiri lako la sasa ili kuthibitisha</div>
                                        @if($errors->has('current_password'))
                                            <div class="form-error">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $errors->first('current_password') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-row">
                                        <!-- New Password -->
                                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                            <label class="form-label required" for="password">Nenosiri Jipya</label>
                                            <input type="password" 
                                                   id="password" 
                                                   name="password" 
                                                   class="form-input" 
                                                   placeholder="Ingiza nenosiri jipya"
                                                   required>
                                            
                                            <!-- Password Strength Indicator -->
                                            <div class="password-strength" id="password-strength" style="display: none;">
                                                <div class="strength-bar">
                                                    <div class="strength-fill" id="strength-fill"></div>
                                                </div>
                                                <div class="strength-text" id="strength-text"></div>
                                                <div class="strength-feedback" id="strength-feedback"></div>
                                            </div>

                                            <div class="form-help">Angalau herufi 8, herufi kubwa/ndogo, nambari na alama</div>
                                            @if($errors->has('password'))
                                                <div class="form-error">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                            <label class="form-label required" for="password_confirmation">Thibitisha Nenosiri</label>
                                            <input type="password" 
                                                   id="password_confirmation" 
                                                   name="password_confirmation" 
                                                   class="form-input" 
                                                   placeholder="Ingiza nenosiri tena"
                                                   required>
                                            <div class="form-help">Rudia nenosiri jipya ili kuthibitisha</div>
                                            @if($errors->has('password_confirmation'))
                                                <div class="form-error">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $errors->first('password_confirmation') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('password-form').reset()">
                                        <i class="fas fa-times"></i> Ghairi
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="password-submit-btn">
                                        <i class="fas fa-key"></i> Badilisha Nenosiri
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Security Section -->
                        <div class="content-section" id="security-section">
                            <div class="section-header">
                                <h3>
                                    <i class="fas fa-shield-alt"></i>
                                    Historia ya Usalama
                                </h3>
                                <div class="section-description">
                                    Shughuli za hivi karibuni za akaunti yako
                                </div>
                            </div>

                            <div class="section-body">
                                <div class="activity-list" id="activity-list">
                                    <div style="text-align: center; padding: 40px; color: var(--text-muted);">
                                        <i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 12px;"></i>
                                        <div>Inapakia historia ya usalama...</div>
                                    </div>
                                </div>
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

            // Settings navigation
            const navItems = document.querySelectorAll('.nav-item');
            const contentSections = document.querySelectorAll('.content-section');

            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    const targetSection = this.dataset.section;
                    
                    // Update navigation
                    navItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update content
                    contentSections.forEach(section => section.classList.remove('active'));
                    document.getElementById(targetSection + '-section').classList.add('active');
                });
            });

            // Password strength checker
            const passwordInput = document.getElementById('password');
            const strengthIndicator = document.getElementById('password-strength');
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');
            const strengthFeedback = document.getElementById('strength-feedback');

            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    
                    if (password.length === 0) {
                        strengthIndicator.style.display = 'none';
                        return;
                    }
                    
                    strengthIndicator.style.display = 'block';
                    checkPasswordStrength(password);
                });
            }

            function checkPasswordStrength(password) {
                fetch('{{ route("mwenyekiti.preferences.check-password-strength") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ password: password })
                })
                .then(response => response.json())
                .then(data => {
                    strengthFill.style.width = data.score + '%';
                    strengthFill.style.backgroundColor = data.color;
                    strengthText.textContent = data.message;
                    strengthText.style.color = data.color;
                    
                    if (data.feedback && data.feedback.length > 0) {
                        strengthFeedback.innerHTML = '<ul><li>' + data.feedback.join('</li><li>') + '</li></ul>';
                    } else {
                        strengthFeedback.innerHTML = '';
                    }
                })
                .catch(error => {
                    console.error('Password strength check error:', error);
                });
            }

            // Form submissions
            const profileForm = document.getElementById('profile-form');
            const passwordForm = document.getElementById('password-form');

            if (profileForm) {
                profileForm.addEventListener('submit', function() {
                    const submitBtn = document.getElementById('profile-submit-btn');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<div class="spinner"></div> Inahifadhi...';
                });
            }

            if (passwordForm) {
                passwordForm.addEventListener('submit', function() {
                    const submitBtn = document.getElementById('password-submit-btn');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<div class="spinner"></div> Inabadilisha...';
                });
            }

            // Load security activities
            loadSecurityActivities();

            function loadSecurityActivities() {
                fetch('{{ route("mwenyekiti.preferences.security-activities") }}')
                    .then(response => response.json())
                    .then(data => {
                        const activityList = document.getElementById('activity-list');
                        
                        if (data.activities && data.activities.length > 0) {
                            let html = '';
                            data.activities.forEach(activity => {
                                const icon = getActivityIcon(activity.description);
                                html += `
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="fas fa-${icon}"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-description">${activity.description}</div>
                                            <div class="activity-meta">
                                                ${activity.created_at} (${activity.created_at_human})
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                            activityList.innerHTML = html;
                        } else {
                            activityList.innerHTML = `
                                <div style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    <i class="fas fa-history" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                                    <div style="font-size: 16px; margin-bottom: 8px;">Hakuna shughuli za hivi karibuni</div>
                                    <div style="font-size: 14px;">Shughuli zako za usalama zitaonekana hapa</div>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Security activities error:', error);
                        document.getElementById('activity-list').innerHTML = `
                            <div style="text-align: center; padding: 40px; color: var(--error-color);">
                                <i class="fas fa-exclamation-triangle" style="font-size: 48px; margin-bottom: 16px;"></i>
                                <div>Kuna tatizo katika kupakia historia ya usalama</div>
                            </div>
                        `;
                    });
            }

            function getActivityIcon(description) {
                if (description.includes('login')) return 'sign-in-alt';
                if (description.includes('password')) return 'key';
                if (description.includes('profile')) return 'user-edit';
                if (description.includes('logout')) return 'sign-out-alt';
                return 'shield-alt';
            }
        });
    </script>
</body>
</html>