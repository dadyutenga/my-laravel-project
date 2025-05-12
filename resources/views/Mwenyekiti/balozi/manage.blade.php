<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Balozi | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #10b981;
            --primary-hover: #059669;
            --primary-light: rgba(16, 185, 129, 0.1);
            /* [Previous CSS variables remain the same] */
        }

        /* Additional styles for manage view */
        .table-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: var(--secondary-color);
            padding: 8px 15px;
            border-radius: var(--radius-md);
            width: 300px;
        }

        .search-input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            font-size: 14px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background-color: var(--secondary-color);
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .balozi-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .balozi-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .balozi-name {
            font-weight: 500;
        }

        .balozi-email {
            font-size: 13px;
            color: var(--text-muted);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .status-inactive {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: var(--transition);
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .pagination {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            gap: 5px;
        }

        .page-link {
            padding: 8px 12px;
            border-radius: var(--radius-md);
            background-color: var(--secondary-color);
            color: var(--text-color);
            font-size: 14px;
            transition: var(--transition);
        }

        .page-link:hover,
        .page-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .view-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }

        .tab-btn {
            padding: 8px 15px;
            border: none;
            background: none;
            color: var(--text-muted);
            cursor: pointer;
            border-radius: var(--radius-md);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .tab-btn.active {
            background-color: var(--primary-light);
            color: var(--primary-color);
            font-weight: 500;
        }

        .edit-form-container {
            padding: 20px;
            background-color: var(--secondary-color);
            border-radius: var(--radius-lg);
        }

        .form-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .current-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--primary-light);
        }

        .current-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-title h3 {
            margin: 0;
            color: var(--text-color);
            font-size: 20px;
        }

        .form-title p {
            margin: 5px 0 0;
            color: var(--text-muted);
            font-size: 14px;
        }

        .form-grid {
            display: grid;
            gap: 30px;
        }

        .form-section {
            background: white;
            padding: 20px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
        }

        .section-title {
            margin: 0 0 20px;
            font-size: 16px;
            color: var(--text-color);
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        /* [Previous CSS styles remain the same] */
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <!-- Header -->
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
                <!-- [Header right section remains the same] -->
            </header>

            <!-- Dashboard Content -->
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

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title">Manage Balozi</h2>
                        <div class="search-box">
                            <form action="{{ route('mwenyekiti.balozi.search') }}" method="GET" class="search-form">
                                <i class="fas fa-search"></i>
                                <input type="text" name="search" class="search-input" placeholder="Search Balozi..." value="{{ request('search') }}">
                            </form>
                        </div>
                    </div>

                    <!-- Add tab system for list/edit mode -->
                    <div class="view-tabs">
                        <button class="tab-btn {{ !request('edit_id') ? 'active' : '' }}" onclick="showList()">
                            <i class="fas fa-list"></i> List View
                        </button>
                        @if(request('edit_id'))
                            <button class="tab-btn active">
                                <i class="fas fa-edit"></i> Edit Balozi
                            </button>
                        @endif
                    </div>

                    @if(request('edit_id') && $editBalozi = $balozi->firstWhere('id', request('edit_id')))
                        <!-- Edit Form Section -->
                        <div class="edit-form-container">
                            <form action="{{ route('mwenyekiti.balozi.update', $editBalozi->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-header">
                                    <div class="current-photo">
                                        <img src="{{ $editBalozi->photo ? asset('storage/' . $editBalozi->photo) : asset('images/default-avatar.png') }}" 
                                             alt="Current Photo" 
                                             class="photo-preview">
                                    </div>
                                    <div class="form-title">
                                        <h3>Edit Balozi Information</h3>
                                        <p>Update the information for {{ $editBalozi->first_name }} {{ $editBalozi->last_name }}</p>
                                    </div>
                                </div>

                                <div class="form-grid">
                                    <!-- Personal Information -->
                                    <div class="form-section">
                                        <h4 class="section-title">Personal Information</h4>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" name="first_name" id="first_name" 
                                                       class="form-control @error('first_name') is-invalid @enderror" 
                                                       value="{{ old('first_name', $editBalozi->first_name) }}" required>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="middle_name">Middle Name</label>
                                                <input type="text" name="middle_name" id="middle_name" 
                                                       class="form-control @error('middle_name') is-invalid @enderror" 
                                                       value="{{ old('middle_name', $editBalozi->middle_name) }}">
                                                @error('middle_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" name="last_name" id="last_name" 
                                                       class="form-control @error('last_name') is-invalid @enderror" 
                                                       value="{{ old('last_name', $editBalozi->last_name) }}" required>
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Contact Information -->
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" 
                                                       class="form-control @error('email') is-invalid @enderror" 
                                                       value="{{ old('email', $editBalozi->email) }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" 
                                                       class="form-control @error('phone') is-invalid @enderror" 
                                                       value="{{ old('phone', $editBalozi->phone) }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Location Information -->
                                    <div class="form-section">
                                        <h4 class="section-title">Location Information</h4>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="street_village">Street/Village</label>
                                                <input type="text" name="street_village" id="street_village" 
                                                       class="form-control @error('street_village') is-invalid @enderror" 
                                                       value="{{ old('street_village', $editBalozi->street_village) }}" required>
                                                @error('street_village')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="shina">Shina</label>
                                                <input type="text" name="shina" id="shina" 
                                                       class="form-control @error('shina') is-invalid @enderror" 
                                                       value="{{ old('shina', $editBalozi->shina) }}" required>
                                                @error('shina')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="shina_number">Shina Number</label>
                                                <input type="text" name="shina_number" id="shina_number" 
                                                       class="form-control @error('shina_number') is-invalid @enderror" 
                                                       value="{{ old('shina_number', $editBalozi->shina_number) }}" required>
                                                @error('shina_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Other Information -->
                                    <div class="form-section">
                                        <h4 class="section-title">Other Information</h4>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="photo">Update Photo</label>
                                                <input type="file" name="photo" id="photo" 
                                                       class="form-control @error('photo') is-invalid @enderror" 
                                                       accept="image/*">
                                                @error('photo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="is_active">Status</label>
                                                <select name="is_active" id="is_active" class="form-control">
                                                    <option value="1" {{ $editBalozi->is_active ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ !$editBalozi->is_active ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save Changes
                                    </button>
                                    <a href="{{ route('mwenyekiti.balozi.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    @else
                        <!-- List View Table -->
                        <table class="data-table">
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
                                        <div class="balozi-info">
                                            <img src="{{ $b->photo ? asset('storage/' . $b->photo) : asset('images/default-avatar.png') }}" 
                                                 alt="Balozi Photo" 
                                                 class="balozi-avatar">
                                            <div>
                                                <div class="balozi-name">
                                                    {{ $b->first_name }} {{ $b->middle_name }} {{ $b->last_name }}
                                                </div>
                                                <div class="balozi-email">{{ $b->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ $b->phone }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $b->street_village }}</div>
                                        <div style="font-size: 13px; color: var(--text-muted);">
                                            Shina: {{ $b->shina }} ({{ $b->shina_number }})
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $b->is_active ? 'status-active' : 'status-inactive' }}">
                                            {{ $b->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $b->created_at->format('M d, Y') }}
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('mwenyekiti.balozi.index', ['edit_id' => $b->id]) }}" 
                                               class="action-btn" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('mwenyekiti.balozi.show', $b->id) }}" 
                                               class="action-btn" 
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
                            {{ $balozi->links() }}
                        </div>
                    @endif
                </div>

                <div class="action-buttons" style="margin-top: 20px;">
                    <a href="{{ route('mwenyekiti.balozi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Balozi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showList() {
            window.location.href = "{{ route('mwenyekiti.balozi.index') }}";
        }

        // Photo preview
        document.getElementById('photo')?.addEventListener('change', function(e) {
            const preview = document.querySelector('.current-photo img');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>