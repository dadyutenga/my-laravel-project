<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiketi #{{ $ticket->ticket_number }} | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #3dd73a;
            --primary-light: rgba(78, 229, 70, 0.1);
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --error-color: #ef4444;
            --success-color: #37b025;
            --warning-color: #f59e0b;
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
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--text-color);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
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
            font-size: 16px;
            text-align: center;
        }

        .menu-text {
            white-space: nowrap;
            overflow: hidden;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
            width: 0;
        }

        .menu-badge {
            margin-left: auto;
            background-color: var(--primary-color);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-badge {
            opacity: 0;
            width: 0;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .header {
            height: var(--header-height);
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin: 0 8px;
            color: var(--text-muted);
        }

        .breadcrumb-link {
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-link:hover {
            color: var(--primary-color);
        }

        .breadcrumb-current {
            color: var(--text-color);
            font-weight: 500;
        }

        .dashboard-content {
            padding: 30px;
        }

        .ticket-container {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .ticket-header {
            padding: 30px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
        }

        .ticket-number {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .ticket-subject {
            font-size: 20px;
            font-weight: 500;
            opacity: 0.9;
        }

        .ticket-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 30px;
            background: var(--secondary-color);
            border-bottom: 1px solid var(--border-color);
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .meta-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-open { background: #fef3c7; color: #92400e; }
        .status-in_progress { background: #dbeafe; color: #1e40af; }
        .status-resolved { background: #dcfce7; color: #166534; }
        .status-closed { background: #f3f4f6; color: #374151; }

        .priority-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .ticket-content {
            padding: 30px;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ticket-description {
            background: var(--secondary-color);
            padding: 20px;
            border-radius: var(--radius-md);
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .attachments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .attachment-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: var(--secondary-color);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--text-color);
            transition: var(--transition);
        }

        .attachment-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        .attachment-icon {
            font-size: 24px;
            color: var(--primary-color);
        }

        .attachment-info {
            flex: 1;
        }

        .attachment-name {
            font-weight: 500;
            margin-bottom: 2px;
        }

        .attachment-size {
            font-size: 12px;
            color: var(--text-muted);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: #f3f4f6;
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            padding: 30px;
            border-top: 1px solid var(--border-color);
            background: var(--secondary-color);
        }

        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Mobile menu */
        .mobile-menu-toggle {
            display: none;
        }

        /* Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
                transform: translateX(calc(var(--sidebar-collapsed-width) * -1));
            }

            .sidebar.collapsed {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.collapsed ~ .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                right: -30px;
                transform: rotate(180deg);
            }

            .sidebar.collapsed .sidebar-toggle {
                transform: rotate(0);
            }

            .mobile-menu-toggle {
                display: flex;
                margin-right: 15px;
            }

            .dashboard-content {
                padding: 20px;
            }

            .ticket-meta {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .attachments-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Balozi.shared.sidebar-menu')
        
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="page-title">Tiketi za Msaada</h1>
                    <nav class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('balozi.tickets.index') }}" class="breadcrumb-link">Tiketi</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">#{{ $ticket->ticket_number }}</span>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="dashboard-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="ticket-container">
                    <div class="ticket-header">
                        <div class="ticket-number">#{{ $ticket->ticket_number }}</div>
                        <div class="ticket-subject">{{ $ticket->subject }}</div>
                    </div>

                    <div class="ticket-meta">
                        <div class="meta-item">
                            <div class="meta-label">Hali</div>
                            <div class="meta-value">
                                <span class="status-badge status-{{ $ticket->status }}">
                                    @if($ticket->status === 'open')
                                        🟡 Wazi
                                    @elseif($ticket->status === 'in_progress')
                                        🔵 Inashughulikiwa
                                    @elseif($ticket->status === 'resolved')
                                        🟢 Imetatuliwa
                                    @else
                                        ⚫ Imefungwa
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Kipaumbele</div>
                            <div class="meta-value">
                                <span class="priority-badge">
                                    @if($ticket->priority === 'low')
                                        🟢 Chini
                                    @elseif($ticket->priority === 'medium')
                                        🟡 Wastani
                                    @elseif($ticket->priority === 'high')
                                        🟠 Juu
                                    @else
                                        🔴 Dharura
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Tarehe ya Kutengeneza</div>
                            <div class="meta-value">{{ $ticket->created_at->format('d/m/Y H:i') }}</div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Tarehe ya Mwisho Kusasishwa</div>
                            <div class="meta-value">{{ $ticket->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>

                    <div class="ticket-content">
                        <div class="content-section">
                            <h3 class="section-title">
                                <i class="fas fa-file-text"></i>
                                Maelezo ya Tatizo
                            </h3>
                            <div class="ticket-description">{{ $ticket->description }}</div>
                        </div>

                        @if($ticket->attachments && count(json_decode($ticket->attachments, true)) > 0)
                            <div class="content-section">
                                <h3 class="section-title">
                                    <i class="fas fa-paperclip"></i>
                                    Faili Zilizounganishwa
                                </h3>
                                <div class="attachments-grid">
                                    @foreach(json_decode($ticket->attachments, true) as $index => $attachment)
                                        <a href="{{ route('balozi.tickets.download-attachment', [$ticket->id, $index]) }}" 
                                           class="attachment-item">
                                            <div class="attachment-icon">
                                                <i class="fas fa-file"></i>
                                            </div>
                                            <div class="attachment-info">
                                                <div class="attachment-name">{{ $attachment['original_name'] }}</div>
                                                <div class="attachment-size">{{ number_format($attachment['size'] / 1024, 1) }} KB</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($ticket->admin_response)
                            <div class="content-section">
                                <h3 class="section-title">
                                    <i class="fas fa-reply"></i>
                                    Jibu la Msimamizi
                                </h3>
                                <div class="ticket-description">{{ $ticket->admin_response }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="action-buttons">
                        @if($ticket->status !== 'closed')
                            <a href="{{ route('balozi.tickets.edit', $ticket->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                                Badili Tiketi
                            </a>
                        @endif
                        
                        <a href="{{ route('balozi.tickets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Rudi Nyuma
                        </a>
                        
                        @if($ticket->status !== 'closed')
                            <form action="{{ route('balozi.tickets.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Una uhakika unataka kufuta tiketi hii?')">
                                    <i class="fas fa-trash"></i>
                                    Futa Tiketi
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>

    <script>
        // Mobile menu toggle functionality
        document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        });

        // Sidebar toggle functionality
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

        // Close sidebar when clicking on overlay
        document.querySelector('.sidebar-overlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('collapsed');
            this.classList.remove('active');
        });
    </script>
</body>
</html>