<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Balozi Account | InUse System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3b82f6; /* Blue */
            --primary-hover: #2563eb;
            --primary-light: rgba(59, 130, 246, 0.1);
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --error-color: #ef4444;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --radius-sm: 0.25rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --transition: all 0.3s ease;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 60px;
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
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            height: var(--header-height);
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 18px;
            color: var(--text-color);
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            transition: var(--transition);
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }

        .sidebar-toggle {
            position: absolute;
            top: 18px;
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
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        .sidebar-toggle i {
            font-size: 12px;
            transition: var(--transition);
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
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
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin: 0 8px;
            color: var(--text-muted);
        }

        .breadcrumb-link {
            color: var(--text-muted);
            text-decoration: none;
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
            gap: 15px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px;
            border-radius: var(--radius-md);
        }

        .user-profile:hover {
            background-color: var(--secondary-color);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
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
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: var(--radius-md);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .card-header {
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
        }

        .info-group {
            margin-bottom: 15px;
        }

        .info-group label {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            display: block;
            margin-bottom: 5px;
        }

        .info-group p {
            font-size: 14px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
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

        .textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            resize: vertical;
            min-height: 80px;
        }

        .textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .btn {
            padding: 8px 12px;
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
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: var(--border-color);
        }

        .alert {
            padding: 12px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: var(--success-color);
        }

        .alert-danger {
            background-color: #fee2e2;
            color: var(--error-color);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
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

        .badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: var(--warning-color);
        }

        .badge-success {
            background-color: #d1fae5;
            color: var(--success-color);
        }

        .badge-danger {
            background-color: #fee2e2;
            color: var(--error-color);
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--text-color);
            font-size: 14px;
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

        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }

            .sidebar.collapsed {
                width: var(--sidebar-width);
            }

            .main-content {
                margin-left: var(--sidebar-collapsed-width);
            }

            .sidebar.collapsed ~ .main-content {
                margin-left: var(--sidebar-width);
            }

            .breadcrumb {
                display: none;
            }

            .user-info {
                display: none;
            }

            .dashboard-content {
                padding: 15px;
            }

            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Admin.shared.sidebar-menu')
        
        <div class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1 class="page-title">Create Balozi Account</h1>
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Home</a>
                        </div>
                        <div class="breadcrumb-item">
                            <a href="{{ route('admin.balozi.account.requests') }}" class="breadcrumb-link">Balozi Account Requests</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Create Account</span>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="user-profile">
                        <div class="user-avatar">
                            {{ strtoupper(substr($admin->name ?? 'Admin', 0, 2)) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ $admin->name ?? 'Admin' }}</div>
                            <div class="user-role">{{ ucfirst($admin->role ?? 'Admin') }}</div>
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

                @if(isset($accountRequest))
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Balozi Information</h2>
                        </div>
                        <div class="card-body">
                            <div class="info-group">
                                <label>Name</label>
                                <p>{{ $accountRequest->balozi->first_name }} {{ $accountRequest->balozi->middle_name }} {{ $accountRequest->balozi->last_name }}</p>
                            </div>
                            <div class="info-group">
                                <label>Email</label>
                                <p>{{ $accountRequest->balozi->email ?? 'N/A' }}</p>
                            </div>
                            <div class="info-group">
                                <label>Phone</label>
                                <p>{{ $accountRequest->balozi->phone }}</p>
                            </div>
                            <div class="info-group">
                                <label>Request Status</label>
                                <p>
                                    <span class="badge {{ $accountRequest->status === 'pending' ? 'badge-warning' : ($accountRequest->status === 'approved' ? 'badge-success' : 'badge-danger') }}">
                                        {{ ucfirst($accountRequest->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="info-group">
                                <label>Requested At</label>
                                <p>{{ $accountRequest->requested_at->format('M d, Y H:i') }}</p>
                            </div>
                            @if($accountRequest->processed_at)
                                <div class="info-group">
                                    <label>Processed At</label>
                                    <p>{{ $accountRequest->processed_at->format('M d, Y H:i') }}</p>
                                </div>
                            @endif
                            @if($accountRequest->admin_comments)
                                <div class="info-group">
                                    <label>Admin Comments</label>
                                    <p>{{ $accountRequest->admin_comments }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($accountRequest->status === 'pending')
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Create Account</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.balozi.account.process-request', $accountRequest->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_comments">Comments</label>
                                        <textarea name="admin_comments" id="admin_comments" class="textarea @error('admin_comments') is-invalid @enderror">{{ old('admin_comments') }}</textarea>
                                        @error('admin_comments')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group action-buttons">
                                        <button type="submit" name="action" value="approve" class="btn btn-primary"><i class="fas fa-save"></i> Create Account</button>
                                        <a href="{{ route('admin.balozi.account.requests') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Requests</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Account Requests</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Balozi Name</th>
                                        <th>Requested By</th>
                                        <th>Status</th>
                                        <th>Requested At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td>
                                                <div class="user-info">
                                                    <div class="user-name">
                                                        {{ $request->balozi->first_name }} 
                                                        {{ $request->balozi->middle_name }} 
                                                        {{ $request->balozi->last_name }}
                                                    </div>
                                                    <div class="user-email">{{ $request->balozi->email }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $request->mwenyekiti->name }}</td>
                                            <td>
                                                <span class="badge {{ $request->status === 'pending' ? 'badge-warning' : ($request->status === 'approved' ? 'badge-success' : 'badge-danger') }}">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $request->requested_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                @if($request->status === 'pending')
                                                    <a href="{{ route('admin.balozi.account.show-request', $request->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(isset($requests))
                                <div class="pagination">
                                    {{ $requests->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            if (sidebar && sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                });
            }
        });
    </script>
</body>
</html>