<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Mwenyekiti | Prototype System</title>
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

        /* Sidebar */
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

        /* Header */
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
            font-weight: 600;
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
            font-weight: 600;
            margin-bottom: 20px;
        }

        .dashboard-card {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
        }

        .card-actions {
            display: flex;
            gap: 10px;
        }

        .card-action {
            padding: 6px 10px;
            background-color: var(--secondary-color);
            border-radius: var(--radius-md);
            font-size: 13px;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .card-action:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .card-action.active {
            background-color: var(--primary-color);
            color: white;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table th {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            background-color: var(--secondary-color);
        }

        .data-table th:first-child {
            border-top-left-radius: var(--radius-md);
        }

        .data-table th:last-child {
            border-top-right-radius: var(--radius-md);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table td {
            font-size: 14px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge.completed {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-badge.in-progress {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .status-badge.pending {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .status-badge.cancelled {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .table-action {
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
        }

        .table-action:hover {
            color: var(--primary-color);
        }

        .form-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
        }

        .invalid-feedback {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 5px;
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
            background-color: var(--border-color);
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .alert {
            padding: 15px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            font-size: 14px;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .tab:hover {
            color: var(--primary-color);
        }

        .tab.active {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 400;
        }

        /* Responsive */
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

            .breadcrumb {
                display: none;
            }

            .dashboard-content {
                padding: 20px 15px;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
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
        @include('Admin.shared.sidebar-menu')
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="page-title">Manage Mwenyekiti</h1>
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Home</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Mwenyekiti</span>
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
                            {{ substr($admin->name ?? 'Admin', 0, 2) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ $admin->name ?? 'Admin' }}</div>
                            <div class="user-role">{{ ucfirst($admin->role ?? 'Admin') }}</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <h2 class="dashboard-title">Mwenyekiti Management</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-times"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Mwenyekiti List</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.mwenyekiti.create') }}" class="card-action"><i class="fas fa-plus"></i> Add New</a>
                        </div>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Ward/Mtaa</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mwenyekiti as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->ward }} / {{ $item->mtaa }}</td>
                                    <td>
                                        <span class="status-badge {{ $item->is_active ? 'completed' : 'cancelled' }}">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.mwenyekiti.manage', ['mode' => 'view', 'id' => $item->id]) }}" class="table-action"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.mwenyekiti.manage', ['mode' => 'edit', 'id' => $item->id]) }}" class="table-action"><i class="fas fa-edit"></i></a>
                                        @if ($item->auth)
                                            <a href="{{ route('admin.mwenyekiti.createAccount', ['id' => $item->id]) }}" class="table-action"><i class="fas fa-key"></i></a>
                                        @else
                                            <a href="{{ route('admin.mwenyekiti.createAccount', ['id' => $item->id]) }}" class="table-action"><i class="fas fa-user-plus"></i></a>
                                        @endif
                                        <form action="{{ route('admin.mwenyekiti.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this Mwenyekiti?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="table-action" style="background: none; border: none; padding: 0; cursor: pointer;"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($mwenyekiti->isEmpty())
                                <tr>
                                    <td colspan="7" style="text-align: center; color: var(--text-muted);">No Mwenyekiti found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if ($mode == 'view' && $selectedMwenyekiti)
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">Mwenyekiti Details - {{ $selectedMwenyekiti->first_name }} {{ $selectedMwenyekiti->last_name }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.mwenyekiti.manage') }}" class="card-action"><i class="fas fa-arrow-left"></i> Back to List</a>
                                <a href="{{ route('admin.mwenyekiti.manage', ['mode' => 'edit', 'id' => $selectedMwenyekiti->id]) }}" class="card-action"><i class="fas fa-edit"></i> Edit</a>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="detail-item">
                                <span class="detail-label">First Name:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->first_name }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Middle Name:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->middle_name ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Last Name:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->last_name }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="detail-item">
                                <span class="detail-label">Email:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->email }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Phone:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->phone }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="detail-item">
                                <span class="detail-label">Date of Birth:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->date_of_birth->format('Y-m-d') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Gender:</span>
                                <span class="detail-value">{{ ucfirst($selectedMwenyekiti->gender) }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="detail-item">
                                <span class="detail-label">National ID:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->national_id }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Ward:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->ward }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Mtaa:</span>
                                <span class="detail-value">{{ $selectedMwenyekiti->mtaa }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="detail-item">
                                <span class="detail-label">Status:</span>
                                <span class="detail-value">
                                    <span class="status-badge {{ $selectedMwenyekiti->is_active ? 'completed' : 'cancelled' }}">
                                        {{ $selectedMwenyekiti->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Account:</span>
                                <span class="detail-value">
                                    @if ($selectedMwenyekiti->auth)
                                        <span class="status-badge completed">Account Created</span>
                                    @else
                                        <span class="status-badge cancelled">No Account</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        @if ($selectedMwenyekiti->photo)
                            <div class="form-row">
                                <div class="detail-item">
                                    <span class="detail-label">Photo:</span>
                                    <span class="detail-value">
                                        <img src="{{ asset('storage/' . $selectedMwenyekiti->photo) }}" alt="Photo" style="width: 100px; height: 100px; object-fit: cover; border-radius: var(--radius-md);">
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if ($mode == 'edit' && $selectedMwenyekiti)
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Mwenyekiti - {{ $selectedMwenyekiti->first_name }} {{ $selectedMwenyekiti->last_name }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.mwenyekiti.manage') }}" class="card-action"><i class="fas fa-arrow-left"></i> Back to List</a>
                                <a href="{{ route('admin.mwenyekiti.manage', ['mode' => 'view', 'id' => $selectedMwenyekiti->id]) }}" class="card-action"><i class="fas fa-eye"></i> View Details</a>
                            </div>
                        </div>
                        <form action="{{ route('admin.mwenyekiti.update', $selectedMwenyekiti->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $selectedMwenyekiti->first_name) }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" name="middle_name" id="middle_name" class="form-control @error('middle_name') is-invalid @enderror" value="{{ old('middle_name', $selectedMwenyekiti->middle_name) }}">
                                    @error('middle_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $selectedMwenyekiti->last_name) }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $selectedMwenyekiti->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $selectedMwenyekiti->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $selectedMwenyekiti->date_of_birth->format('Y-m-d')) }}" required>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $selectedMwenyekiti->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $selectedMwenyekiti->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $selectedMwenyekiti->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="national_id">National ID</label>
                                    <input type="text" name="national_id" id="national_id" class="form-control @error('national_id') is-invalid @enderror" value="{{ old('national_id', $selectedMwenyekiti->national_id) }}" required>
                                    @error('national_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ward">Ward</label>
                                    <input type="text" name="ward" id="ward" class="form-control @error('ward') is-invalid @enderror" value="{{ old('ward', $selectedMwenyekiti->ward) }}" required>
                                    @error('ward')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mtaa">Mtaa</label>
                                    <input type="text" name="mtaa" id="mtaa" class="form-control @error('mtaa') is-invalid @enderror" value="{{ old('mtaa', $selectedMwenyekiti->mtaa) }}" required>
                                    @error('mtaa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="photo">Photo (Leave blank to keep current)</label>
                                    <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($selectedMwenyekiti->photo)
                                        <div style="margin-top: 10px;">
                                            <img src="{{ asset('storage/' . $selectedMwenyekiti->photo) }}" alt="Current Photo" style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-md);">
                                            <span style="font-size: 12px; color: var(--text-muted);">Current Photo</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Active Status</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', $selectedMwenyekiti->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $selectedMwenyekiti->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Mwenyekiti</button>
                                <a href="{{ route('admin.mwenyekiti.manage') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
            
            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.toggle('active');
            });
            
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            });
        });
    </script>
</body>
</html>
