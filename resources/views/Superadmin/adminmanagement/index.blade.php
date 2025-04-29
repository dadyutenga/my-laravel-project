<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Admin Management</h1>
            <a href="{{ route('superadmin.admins.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Admin
            </a>
        </div>

        <!-- Flash Messages -->
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

        <!-- Admins Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td>
                                        @if($admin->details && $admin->details->picture)
                                            <img src="{{ Storage::url($admin->details->picture) }}" 
                                                 alt="Profile Picture" 
                                                 class="rounded-circle"
                                                 width="40" height="40">
                                        @else
                                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->details->phone_number ?? 'N/A' }}</td>
                                    <td>{{ $admin->details->country ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $admin->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $admin->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" 
                                                    class="btn btn-sm btn-info text-white" 
                                                    onclick="showAdminDetails({{ $admin->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('superadmin.admins.edit', $admin) }}" 
                                               class="btn btn-sm btn-warning text-white">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('superadmin.admins.toggle-status', $admin) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-sm {{ $admin->is_active ? 'btn-danger' : 'btn-success' }}">
                                                    <i class="fas {{ $admin->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('superadmin.admins.destroy', $admin) }}" 
                                                  method="POST" 
                                                  class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No admin accounts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Details Modal -->
    <div class="modal fade" id="adminDetailsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Admin Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Show admin details in modal
        function showAdminDetails(adminId) {
            $.get(`/superadmin/admins/${adminId}`, function(data) {
                let modalBody = $('.modal-body');
                modalBody.html(`
                    <div class="text-center mb-3">
                        ${data.details.picture 
                            ? `<img src="/storage/${data.details.picture}" class="rounded-circle" width="100" height="100">` 
                            : '<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px;"><i class="fas fa-user fa-3x"></i></div>'}
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

        // Confirm delete
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this admin account?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>