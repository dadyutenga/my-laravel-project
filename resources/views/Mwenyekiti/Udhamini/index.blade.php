<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Udhamini Forms | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: rgba(79, 70, 229, 0.1);
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

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
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

        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .table-container {
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow: hidden;
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
        }

        .table th {
            background-color: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
        }

        .table tbody tr:hover {
            background-color: var(--primary-light);
        }

        .alert {
            padding: 12px 20px;
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

        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <div class="dashboard-content">
                <h2 class="dashboard-title">Fomu za Udhamini</h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="actions-bar">
                    <div></div>
                    <a href="{{ route('mwenyekiti.udhamini.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Create New Udhamini
                    </a>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Person Name</th>
                                <th>Phone</th>
                                <th>Sababu</th>
                                <th>Tarehe</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($udhaminiList as $udhamini)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $udhamini->watu->first_name }} {{ $udhamini->watu->last_name }}</td>
                                    <td>{{ $udhamini->watu->phone_number }}</td>
                                    <td>{{ Str::limit($udhamini->sababu, 50) }}</td>
                                    <td>{{ $udhamini->tarehe->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('mwenyekiti.udhamini.show', $udhamini->id) }}" class="btn btn-secondary" style="margin-right: 5px;">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </a>
                                        <a href="{{ route('mwenyekiti.udhamini.print', $udhamini->id) }}" class="btn btn-success">
                                            <i class="fas fa-print"></i>
                                            Print
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px;">
                                        <i class="fas fa-inbox" style="font-size: 48px; color: var(--text-muted); margin-bottom: 10px;"></i>
                                        <p>No Udhamini forms found</p>
                                        <a href="{{ route('mwenyekiti.udhamini.create') }}" class="btn btn-primary" style="margin-top: 10px;">
                                            <i class="fas fa-plus"></i>
                                            Create First Udhamini
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($udhaminiList->hasPages())
                    <div class="pagination">
                        {{ $udhaminiList->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>