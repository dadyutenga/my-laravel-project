<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maendeleo ya Kila Siku | Prototype System</title>
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

        /* Sidebar - Complete Implementation (Synced with create.blade.php) */
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

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Header - Complete Implementation */
        .header {
            height: var(--header-height);
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .page-title {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            margin-left: 20px;
            color: var(--text-muted);
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

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-action {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .header-action:hover {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--error-color);
            border: 2px solid white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px;
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .user-profile:hover {
            background-color: var(--secondary-color);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
        }

        .user-role {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-color);
        }

        /* Form Container */
        .form-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        /* Table Container */
        .table-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--primary-light);
            color: var(--primary-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: var(--primary-light);
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: var(--text-muted);
        }

        /* Buttons - Complete Implementation */
        .btn {
            padding: 10px 16px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
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
            background-color: var(--border-color);
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        /* Alerts - Complete Implementation */
        .alert {
            padding: 15px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            border-left: 3px solid transparent;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border-left-color: var(--success-color);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
            border-left-color: var(--error-color);
        }

        .alert i {
            font-size: 16px;
        }

        /* Responsive - Complete Implementation */
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

            .header {
                padding: 0 15px;
            }

            .page-title {
                font-size: 16px;
            }

            .breadcrumb {
                display: none;
            }

            .dashboard-content {
                padding: 20px 15px;
            }

            .user-info {
                display: none;
            }

            .form-container,
            .table-container {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .dashboard-title {
                font-size: 20px;
            }

            .btn-group {
                flex-direction: column;
                width: 100%;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Mobile menu */
        .mobile-menu-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                margin-right: 15px;
            }
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
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    Maendeleo ya Kila Siku
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            Nyumbani
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Maendeleo ya Kila Siku</span>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                        <div class="notification-badge"></div>
                    </div>
                    <div class="user-profile">
                        <div class="user-avatar">
                            {{ substr($balozi->name ?? 'Balozi', 0, 2) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ $balozi->name ?? 'Balozi' }}</div>
                            <div class="user-role">Balozi</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <div class="form-container">
                    Maendeleo ya Kila Siku
                    <div class="btn-group">
                        <a href="{{ route('balozi.daily-progress.create') }}" class="btn btn-primary">
                            Weka Kipya
                        </a>
                    </div>
                </div>

                <div class="table-container">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tarehe</th>
                                <th>Maelezo</th>
                                <th>Maoni</th>
                                <th>Vitendo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dailyProgress as $progress)
                                <tr>
                                    <td>{{ $progress->tarehe->format('Y-m-d') }}</td>
                                    <td>{{ $progress->maelezo }}</td>
                                    <td>{{ $progress->maoni ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('balozi.daily-progress.edit', $progress->id) }}" class="btn btn-secondary">
                                                Badilisha
                                            </a>
                                            <form action="{{ route('balozi.daily-progress.destroy', $progress->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Unahakika unataka kufuta hii?')">
                                                    Futa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Hakuna maendeleo ya kila siku yaliyopatikana
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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