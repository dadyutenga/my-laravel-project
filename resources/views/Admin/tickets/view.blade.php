
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket #{{ $ticket->ticket_number }} | Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #4ee546;
            --primary-light: rgba(79, 70, 229, 0.1);
            --secondary-color: #f8fafc;
            --text-color: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid var(--border-color);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid var(--border-color);
            background: white;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-color);
            font-weight: 700;
            font-size: 18px;
        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            border-radius: 8px;
            font-size: 16px;
        }

        .logo-text {
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
        }

        .sidebar-toggle {
            position: absolute;
            top: 20px;
            right: -12px;
            width: 24px;
            height: 24px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            border: 2px solid white;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 101;
        }

        .sidebar-toggle i {
            font-size: 12px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        /* Sidebar Menu Styles */
        .sidebar-menu {
            padding: 20px 0;
            height: calc(100vh - var(--header-height));
            overflow-y: auto;
            overflow-x: hidden;
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .menu-section-title {
            padding: 0 20px 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.5px;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed .menu-section-title {
            opacity: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin: 2px 0;
        }

        .menu-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        .menu-item.active {
            background: var(--primary-light);
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
            background: var(--primary-color);
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            font-size: 16px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-text {
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            flex: 1;
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
        }

        /* Tooltip for collapsed sidebar */
        .sidebar.collapsed .menu-item {
            position: relative;
        }

        .sidebar.collapsed .menu-item:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
            margin-left: 10px;
            pointer-events: none;
        }

        .sidebar.collapsed .menu-item:hover::before {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: rgba(0, 0, 0, 0.8);
            margin-left: 5px;
            z-index: 1000;
            pointer-events: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Content Header - Fixed Structure */
        .content-header {
            background: white;
            padding: 20px 30px;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            max-width: 100%;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
            min-width: 0;
        }

        .header-info {
            flex: 1;
            min-width: 0;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-muted);
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--primary-hover);
        }

        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-shrink: 0;
        }

        /* Content Body - Proper Padding and Structure */
        .content-body {
            padding: 30px;
            flex: 1;
            overflow-x: auto;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }

        .btn-primary { 
            background: var(--primary-color); 
            color: white; 
        }
        
        .btn-primary:hover { 
            background: var(--primary-hover); 
            transform: translateY(-1px);
        }
        
        .btn-secondary { 
            background: white; 
            color: var(--text-color); 
            border: 1px solid var(--border-color); 
        }
        
        .btn-secondary:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-success { 
            background: var(--success-color); 
            color: white; 
        }
        
        .btn-warning { 
            background: var(--warning-color); 
            color: white; 
        }
        
        .btn-danger { 
            background: var(--error-color); 
            color: white; 
        }

        /* Main Grid Layout - Responsive */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
            align-items: start;
        }

        /* Card Components */
        .card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin: 0;
        }

        .card-body {
            padding: 24px;
        }

        /* Ticket Header - Improved */
        .ticket-header {
            padding: 30px 24px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .ticket-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.1;
        }

        .ticket-number {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .ticket-title {
            font-size: 20px;
            font-weight: 500;
            opacity: 0.95;
            position: relative;
            z-index: 1;
            line-height: 1.4;
        }

        /* Meta Grid - Better Spacing */
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .meta-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-color);
        }

        /* Badge Improvements */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            width: fit-content;
            letter-spacing: 0.5px;
        }

        .badge-status-open { background: #fef3c7; color: #92400e; }
        .badge-status-in_progress { background: #dbeafe; color: #1e40af; }
        .badge-status-resolved { background: #d1fae5; color: #065f46; }
        .badge-status-closed { background: #f3f4f6; color: #374151; }

        .badge-priority-low { background: #d1fae5; color: #065f46; }
        .badge-priority-medium { background: #fef3c7; color: #92400e; }
        .badge-priority-high { background: #fed7aa; color: #9a3412; }
        .badge-priority-urgent { background: #fee2e2; color: #991b1b; }

        /* Content Sections */
        .content-section {
            margin-bottom: 32px;
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

        .description {
            background: var(--secondary-color);
            padding: 24px;
            border-radius: var(--radius-md);
            white-space: pre-wrap;
            line-height: 1.7;
            border-left: 4px solid var(--primary-color);
            font-size: 15px;
        }

        /* Creator Info Card */
        .creator-info {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px;
            background: linear-gradient(135deg, var(--secondary-color), #f1f5f9);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
        }

        .creator-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }

        .creator-details {
            flex: 1;
        }

        .creator-name {
            font-weight: 600;
            font-size: 16px;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .creator-meta {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.4;
        }

        /* Attachments */
        .attachments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }

        .attachment-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--text-color);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .attachment-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .attachment-icon {
            font-size: 24px;
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .attachment-details {
            flex: 1;
            min-width: 0;
        }

        .attachment-name {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 2px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .attachment-size {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Admin Response */
        .admin-response {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-left: 4px solid var(--info-color);
            padding: 24px;
            border-radius: var(--radius-md);
            border: 1px solid #bae6fd;
        }

        .response-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            color: var(--info-color);
            font-weight: 600;
        }

        .response-content {
            color: var(--text-color);
            line-height: 1.6;
            font-size: 15px;
        }

        /* Form Improvements */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            line-height: 1.6;
        }

        /* Alert Improvements */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border: 1px solid;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-color: #a7f3d0;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border-color: #fecaca;
        }

        .alert i {
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Sidebar Actions - Right Column */
        .actions-column {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .action-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        /* Custom Scrollbar */
        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 2px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        /* Mobile Responsiveness */
        @media (max-width: 1200px) {
            .main-grid {
                grid-template-columns: 1fr 300px;
                gap: 24px;
            }
        }

        @media (max-width: 992px) {
            .main-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .meta-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .content-body {
                padding: 20px;
            }

            .header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .header-left {
                width: 100%;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .page-title {
                font-size: 24px;
            }

            .ticket-number {
                font-size: 28px;
            }

            .ticket-title {
                font-size: 18px;
            }

            .meta-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .sidebar-toggle {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .content-body {
                padding: 16px;
            }

            .attachments-grid {
                grid-template-columns: 1fr;
            }

            .creator-info {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none !important;
            }

            .mobile-menu-toggle {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Admin.shared.sidebar-menu')
        
        <div class="main-content">
            <!-- Content Header -->
            <div class="content-header">
                <div class="header-content">
                    <div class="header-left">
                        <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="header-info">
                            <h1 class="page-title">Ticket Details</h1>
                            <div class="breadcrumb">
                                <a href="{{ route('admin.tickets.index') }}">Tickets</a>
                                <span>/</span>
                                <span>#{{ $ticket->ticket_number }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Back to Tickets
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content Body -->
            <div class="content-body">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul style="margin: 8px 0 0 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Main Grid Layout -->
                <div class="main-grid">
                    <!-- Main Content Column -->
                    <div class="main-column">
                        <!-- Ticket Info Card -->
                        <div class="card">
                            <div class="ticket-header">
                                <div class="ticket-number">#{{ $ticket->ticket_number }}</div>
                                <div class="ticket-title">{{ $ticket->subject }}</div>
                            </div>

                            <div class="card-body">
                                <!-- Meta Information -->
                                <div class="meta-grid">
                                    <div class="meta-item">
                                        <div class="meta-label">Status</div>
                                        <div class="meta-value">
                                            <span class="badge badge-status-{{ $ticket->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">Priority</div>
                                        <div class="meta-value">
                                            <span class="badge badge-priority-{{ $ticket->priority }}">
                                                {{ ucfirst($ticket->priority) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">Created At</div>
                                        <div class="meta-value">{{ $ticket->created_at->format('M d, Y H:i') }}</div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">Last Updated</div>
                                        <div class="meta-value">{{ $ticket->updated_at->format('M d, Y H:i') }}</div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">User Type</div>
                                        <div class="meta-value">{{ ucfirst($ticket->user_type) }}</div>
                                    </div>

                                    <div class="meta-item">
                                        <div class="meta-label">Assigned To</div>
                                        <div class="meta-value">{{ $ticket->assignedAdmin ? $ticket->assignedAdmin->name : 'Unassigned' }}</div>
                                    </div>
                                </div>

                                <!-- Creator Info -->
                                @if($creator)
                                    <div class="content-section">
                                        <div class="creator-info">
                                            <div class="creator-avatar">
                                                {{ strtoupper(substr($creator->name ?? $creator->jina ?? 'U', 0, 1)) }}
                                            </div>
                                            <div class="creator-details">
                                                <div class="creator-name">{{ $creator->name ?? $creator->jina ?? 'Unknown User' }}</div>
                                                <div class="creator-meta">
                                                    {{ ucfirst($ticket->user_type) }}
                                                    @if(isset($creator->email))
                                                        • {{ $creator->email }}
                                                    @endif
                                                    @if(isset($creator->simu))
                                                        • {{ $creator->simu }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Description -->
                                <div class="content-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-align-left"></i>
                                        Description
                                    </h3>
                                    <div class="description">{{ $ticket->description }}</div>
                                </div>

                                <!-- Attachments -->
                                @if($ticket->attachments && count(json_decode($ticket->attachments, true)) > 0)
                                    <div class="content-section">
                                        <h3 class="section-title">
                                            <i class="fas fa-paperclip"></i>
                                            Attachments
                                        </h3>
                                        <div class="attachments-grid">
                                            @foreach(json_decode($ticket->attachments, true) as $index => $attachment)
                                                <a href="{{ route('admin.tickets.download-attachment', [$ticket->id, $index]) }}" class="attachment-item">
                                                    <div class="attachment-icon">
                                                        <i class="fas fa-file"></i>
                                                    </div>
                                                    <div class="attachment-details">
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

                                <!-- Admin Response -->
                                @if($ticket->admin_response)
                                    <div class="content-section">
                                        <div class="admin-response">
                                            <div class="response-header">
                                                <div>
                                                    <i class="fas fa-reply"></i>
                                                    Admin Response
                                                </div>
                                                <div style="font-size: 12px; font-weight: normal;">
                                                    {{ $ticket->updated_at->format('M d, Y H:i') }}
                                                </div>
                                            </div>
                                            <div class="response-content">{{ $ticket->admin_response }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions Column -->
                    <div class="actions-column">
                        <!-- Assignment Card -->
                        <div class="action-card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user-plus"></i>
                                    Assignment
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.tickets.assign', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Assign to Admin</label>
                                        <select name="assigned_to" class="form-control" required>
                                            <option value="">Select Admin</option>
                                            @foreach($admins as $admin)
                                                <option value="{{ $admin->id }}" {{ $ticket->assigned_to == $admin->id ? 'selected' : '' }}>
                                                    {{ $admin->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                                        <i class="fas fa-user-plus"></i>
                                        Assign Ticket
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Status Update Card -->
                        <div class="action-card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-edit"></i>
                                    Update Status
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.tickets.update-status', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Resolution (if resolving)</label>
                                        <textarea name="admin_response" class="form-control" placeholder="Describe how this ticket was resolved...">{{ $ticket->admin_response }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success" style="width: 100%;">
                                        <i class="fas fa-save"></i>
                                        Update Status
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Admin Response Card -->
                        <div class="action-card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-reply"></i>
                                    Add Response
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.tickets.respond', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Your Response</label>
                                        <textarea name="admin_response" class="form-control" rows="4" placeholder="Write your response to the user..." required>{{ $ticket->admin_response }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                                        <i class="fas fa-reply"></i>
                                        Send Response
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <script>
        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Desktop sidebar toggle
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                });
            }

            // Mobile menu toggle
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-open');
                    sidebarOverlay.classList.toggle('active');
                });
            }

            // Close sidebar when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('active');
                });
            }
        });

        // Auto-resize textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });

        // Confirmation for status changes
        const statusForm = document.querySelector('form[action*="update-status"]');
        if (statusForm) {
            statusForm.addEventListener('submit', function(e) {
                const status = this.querySelector('select[name="status"]').value;
                if (status === 'closed') {
                    if (!confirm('Are you sure you want to close this ticket? This action cannot be undone.')) {
                        e.preventDefault();
                    }
                }
            });
        }
    </script>
</body>
</html>