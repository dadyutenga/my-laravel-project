<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Balozi Account | InUse System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Using the same CSS from create.blade.php -->
    <style>
        /* Copy the entire CSS from create.blade.php */
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
                    <h1 class="page-title">Create Balozi Account</h1>
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Home</a>
                        </div>
                        <div class="breadcrumb-item">
                            <a href="{{ route('admin.balozi.account.index') }}" class="breadcrumb-link">Account Requests</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Create Account</span>
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

                <div class="form-container">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Balozi Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="form-control" readonly>
                                        {{ $accountRequest->balozi->first_name }} 
                                        {{ $accountRequest->balozi->middle_name }} 
                                        {{ $accountRequest->balozi->last_name }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="form-control" readonly>{{ $accountRequest->balozi->email }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <div class="form-control" readonly>{{ $accountRequest->balozi->phone }}</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Request Status</label>
                                    <div class="badge {{ $accountRequest->status === 'pending' ? 'badge-warning' : ($accountRequest->status === 'approved' ? 'badge-success' : 'badge-danger') }}">
                                        {{ ucfirst($accountRequest->status) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Requested At</label>
                                    <div class="form-control" readonly>{{ $accountRequest->requested_at->format('M d, Y H:i') }}</div>
                                </div>
                                @if($accountRequest->processed_at)
                                <div class="form-group">
                                    <label>Processed At</label>
                                    <div class="form-control" readonly>{{ $accountRequest->processed_at->format('M d, Y H:i') }}</div>
                                </div>
                                @endif
                            </div>
                            @if($accountRequest->admin_comments)
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Admin Comments</label>
                                    <div class="form-control" readonly style="min-height: 60px;">{{ $accountRequest->admin_comments }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($accountRequest->status === 'pending')
                    <form action="{{ route('admin.balozi.account.store', $accountRequest->id) }}" method="POST">
                        @csrf
                        <div class="card" style="margin-top: 20px;">
                            <div class="card-header">
                                <h3 class="card-title">Create Account</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" 
                                               name="username" 
                                               id="username" 
                                               class="form-control @error('username') is-invalid @enderror" 
                                               value="{{ old('username') }}" 
                                               required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" 
                                               name="password" 
                                               id="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="admin_comments">Comments</label>
                                        <textarea name="admin_comments" 
                                                  id="admin_comments" 
                                                  class="form-control @error('admin_comments') is-invalid @enderror"
                                                  rows="3">{{ old('admin_comments') }}</textarea>
                                        @error('admin_comments')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i> Create Account
                                    </button>
                                    <a href="{{ route('admin.balozi.account.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="form-group" style="margin-top: 20px;">
                        <a href="{{ route('admin.balozi.account.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
