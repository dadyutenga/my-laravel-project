<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management | Prototype System</title>
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

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

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

        .status-badge.active {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-badge.inactive {
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

        .alert {
            border-radius: var(--radius-md);
            padding: 15px;
            margin-bottom: 20px;
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border: 1px solid var(--success-color);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
            border: 1px solid var(--error-color);
        }

        .alert-dismissible .btn-close {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 12px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .btn {
            padding: 8px 16px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-info {
            background-color: var(--info-color);
            color: white;
            border: none;
        }

        .btn-info:hover {
            background-color: #2563eb;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e28743;
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
            border: none;
        }

        .btn-success:hover {
            background-color: #37b025;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
        }

        .modal-content {
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 15px 20px;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 600;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-body dl dt {
            font-weight: 500;
            color: var(--text-muted);
        }

        .modal-body dl dd {
            margin-bottom: 15px;
        }

        .btn-close {
            font-size: 12px;
            color: var(--text-muted);
            opacity: 1;
        }

        .mobile-menu-toggle {
            display: none;
        }

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

            .header {
                padding: 0 15px;
            }

            .dashboard-content {
                padding: 20px 15px;
            }

            .user-info {
                display: none;
            }

            .mobile-menu-toggle {
                display: flex;
                margin-right: 15px;
            }
        }

        @media (max-width: 576px) {
            .header-action:not(.mobile-menu-toggle) {
                display: none;
            }

            .data-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none;
            }
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin-left: 10px;
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

        /* Form Layout Improvements */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;  /* Negative margin to offset padding */
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 10px;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-color);
        }

        /* Form Control Styling */
        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--text-color);
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            color: var(--text-color);
            background-color: #ffffff;
            border-color: var(--primary-color);
            outline: 0;
            box-shadow: 0 0 0 0.2rem var(--primary-light);
        }

        /* Select Input Styling */
        select.form-control {
            padding-right: 2.5rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            appearance: none;
        }

        /* File Input Styling */
        input[type="file"].form-control {
            padding: 0.375rem 0.75rem;
        }

        input[type="file"].form-control::file-selector-button {
            padding: 0.375rem 0.75rem;
            margin: -0.375rem -0.75rem;
            margin-right: 0.75rem;
            color: var(--text-color);
            background-color: var(--secondary-color);
            border: 0 solid;
            border-right: 1px solid var(--border-color);
            border-radius: 0;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
        }

        /* Invalid State Styling */
        .form-control.is-invalid {
            border-color: var(--error-color);
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: var(--error-color);
        }

        /* Form Sections */
        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .form-section-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        /* Button Group Styling */
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Superadmin.shared.sidebar-menu')

        <div class="main-content">
            <header class="header">
                <div class="header-left">
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="page-title">Create New Admin</h1>
                </div>
                <div class="header-right">
                    <a href="{{ route('superadmin.admins.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </header>

            <div class="dashboard-content">
                <div class="breadcrumb mb-4">
                    <div class="breadcrumb-item">
                        <a href="/superadmin/dashboard" class="breadcrumb-link">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ route('superadmin.admins.index') }}" class="breadcrumb-link">Admin Management</a>
                    </div>
                    <div class="breadcrumb-item">
                        <span class="breadcrumb-current">Create New Admin</span>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">Create New Admin</h3>
                    </div>
                    <form action="{{ route('superadmin.admins.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <h4 class="form-section-title">Basic Information</h4>
                            <div class="row">
                                <!-- Basic Information fields -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="form-section">
                            <h4 class="form-section-title">Contact Information</h4>
                            <div class="row">
                                <!-- Contact Information fields -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information Section -->
                        <div class="form-section">
                            <h4 class="form-section-title">Address Information</h4>
                            <div class="row">
                                <!-- Address Information fields -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}">
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="region" class="form-label">Region</label>
                                        <input type="text" name="region" id="region" class="form-control @error('region') is-invalid @enderror" value="{{ old('region') }}">
                                        @error('region')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postal_code" class="form-label">Postal Code</label>
                                        <input type="text" name="postal_code" id="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}">
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Picture Section -->
                        <div class="form-section">
                            <h4 class="form-section-title">Profile Picture</h4>
                            <div class="row">
                                <!-- Profile Picture field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="picture" class="form-label">Profile Picture</label>
                                        <input type="file" name="picture" id="picture" class="form-control @error('picture') is-invalid @enderror" accept="image/*">
                                        @error('picture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Admin
                            </button>
                            <a href="{{ route('superadmin.admins.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <div class="modal fade" id="adminDetailsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Admin Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showAdminDetails(adminId) {
            $.get(`/superadmin/admins/${adminId}`, function(data) {
                let modalBody = $('.modal-body');
                modalBody.html(`
                    <div class="text-center mb-3">
                        ${data.details.picture 
                            ? `<img src="/storage/${data.details.picture}" class="profile-img" style="width: 100px; height: 100px;">` 
                            : '<div class="profile-placeholder mx-auto" style="width: 100px; height: 100px;"><i class="fas fa-user fa-3x"></i></div>'}
                    </div>
                    <dl class="row">
                        <dt class="col-sm-4">Name</dt>
                        <dd class="col-sm-8">${data.name}</dd>
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">${data.email}</dd>
                        <dt class="col-sm-4">Phone</dt>
                        <dd class="col-sm-8">${data.details.phone_number}</dd>
                        <dt class="col-sm-4">Address</dt>
                        <dd class="col-sm-8">${data.details.address}</dd>
                        <dt class="col-sm-4">Date of Birth</dt>
                        <dd class="col-sm-8">${data.details.date_of_birth}</dd>
                        <dt class="col-sm-4">Gender</dt>
                        <dd class="col-sm-8">${data.details.gender}</dd>
                        <dt class="col-sm-4">Country</dt>
                        <dd class="col-sm-8">${data.details.country}</dd>
                        <dt class="col-sm-4">Region</dt>
                        <dd class="col-sm-8">${data.details.region}</dd>
                        <dt class="col-sm-4">Postal Code</dt>
                        <dd class="col-sm-8">${data.details.postal_code}</dd>
                    </dl>
                `);
                $('#adminDetailsModal').modal('show');
            });
        }

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this admin account?')) {
                    e.preventDefault();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
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