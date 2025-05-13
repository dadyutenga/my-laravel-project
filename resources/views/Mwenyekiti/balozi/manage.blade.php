<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Balozi | InUse System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #10b981;
            --primary-hover: #059669;
            --primary-light: rgba(16, 185, 129, 0.1);
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --error-color: #ef4444;
            --success-color: #10b981;
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
            background: linear-gradient(135deg, var(--primary-color), #34d399);
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

        .dashboard-content {
            padding: 30px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .card {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background-color: var(--secondary-color);
            font-weight: 600;
            font-size: 14px;
            color: var(--text-muted);
        }

        .table td {
            font-size: 14px;
        }

        .table tr:hover {
            background-color: var(--primary-light);
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

        .btn-sm {
            padding: 6px 10px;
            font-size: 12px;
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
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .photo-preview {
            margin-top: 10px;
            max-width: 100px;
            max-height: 100px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            object-fit: cover;
            display: none;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--text-color);
            transition: var(--transition);
        }

        .pagination a:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-color);
        }

        .pagination .active a {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .user-info .user-name {
            font-weight: 500;
        }

        .user-info .user-email {
            font-size: 12px;
            color: var(--text-muted);
        }

        .action-buttons {
            display: flex;
            gap: 5px;
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

            .breadcrumb {
                display: none;
            }

            .dashboard-content {
                padding: 20px 15px;
            }

            .user-info {
                display: none;
            }

            .table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .mobile-menu-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                margin-right: 15px;
            }
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

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <header class="header">
                <div class="header-left">
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="page-title">Manage Balozi</h1>
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('mwenyekiti.dashboard') }}" class="breadcrumb-link">Home</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Balozi</span>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-action">
                        <i class="fas fa-bell"></i>
                        <div class="notification-badge"></div>
                    </div>
                    <div class="user-profile">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth('mwenyekiti')->user()->first_name ?? 'M', 0, 2)) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ auth('mwenyekiti')->user()->first_name ?? 'Mwenyekiti' }}</div>
                            <div class="user-role">Mwenyekiti</div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="dashboard-content">
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

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Manage Balozi</h2>
                        <a href="{{ route('mwenyekiti.balozi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Balozi
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="tabs">
                            <a href="{{ route('mwenyekiti.balozi.index') }}" class="btn btn-secondary {{ !request('edit_id') ? 'btn-primary' : '' }}">List View</a>
                            @if(request('edit_id'))
                                <span class="btn btn-primary">Edit Balozi</span>
                            @endif
                        </div>

                        @if(request('edit_id') && $editBalozi = $balozi->firstWhere('id', request('edit_id')))
                            <div class="form-container">
                                <form action="{{ route('mwenyekiti.balozi.update', $editBalozi->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Balozi Information</h3>
                                            <p>Update the information for {{ $editBalozi->first_name }} {{ $editBalozi->last_name }}</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $editBalozi->first_name) }}" required>
                                                    @error('first_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="middle_name">Middle Name</label>
                                                    <input type="text" name="middle_name" id="middle_name" class="form-control @error('middle_name') is-invalid @enderror" value="{{ old('middle_name', $editBalozi->middle_name) }}">
                                                    @error('middle_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $editBalozi->last_name) }}" required>
                                                    @error('last_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $editBalozi->email) }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $editBalozi->phone) }}" required>
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="street_village">Street/Village</label>
                                                    <input type="text" name="street_village" id="street_village" class="form-control @error('street_village') is-invalid @enderror" value="{{ old('street_village', $editBalozi->street_village) }}" required>
                                                    @error('street_village')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="shina">Shina</label>
                                                    <input type="text" name="shina" id="shina" class="form-control @error('shina') is-invalid @enderror" value="{{ old('shina', $editBalozi->shina) }}" required>
                                                    @error('shina')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="shina_number">Shina Number</label>
                                                    <input type="text" name="shina_number" id="shina_number" class="form-control @error('shina_number') is-invalid @enderror" value="{{ old('shina_number', $editBalozi->shina_number) }}" required>
                                                    @error('shina_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="photo">Update Photo</label>
                                                    <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                                    @error('photo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <img id="photo-preview" class="photo-preview" alt="Photo Preview">
                                                </div>
                                                <div class="form-group">
                                                    <label for="is_active">Status</label>
                                                    <select name="is_active" id="is_active" class="form-control">
                                                        <option value="1" {{ old('is_active', $editBalozi->is_active) ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ old('is_active', $editBalozi->is_active) ? '' : 'selected' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-top: 20px;">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                                                <a href="{{ route('mwenyekiti.balozi.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Balozi</th>
                                        <th>Contact</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($balozi as $b)
                                        <tr>
                                            <td>
                                                <div class="user-info">
                                                    <div class="user-name">{{ $b->first_name }} {{ $b->middle_name }} {{ $b->last_name }}</div>
                                                    <div class="user-email">{{ $b->email }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $b->phone }}</td>
                                            <td>
                                                {{ $b->street_village }}<br>
                                                Shina: {{ $b->shina }} ({{ $b->shina_number }})
                                            </td>
                                            <td>
                                                <span class="badge {{ $b->is_active ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $b->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $b->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('mwenyekiti.balozi.show', $b->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('mwenyekiti.balozi.index', ['edit_id' => $b->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('mwenyekiti.balozi.destroy', $b->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this Balozi?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $balozi->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const photoInput = document.getElementById('photo');
            const photoPreview = document.getElementById('photo-preview');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.remove('active');
            });

            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.toggle('active');
            });

            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            });

            if (photoInput && photoPreview) {
                photoInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            photoPreview.src = e.target.result;
                            photoPreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        photoPreview.src = '';
                        photoPreview.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>