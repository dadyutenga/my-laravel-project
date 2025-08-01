<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taarifa za Mtu | Prototype System</title>
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
        }

        .menu-text {
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-text {
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

        .dashboard-content {
            padding: 30px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-muted);
        }

        .detail-value {
            color: var(--text-color);
        }

        .btn {
            padding: 10px 15px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
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
        }

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-inactive {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        /* Mobile */
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

            .detail-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .btn-group {
                flex-direction: column;
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
            z-index: 99;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Balozi.shared.sidebar-menu')
        <div class="main-content">
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <h2 class="dashboard-title">Taarifa za Mtu</h2>

                <div class="form-container">
                    <h3 style="margin-bottom: 20px; color: var(--primary-color);">Taarifa Binafsi</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">Jina Kamili:</div>
                        <div class="detail-value">{{ $watu->first_name }} {{ $watu->middle_name }} {{ $watu->last_name }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Barua Pepe:</div>
                        <div class="detail-value">{{ $watu->email ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Namba ya Simu:</div>
                        <div class="detail-value">{{ $watu->phone_number }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Tarehe ya Kuzaliwa:</div>
                        <div class="detail-value">{{ $watu->date_of_birth ? $watu->date_of_birth->format('M d, Y') : 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Jinsia:</div>
                        <div class="detail-value">{{ ucfirst($watu->gender) ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Hali ya Ndoa:</div>
                        <div class="detail-value">{{ $watu->marital_status ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Kazi:</div>
                        <div class="detail-value">{{ $watu->occupation ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Kiwango cha Elimu:</div>
                        <div class="detail-value">{{ $watu->education_level ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Kipato:</div>
                        <div class="detail-value">{{ $watu->income_range ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Hali ya Afya:</div>
                        <div class="detail-value">{{ $watu->health_status ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Namba ya NIDA:</div>
                        <div class="detail-value">{{ $watu->nida_number ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Namba ya Nyumba:</div>
                        <div class="detail-value">{{ $watu->house_no ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Mtaa:</div>
                        <div class="detail-value">{{ $watu->mtaa ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Mkoa:</div>
                        <div class="detail-value">{{ $watu->region ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Wilaya:</div>
                        <div class="detail-value">{{ $watu->district ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Kata:</div>
                        <div class="detail-value">{{ $watu->ward ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Idadi ya Watu Nyumbani:</div>
                        <div class="detail-value">{{ $watu->household_count ?? 'Hakuna' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Hali:</div>
                        <div class="detail-value">
                            <span class="status-badge {{ $watu->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $watu->is_active ? 'Inafanya kazi' : 'Haifanyi kazi' }}
                            </span>
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Imetengenezwa Tarehe:</div>
                        <div class="detail-value">{{ $watu->created_at->format('M d, Y H:i') }}</div>
                    </div>

                    <div class="btn-group">
                        <a href="{{ route('balozi.watu.edit', $watu->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Hariri
                        </a>
                        <a href="{{ route('balozi.watu.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Rudi Kwenye Orodha
                        </a>
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

        // Close sidebar when clicking on overlay
        document.querySelector('.sidebar-overlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('collapsed');
            this.classList.remove('active');
        });
    </script>
</body>
</html>