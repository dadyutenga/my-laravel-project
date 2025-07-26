<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Udhamini Details | Prototype System</title>
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

        .form-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-muted);
        }

        .detail-value {
            color: var(--text-color);
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

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .photo-container {
            text-align: center;
            margin: 20px 0;
        }

        .photo-container img {
            max-width: 200px;
            max-height: 250px;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <div class="dashboard-content">
                <h2 class="dashboard-title">Udhamini Details</h2>

                <div class="form-container">
                    <h3 class="section-title">Person Information</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">Full Name:</div>
                        <div class="detail-value">{{ $udhamini->watu->first_name }} {{ $udhamini->watu->middle_name }} {{ $udhamini->watu->last_name }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Phone Number:</div>
                        <div class="detail-value">{{ $udhamini->watu->phone_number }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">{{ $udhamini->watu->email ?? 'N/A' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Gender:</div>
                        <div class="detail-value">{{ $udhamini->watu->gender }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Mtaa:</div>
                        <div class="detail-value">{{ $udhamini->watu->mtaa ?? 'N/A' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">District:</div>
                        <div class="detail-value">{{ $udhamini->watu->district ?? 'N/A' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Region:</div>
                        <div class="detail-value">{{ $udhamini->watu->region ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="form-container">
                    <h3 class="section-title">Udhamini Information</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">Date:</div>
                        <div class="detail-value">{{ $udhamini->tarehe->format('d/m/Y') }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Sababu (Reason):</div>
                        <div class="detail-value">{{ $udhamini->sababu }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Muelekeo (Direction):</div>
                        <div class="detail-value">{{ $udhamini->muelekeo }}</div>
                    </div>

                    @if($udhamini->picha)
                    <div class="photo-container">
                        <h4>Photo:</h4>
                        <img src="{{ asset('storage/' . $udhamini->picha) }}" alt="Person Photo">
                    </div>
                    @endif
                </div>

                <div class="form-container">
                    <h3 class="section-title">Mwenyekiti Information</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">Name:</div>
                        <div class="detail-value">{{ $udhamini->createdBy->first_name }} {{ $udhamini->createdBy->last_name }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Phone:</div>
                        <div class="detail-value">{{ $udhamini->createdBy->phone }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Created At:</div>
                        <div class="detail-value">{{ $udhamini->created_at->format('d/m/Y H:i') }}</div>
                    </div>

                    <div class="btn-group">
                        <a href="{{ route('mwenyekiti.udhamini.print', $udhamini->id) }}" class="btn btn-success">
                            <i class="fas fa-download"></i>
                            Download PDF
                        </a>
                        <a href="{{ route('mwenyekiti.udhamini.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>