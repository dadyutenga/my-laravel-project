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

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title">All Balozi</h2>
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="search-input" placeholder="Search Balozi...">
                        </div>
                    </div>

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
                                        <a href="{{ route('mwenyekiti.balozi.show', $b->id) }}" 
                                           class="action-btn" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('mwenyekiti.balozi.edit', $b->id) }}" 
                                           class="action-btn" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
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
        // Search functionality
        document.querySelector('.search-input').addEventListener('keyup', function(e) {
            const searchText = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });

        // [Previous JavaScript remains the same]
    </script>
</body>
</html>