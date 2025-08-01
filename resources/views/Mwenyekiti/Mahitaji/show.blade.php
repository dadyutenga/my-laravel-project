<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angalia Mtu wenye Mahitaji Maalumu | Mwenyekiti Dashboard</title>
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
            --purple-color: #8b5cf6;
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
            color: var(--purple-color);
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
            background: rgba(139, 92, 246, 0.1);
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

        .info-value.large {
            font-size: 18px;
            font-weight: 600;
            color: var(--purple-color);
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

        /* Disability Type Card */
        .disability-section {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .disability-header {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .disability-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .disability-content {
            background: rgba(139, 92, 246, 0.05);
            padding: 20px;
            border-radius: var(--radius-md);
            border-left: 4px solid var(--purple-color);
        }

        .disability-type {
            font-size: 16px;
            font-weight: 600;
            color: var(--purple-color);
            margin-bottom: 8px;
        }

        .disability-description {
            color: var(--text-color);
            line-height: 1.6;
            font-size: 14px;
        }

        /* PDF Viewer Section */
        .pdf-section {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .pdf-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .pdf-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pdf-actions {
            display: flex;
            gap: 8px;
        }

        .pdf-viewer {
            width: 100%;
            height: 400px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
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
            background: linear-gradient(135deg, var(--purple-color) 0%, #7c3aed 100%);
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
            background: rgba(139, 92, 246, 0.1);
            color: var(--purple-color);
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

        /* Record Info Card */
        .record-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .record-header {
            padding: 20px 24px;
            background: var(--success-color);
            color: white;
        }

        .record-header h3 {
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .record-body {
            padding: 20px;
        }

        .record-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
        }

        .record-icon {
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

        .record-content {
            flex: 1;
        }

        .record-text {
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 2px;
        }

        .record-date {
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
            background: var(--purple-color);
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

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #37b025;
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 12px;
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

            .pdf-viewer {
                height: 300px;
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
            <h1>Angalia Mahitaji Maalumu</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('mwenyekiti.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-separator">/</span>
                    <a href="{{ route('mwenyekiti.mahitaji.index') }}">Watu wenye Mahitaji Maalumu</a>
                    <span class="breadcrumb-separator">/</span>
                    <span>{{ $mahitaji->first_name }} {{ $mahitaji->last_name }}</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-content">
                        <div class="header-left">
                            <h1 class="page-title">Taarifa za Mtu wenye Mahitaji Maalumu</h1>
                            <p class="page-subtitle">Angalia maelezo kamili ya {{ $mahitaji->first_name }} {{ $mahitaji->middle_name }} {{ $mahitaji->last_name }}</p>
                        </div>
                        <div class="header-actions">
                            <a href="{{ route('mwenyekiti.mahitaji.index', ['balozi_id' => $mahitaji->created_by]) }}" 
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
                                        <div class="info-value">{{ $mahitaji->first_name }}</div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Jina la Kati</div>
                                        <div class="info-value {{ !$mahitaji->middle_name ? 'empty' : '' }}">
                                            {{ $mahitaji->middle_name ?: 'Hakijazaliswa' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Jina la Mwisho</div>
                                        <div class="info-value">{{ $mahitaji->last_name }}</div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Jinsia</div>
                                        <div class="info-value">
                                            <span class="gender-badge gender-{{ $mahitaji->gender }}">
                                                {{ $mahitaji->gender == 'male' ? 'Mume' : 'Mke' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Umri</div>
                                        <div class="info-value {{ !$mahitaji->age ? 'empty' : 'large' }}">
                                            {{ $mahitaji->age ? $mahitaji->age . ' miaka' : 'Haujazaliswa' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Nambari ya Simu</div>
                                        <div class="info-value {{ !$mahitaji->phone ? 'empty' : '' }}">
                                            {{ $mahitaji->phone ?: 'Haijazaliswa' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Nambari ya NIDA</div>
                                        <div class="info-value {{ !$mahitaji->nida_number ? 'empty' : '' }}">
                                            {{ $mahitaji->nida_number ?: 'Haijazaliswa' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">Tarehe ya Kuongezwa</div>
                                        <div class="info-value">{{ $mahitaji->created_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>

                                <!-- Disability Information -->
                                @if($mahitaji->disability_type)
                                    <div class="disability-section">
                                        <div class="disability-header">
                                            <h4 class="disability-title">
                                                <i class="fas fa-wheelchair"></i>
                                                Aina ya Ulemavu
                                            </h4>
                                        </div>
                                        <div class="disability-content">
                                            <div class="disability-type">{{ $mahitaji->disability_type }}</div>
                                            <div class="disability-description">
                                                Mtu huyu ana mahitaji maalumu yanayohusiana na aina hii ya ulemavu. 
                                                Anahitaji msaada na uongozi maalumu kulingana na hali yake.
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- PDF Document Section -->
                                @if($mahitaji->pdf_file_path)
                                    <div class="pdf-section">
                                        <div class="pdf-header">
                                            <h4 class="pdf-title">
                                                <i class="fas fa-file-pdf"></i>
                                                Hati za Kuthibitisha
                                            </h4>
                                            <div class="pdf-actions">
                                                <a href="{{ Storage::url($mahitaji->pdf_file_path) }}" 
                                                   target="_blank" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-external-link-alt"></i> Fungua
                                                </a>
                                                <a href="{{ Storage::url($mahitaji->pdf_file_path) }}" 
                                                   download 
                                                   class="btn btn-success btn-sm">
                                                    <i class="fas fa-download"></i> Pakua
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pdf-viewer">
                                            <div style="text-align: center;">
                                                <i class="fas fa-file-pdf" style="font-size: 32px; color: var(--purple-color); margin-bottom: 12px;"></i>
                                                <p>Bofya "Fungua" ili kuona hati kamili</p>
                                                <small style="color: var(--text-muted);">Faili: {{ basename($mahitaji->pdf_file_path) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="pdf-section">
                                        <div class="pdf-header">
                                            <h4 class="pdf-title">
                                                <i class="fas fa-file-pdf"></i>
                                                Hati za Kuthibitisha
                                            </h4>
                                        </div>
                                        <div class="pdf-viewer">
                                            <div style="text-align: center;">
                                                <i class="fas fa-file-pdf" style="font-size: 32px; color: var(--text-muted); margin-bottom: 12px; opacity: 0.5;"></i>
                                                <p style="color: var(--text-muted);">Hakuna hati zilizopakiwa</p>
                                            </div>
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
                                    {{ strtoupper(substr($mahitaji->createdBy->first_name, 0, 1) . substr($mahitaji->createdBy->last_name, 0, 1)) }}
                                </div>
                                <div class="balozi-name">{{ $mahitaji->createdBy->first_name }} {{ $mahitaji->createdBy->last_name }}</div>
                                <div class="balozi-title">Balozi Aliyeongeza</div>
                            </div>
                            <div class="balozi-body">
                                <div class="balozi-info-item">
                                    <div class="balozi-info-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="balozi-info-content">
                                        <div class="balozi-info-label">Simu</div>
                                        <div class="balozi-info-value">{{ $mahitaji->createdBy->phone ?: 'Haijazaliswa' }}</div>
                                    </div>
                                </div>

                                @if($mahitaji->createdBy->email)
                                    <div class="balozi-info-item">
                                        <div class="balozi-info-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="balozi-info-content">
                                            <div class="balozi-info-label">Barua Pepe</div>
                                            <div class="balozi-info-value">{{ $mahitaji->createdBy->email }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if($mahitaji->createdBy->street_village)
                                    <div class="balozi-info-item">
                                        <div class="balozi-info-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="balozi-info-content">
                                            <div class="balozi-info-label">Mahali</div>
                                            <div class="balozi-info-value">{{ $mahitaji->createdBy->street_village }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if($mahitaji->createdBy->shina)
                                    <div class="balozi-info-item">
                                        <div class="balozi-info-icon">
                                            <i class="fas fa-tree"></i>
                                        </div>
                                        <div class="balozi-info-content">
                                            <div class="balozi-info-label">Shina</div>
                                            <div class="balozi-info-value">{{ $mahitaji->createdBy->shina }} - {{ $mahitaji->createdBy->shina_number }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Record Timeline -->
                        <div class="record-card">
                            <div class="record-header">
                                <h3>
                                    <i class="fas fa-clock"></i>
                                    Historia ya Rekodi
                                </h3>
                            </div>
                            <div class="record-body">
                                <div class="record-item">
                                    <div class="record-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="record-content">
                                        <div class="record-text">Rekodi imeongezwa</div>
                                        <div class="record-date">{{ $mahitaji->created_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>

                                @if($mahitaji->updated_at->ne($mahitaji->created_at))
                                    <div class="record-item">
                                        <div class="record-icon">
                                            <i class="fas fa-edit"></i>
                                        </div>
                                        <div class="record-content">
                                            <div class="record-text">Rekodi imebadilishwa</div>
                                            <div class="record-date">{{ $mahitaji->updated_at->format('d/m/Y H:i') }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if($mahitaji->pdf_file_path)
                                    <div class="record-item">
                                        <div class="record-icon">
                                            <i class="fas fa-file-upload"></i>
                                        </div>
                                        <div class="record-content">
                                            <div class="record-text">Hati zimepakiwa</div>
                                            <div class="record-date">{{ $mahitaji->created_at->format('d/m/Y H:i') }}</div>
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