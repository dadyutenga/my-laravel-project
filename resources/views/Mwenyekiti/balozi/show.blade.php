<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balozi Details | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #10b981;  /* Green theme */
            --primary-hover: #059669;
            --primary-light: rgba(16, 185, 129, 0.1);
            /* [Previous CSS variables remain the same] */
        }

        /* Additional styles for show view */
        .detail-card {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 25px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .detail-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .balozi-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-light);
        }

        .balozi-info {
            flex: 1;
        }

        .balozi-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .balozi-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
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

        .detail-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-color);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .detail-label {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .detail-value {
            font-size: 15px;
            color: var(--text-color);
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
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
                    <h1 class="page-title">Balozi Details</h1>
                    <div class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('mwenyekiti.dashboard') }}" class="breadcrumb-link">Home</a>
                        </div>
                        <div class="breadcrumb-item">
                            <a href="{{ route('mwenyekiti.balozi.index') }}" class="breadcrumb-link">Balozi</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Details</span>
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

                <div class="detail-card">
                    <div class="detail-header">
                        <img src="{{ $balozi->photo ? asset('storage/' . $balozi->photo) : asset('images/default-avatar.png') }}" 
                             alt="Balozi Photo" 
                             class="balozi-photo">
                        <div class="balozi-info">
                            <h2 class="balozi-name">
                                {{ $balozi->first_name }} {{ $balozi->middle_name }} {{ $balozi->last_name }}
                            </h2>
                            <span class="balozi-status {{ $balozi->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $balozi->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>

                    <div class="detail-section">
                        <h3 class="section-title">Personal Information</h3>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">Email</span>
                                <span class="detail-value">{{ $balozi->email }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Phone</span>
                                <span class="detail-value">{{ $balozi->phone }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Date of Birth</span>
                                <span class="detail-value">{{ $balozi->date_of_birth->format('M d, Y') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Gender</span>
                                <span class="detail-value">{{ ucfirst($balozi->gender) }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">National ID</span>
                                <span class="detail-value">{{ $balozi->national_id }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <h3 class="section-title">Location Information</h3>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">Street/Village</span>
                                <span class="detail-value">{{ $balozi->street_village }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Shina</span>
                                <span class="detail-value">{{ $balozi->shina }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Shina Number</span>
                                <span class="detail-value">{{ $balozi->shina_number }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('mwenyekiti.balozi.edit', $balozi->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Details
                        </a>
                        <a href="{{ route('mwenyekiti.balozi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // [Previous JavaScript remains the same]
    </script>
</body>
</html>