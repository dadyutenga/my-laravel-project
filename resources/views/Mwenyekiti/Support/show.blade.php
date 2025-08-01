<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ombi la Msaada #{{ $ticket->ticket_number }} | Mwenyekiti Dashboard</title>
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
            --support-color: #8b5cf6;
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
            max-width: 900px;
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
            color: var(--support-color);
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
            align-items: flex-start;
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
            margin-bottom: 16px;
        }

        .ticket-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .meta-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .meta-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-color);
        }

        .header-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Status and Priority Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge.status-open {
            background: rgba(59, 130, 246, 0.15);
            color: #1d4ed8;
        }

        .badge.status-in_progress {
            background: rgba(245, 158, 11, 0.15);
            color: #b45309;
        }

        .badge.status-resolved {
            background: rgba(16, 185, 129, 0.15);
            color: #047857;
        }

        .badge.status-closed {
            background: rgba(107, 114, 128, 0.15);
            color: #374151;
        }

        .badge.priority-low {
            background: rgba(16, 185, 129, 0.15);
            color: #047857;
        }

        .badge.priority-medium {
            background: rgba(245, 158, 11, 0.15);
            color: #b45309;
        }

        .badge.priority-high {
            background: rgba(251, 146, 60, 0.15);
            color: #c2410c;
        }

        .badge.priority-urgent {
            background: rgba(239, 68, 68, 0.15);
            color: #dc2626;
        }

        /* Ticket Content */
        .ticket-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .main-content-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            background: rgba(139, 92, 246, 0.05);
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-body {
            padding: 24px;
        }

        .description-text {
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-color);
            white-space: pre-wrap;
        }

        /* Sidebar Info */
        .sidebar-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .info-item {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 14px;
            color: var(--text-color);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--support-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 12px;
        }

        .admin-details {
            flex: 1;
        }

        .admin-name {
            font-weight: 500;
            font-size: 14px;
            color: var(--text-color);
        }

        .admin-role {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Attachments */
        .attachments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }

        .attachment-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--secondary-color);
            border-radius: var(--radius-md);
            transition: var(--transition);
            cursor: pointer;
        }

        .attachment-item:hover {
            background: rgba(139, 92, 246, 0.1);
        }

        .attachment-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            background: var(--support-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .attachment-info {
            flex: 1;
            min-width: 0;
        }

        .attachment-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .attachment-size {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Resolution Section */
        .resolution-section {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .resolution-text {
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-color);
            white-space: pre-wrap;
            background: rgba(16, 185, 129, 0.05);
            padding: 16px;
            border-radius: var(--radius-md);
            border-left: 4px solid var(--success-color);
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
            background: var(--support-color);
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
            background: #047857;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 12px;
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

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 24px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--border-color);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 24px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -28px;
            top: 8px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--support-color);
            border: 2px solid white;
            box-shadow: 0 0 0 2px var(--support-color);
        }

        .timeline-content {
            background: white;
            padding: 16px;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .timeline-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .timeline-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-color);
        }

        .timeline-date {
            font-size: 12px;
            color: var(--text-muted);
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

            .ticket-content {
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

            .btn {
                flex: 1;
                justify-content: center;
            }

            .attachments-grid {
                grid-template-columns: 1fr;
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
            <h1>Ombi #{{ $ticket->ticket_number }}</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('mwenyekiti.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-separator">/</span>
                    <a href="{{ route('mwenyekiti.support.index') }}">Maombi ya Msaada</a>
                    <span class="breadcrumb-separator">/</span>
                    <span>{{ $ticket->ticket_number }}</span>
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

                @if($ticket->status == 'resolved')
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        Ombi lako limetatuliwa! Je, umeona suluhisho? Bofya "Funga Ombi" kama umeridhika.
                    </div>
                @endif

                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-content">
                        <div class="header-left">
                            <h1 class="page-title">{{ $ticket->title }}</h1>
                            <p class="page-subtitle">Ombi la Msaada #{{ $ticket->ticket_number }}</p>
                            
                            <div class="ticket-meta">
                                <div class="meta-item">
                                    <div class="meta-label">Hali</div>
                                    <div class="meta-value">
                                        <span class="badge status-{{ $ticket->status }}">
                                            @if($ticket->status == 'open')
                                                <i class="fas fa-folder-open"></i> Mapya
                                            @elseif($ticket->status == 'in_progress')
                                                <i class="fas fa-spinner"></i> Yanafanyiwa Kazi
                                            @elseif($ticket->status == 'resolved')
                                                <i class="fas fa-check-circle"></i> Yametatuliwa
                                            @else
                                                <i class="fas fa-times-circle"></i> Yamefungwa
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="meta-item">
                                    <div class="meta-label">Kipaumbele</div>
                                    <div class="meta-value">
                                        <span class="badge priority-{{ $ticket->priority }}">
                                            @if($ticket->priority == 'low')
                                                <i class="fas fa-arrow-down"></i> Chini
                                            @elseif($ticket->priority == 'medium')
                                                <i class="fas fa-minus"></i> Wastani
                                            @elseif($ticket->priority == 'high')
                                                <i class="fas fa-arrow-up"></i> Juu
                                            @else
                                                <i class="fas fa-exclamation"></i> Haraka
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="meta-item">
                                    <div class="meta-label">Kategoria</div>
                                    <div class="meta-value">
                                        @php
                                            $categories = [
                                                'technical' => 'Tatizo la Kiufundi',
                                                'account' => 'Tatizo la Akaunti',
                                                'feature' => 'Ombi la Kipengele Kipya',
                                                'bug' => 'Hitilafu ya Mfumo',
                                                'training' => 'Mafunzo',
                                                'other' => 'Mengineyo'
                                            ];
                                        @endphp
                                        {{ $categories[$ticket->category] ?? $ticket->category }}
                                    </div>
                                </div>

                                <div class="meta-item">
                                    <div class="meta-label">Tarehe</div>
                                    <div class="meta-value">
                                        {{ $ticket->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="header-actions">
                            @if($ticket->status == 'open')
                                <a href="{{ route('mwenyekiti.support.edit', $ticket->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-edit"></i> Hariri
                                </a>
                            @endif
                            
                            @if($ticket->status == 'resolved')
                                <form method="POST" action="{{ route('mwenyekiti.support.close', $ticket->id) }}" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Je, una uhakika ombi limetatuliwa vizuri?')">
                                        <i class="fas fa-check"></i> Funga Ombi
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Ticket Content -->
                <div class="ticket-content">
                    <!-- Main Content -->
                    <div class="main-content-card">
                        <div class="card-header">
                            <h3>
                                <i class="fas fa-file-alt"></i>
                                Maelezo ya Ombi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="description-text">{{ $ticket->description }}</div>

                            @if($ticket->attachments && count($ticket->attachments) > 0)
                                <div style="margin-top: 24px;">
                                    <h4 style="margin-bottom: 16px; font-size: 16px; color: var(--text-color);">
                                        <i class="fas fa-paperclip"></i> Faili Zilizopakiwa ({{ count($ticket->attachments) }})
                                    </h4>
                                    <div class="attachments-grid">
                                        @foreach($ticket->attachments as $index => $attachment)
                                            <a href="{{ route('mwenyekiti.support.download', [$ticket->id, $index]) }}" 
                                               class="attachment-item">
                                                <div class="attachment-icon">
                                                    @php
                                                        $ext = strtolower(pathinfo($attachment['original_name'], PATHINFO_EXTENSION));
                                                        $icon = 'file';
                                                        if(in_array($ext, ['jpg', 'jpeg', 'png'])) $icon = 'image';
                                                        elseif($ext == 'pdf') $icon = 'file-pdf';
                                                        elseif(in_array($ext, ['doc', 'docx'])) $icon = 'file-word';
                                                        elseif($ext == 'txt') $icon = 'file-alt';
                                                    @endphp
                                                    <i class="fas fa-{{ $icon }}"></i>
                                                </div>
                                                <div class="attachment-info">
                                                    <div class="attachment-name">{{ $attachment['original_name'] }}</div>
                                                    <div class="attachment-size">
                                                        {{ number_format($attachment['size'] / 1024, 1) }} KB
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($ticket->status == 'resolved' && $ticket->resolution)
                                <div class="resolution-section">
                                    <h4 style="margin-bottom: 16px; font-size: 16px; color: var(--success-color);">
                                        <i class="fas fa-check-circle"></i> Suluhisho
                                    </h4>
                                    <div class="resolution-text">{{ $ticket->resolution }}</div>
                                    <div style="margin-top: 12px; font-size: 12px; color: var(--text-muted);">
                                        <i class="fas fa-clock"></i> 
                                        Limetatuliwa {{ $ticket->resolved_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div>
                        <!-- Ticket Info -->
                        <div class="sidebar-card">
                            <div class="card-header">
                                <h3>
                                    <i class="fas fa-info-circle"></i>
                                    Taarifa za Ombi
                                </h3>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Nambari ya Ombi</div>
                                <div class="info-value">{{ $ticket->ticket_number }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tarehe ya Kuomba</div>
                                <div class="info-value">{{ $ticket->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                            @if($ticket->resolved_at)
                                <div class="info-item">
                                    <div class="info-label">Tarehe ya Kutatulishwa</div>
                                    <div class="info-value">{{ $ticket->resolved_at->format('d/m/Y H:i') }}</div>
                                </div>
                            @endif
                            @if($ticket->closed_at)
                                <div class="info-item">
                                    <div class="info-label">Tarehe ya Kufungwa</div>
                                    <div class="info-value">{{ $ticket->closed_at->format('d/m/Y H:i') }}</div>
                                </div>
                            @endif
                        </div>

                        <!-- Assigned Admin Info -->
                        @if($ticket->assignedAdmin)
                            <div class="sidebar-card">
                                <div class="card-header">
                                    <h3>
                                        <i class="fas fa-user-tie"></i>
                                        Msimamizi Aliyepewa
                                    </h3>
                                </div>
                                <div class="info-item">
                                    <div class="admin-info">
                                        <div class="admin-avatar">
                                            {{ strtoupper(substr($ticket->assignedAdmin->name, 0, 2)) }}
                                        </div>
                                        <div class="admin-details">
                                            <div class="admin-name">{{ $ticket->assignedAdmin->name }}</div>
                                            <div class="admin-role">Msimamizi</div>
                                        </div>
                                    </div>
                                </div>
                                @if($ticket->assignedAdmin->email)
                                    <div class="info-item">
                                        <div class="info-label">Barua pepe</div>
                                        <div class="info-value">{{ $ticket->assignedAdmin->email }}</div>
                                    </div>
                                @endif
                                @if($ticket->assignedAdmin->phone)
                                    <div class="info-item">
                                        <div class="info-label">Simu</div>
                                        <div class="info-value">{{ $ticket->assignedAdmin->phone }}</div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="sidebar-card">
                                <div class="card-header">
                                    <h3>
                                        <i class="fas fa-hourglass-half"></i>
                                        Hali ya Ombi
                                    </h3>
                                </div>
                                <div class="info-item">
                                    <div class="info-value" style="color: var(--warning-color); font-style: italic;">
                                        <i class="fas fa-clock"></i> 
                                        Ombi bado halijapewa msimamizi
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Quick Actions -->
                        <div class="sidebar-card">
                            <div class="card-header">
                                <h3>
                                    <i class="fas fa-bolt"></i>
                                    Vitendo vya Haraka
                                </h3>
                            </div>
                            <div class="info-item">
                                <a href="{{ route('mwenyekiti.support.index') }}" class="btn btn-secondary btn-sm" style="width: 100%;">
                                    <i class="fas fa-list"></i> Maombi Yote
                                </a>
                            </div>
                            <div class="info-item">
                                <a href="{{ route('mwenyekiti.support.create') }}" class="btn btn-primary btn-sm" style="width: 100%;">
                                    <i class="fas fa-plus"></i> Ombi Jipya
                                </a>
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