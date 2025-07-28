<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maelezo ya {{ $mtu->first_name }} {{ $mtu->last_name }} | Mwenyekiti Dashboard</title>
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
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
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
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
        }

        .btn {
            padding: 10px 16px;
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
        }

        .btn-secondary {
            background: var(--border-color);
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .person-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .person-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 32px 24px;
            text-align: center;
        }

        .person-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 700;
            margin: 0 auto 16px;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .person-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .person-id {
            font-size: 16px;
            opacity: 0.9;
        }

        .person-details {
            padding: 24px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        .detail-group {
            background: var(--secondary-color);
            padding: 16px;
            border-radius: var(--radius-md);
        }

        .detail-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .detail-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            background: var(--primary-light);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .detail-content {
            flex: 1;
        }

        .detail-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .badge {
            padding: 4px 12px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .badge-male {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-female {
            background: #fce7f3;
            color: #be185d;
        }

        .registrar-info {
            background: var(--info-color);
            color: white;
            padding: 16px;
            border-radius: var(--radius-md);
            margin-top: 24px;
        }

        .registrar-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .registrar-details {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .registrar-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .container {
                padding: 16px;
            }

            .page-header {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .person-name {
                font-size: 24px;
            }

            .person-avatar {
                width: 80px;
                height: 80px;
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Maelezo ya Mtu</h1>
            <a href="{{ route('mwenyekiti.watu.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Rudi
            </a>
        </div>

        <!-- Person Card -->
        <div class="person-card">
            <!-- Person Header -->
            <div class="person-header">
                <div class="person-avatar">
                    {{ strtoupper(substr($mtu->first_name, 0, 1)) }}{{ strtoupper(substr($mtu->last_name, 0, 1)) }}
                </div>
                <h1 class="person-name">
                    {{ $mtu->first_name }} {{ $mtu->middle_name }} {{ $mtu->last_name }}
                </h1>
                @if($mtu->national_id)
                    <p class="person-id">ID: {{ $mtu->national_id }}</p>
                @endif
            </div>

            <!-- Person Details -->
            <div class="person-details">
                <div class="details-grid">
                    <!-- Personal Information -->
                    <div class="detail-group">
                        <h3 class="detail-title">Maelezo ya Kibinafsi</h3>
                        
                        @if($mtu->gender)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Jinsia</div>
                                    <div class="detail-value">
                                        <span class="badge badge-{{ $mtu->gender }}">
                                            {{ $mtu->gender == 'male' ? 'Mume' : 'Mke' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($mtu->date_of_birth)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-birthday-cake"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Tarehe ya Kuzaliwa</div>
                                    <div class="detail-value">
                                        {{ \Carbon\Carbon::parse($mtu->date_of_birth)->format('d/m/Y') }}
                                        ({{ \Carbon\Carbon::parse($mtu->date_of_birth)->age }} miaka)
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($mtu->national_id)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Namba ya Kitambulisho</div>
                                    <div class="detail-value">{{ $mtu->national_id }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Contact Information -->
                    <div class="detail-group">
                        <h3 class="detail-title">Maelezo ya Mawasiliano</h3>
                        
                        @if($mtu->phone)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Namba ya Simu</div>
                                    <div class="detail-value">{{ $mtu->phone }}</div>
                                </div>
                            </div>
                        @endif

                        @if($mtu->email)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Barua Pepe</div>
                                    <div class="detail-value">{{ $mtu->email }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Location Information -->
                    <div class="detail-group">
                        <h3 class="detail-title">Maelezo ya Mahali</h3>
                        
                        @if($mtu->mtaa)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Mtaa</div>
                                    <div class="detail-value">{{ $mtu->mtaa }}</div>
                                </div>
                            </div>
                        @endif

                        @if($mtu->shina)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-road"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Shina</div>
                                    <div class="detail-value">{{ $mtu->shina }} {{ $mtu->shina_number }}</div>
                                </div>
                            </div>
                        @endif

                        @if($mtu->street_village)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Barabara/Kijiji</div>
                                    <div class="detail-value">{{ $mtu->street_village }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Registration Information -->
                    <div class="detail-group">
                        <h3 class="detail-title">Maelezo ya Usajili</h3>
                        
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Tarehe ya Usajili</div>
                                <div class="detail-value">
                                    {{ $mtu->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>

                        @if($mtu->updated_at != $mtu->created_at)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Tarehe ya Marekebisho</div>
                                    <div class="detail-value">
                                        {{ $mtu->updated_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Registrar Information -->
                @if($mtu->balozi)
                    <div class="registrar-info">
                        <h3 class="registrar-title">Amesajiliwa na:</h3>
                        <div class="registrar-details">
                            <div class="registrar-avatar">
                                {{ strtoupper(substr($mtu->balozi->first_name, 0, 1)) }}{{ strtoupper(substr($mtu->balozi->last_name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight: 600;">
                                    {{ $mtu->balozi->first_name }} {{ $mtu->balozi->last_name }}
                                </div>
                                @if($mtu->balozi->phone)
                                    <div style="font-size: 14px; opacity: 0.9;">
                                        <i class="fas fa-phone"></i> {{ $mtu->balozi->phone }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>