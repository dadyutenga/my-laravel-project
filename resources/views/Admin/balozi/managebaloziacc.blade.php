<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Balozi Account Requests | InUse System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Using the same CSS from create.blade.php -->
    <style>
        /* Copy the entire CSS from create.blade.php */
        
        .badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-success {
            background-color: #d1fae5;
            color: var(--success-color);
        }

        .badge-danger {
            background-color: #fee2e2;
            color: var(--error-color);
        }

        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Admin.shared.sidebar-menu')
        <div class="main-content">
            <header class="header">
                <div class="header-left">
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="page-title">Manage Balozi Account Requests</h1>
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Home</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Account Requests</span>
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
                            {{ substr($admin->name ?? 'Admin', 0, 2) }}
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

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Balozi Account Requests</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Balozi Name</th>
                                    <th>Requested By</th>
                                    <th>Status</th>
                                    <th>Requested At</th>
                                    <th>Processed At</th>
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
                                        <td>{{ $request->mwenyekiti->first_name }} {{ $request->mwenyekiti->last_name }}</td>
                                        <td>
                                            <span class="badge {{ $request->status === 'pending' ? 'badge-warning' : ($request->status === 'approved' ? 'badge-success' : 'badge-danger') }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $request->requested_at->format('M d, Y H:i') }}</td>
                                        <td>{{ $request->processed_at ? $request->processed_at->format('M d, Y H:i') : 'Not processed' }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                @if($request->status === 'pending')
                                                    <a href="{{ route('admin.balozi.account.create', $request->id) }}" 
                                                       class="btn btn-primary btn-sm" 
                                                       title="Create Account">
                                                        <i class="fas fa-user-plus"></i>
                                                    </a>
                                                    <form action="{{ route('admin.balozi.account.reject', $request->id) }}" 
                                                          method="POST" 
                                                          style="display: inline;">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm" 
                                                                title="Reject Request"
                                                                onclick="return confirm('Are you sure you want to reject this request?')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('admin.balozi.account.show', $request->id) }}" 
                                                   class="btn btn-secondary btn-sm" 
                                                   title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination">
                            {{ $requests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
