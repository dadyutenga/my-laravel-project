<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahitaji Maalumu | Prototype System</title>
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
            min-height: 100vh;
        }

        .header {
            height: var(--header-height);
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
        }

        .header-action {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dashboard-content {
            padding: 30px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
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

        .btn-sm {
            padding: 8px 16px;
            font-size: 12px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .table-container {
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 30px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background-color: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
        }

        .table td {
            font-size: 14px;
            color: var(--text-color);
        }

        .table tbody tr:hover {
            background-color: var(--secondary-color);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-edit {
            background-color: var(--info-color);
            color: white;
        }

        .btn-delete {
            background-color: var(--error-color);
            color: white;
        }

        .btn-download {
            background-color: var(--success-color);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--border-color);
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .dashboard-content {
                padding: 20px;
            }

            .content-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }

            .table-container {
                overflow-x: auto;
            }

            .table {
                min-width: 800px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Balozi.shared.sidebar-menu')
        
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <h1 class="header-title">Mahitaji Maalumu</h1>
                </div>
                <div class="header-action">
                    <a href="{{ route('balozi.mahitaji-maalumu.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Add New Record
                    </a>
                </div>
            </div>

            <div class="dashboard-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title">Special Needs Individuals Records</h2>
                    </div>

                    @if($mahitajiMaalumu->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>NIDA Number</th>
                                    <th>Disability Type</th>
                                    <th>Document</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahitajiMaalumu as $record)
                                    <tr>
                                        <td>{{ $record->first_name }} {{ $record->middle_name }} {{ $record->last_name }}</td>
                                        <td>{{ $record->age }}</td>
                                        <td>{{ ucfirst($record->gender) }}</td>
                                        <td>{{ $record->phone }}</td>
                                        <td>{{ $record->nida_number }}</td>
                                        <td>{{ $record->disability_type }}</td>
                                        <td>
                                            @if($record->pdf_file_path)
                                                <a href="{{ route('balozi.mahitaji-maalumu.download-pdf', $record->id) }}" 
                                                   class="btn btn-sm btn-download">
                                                    <i class="fas fa-download"></i>
                                                    PDF
                                                </a>
                                            @else
                                                <span class="text-muted">No file</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('balozi.mahitaji-maalumu.edit', $record->id) }}" 
                                                   class="btn btn-sm btn-edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('balozi.mahitaji-maalumu.destroy', $record->id) }}" 
                                                      method="POST" style="display: inline;"
                                                      onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h3>No records found</h3>
                            <p>You haven't added any Mahitaji Maalumu records yet.</p>
                            <a href="{{ route('balozi.mahitaji-maalumu.create') }}" class="btn btn-primary" style="margin-top: 16px;">
                                <i class="fas fa-plus"></i>
                                Add First Record
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>