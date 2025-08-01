<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taarifa za Tangazo | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #37b025;
            --primary-light: rgba(79, 70, 229, 0.1);
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --error-color: #ef4444;
            --success-color: #37b025;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Include all sidebar styles (same as previous files) */
        .sidebar {
            width: var(--sidebar-width);
            background-color: white;
            border-right: 1px solid var(--border-color);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-color);
            font-weight: 700;
            font-size: 18px;
            transition: var(--transition);
        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            border-radius: 4px;
            font-size: 16px;
        }

        .logo-text {
            transition: var(--transition);
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }

        .sidebar-toggle {
            position: absolute;
            top: 20px;
            right: -12px;
            width: 24px;
            height: 24px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            z-index: 10;
            border: 2px solid white;
            transition: var(--transition);
        }

        .sidebar-toggle i {
            font-size: 12px;
            transition: var(--transition);
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar-menu {
            padding: 20px 0;
            overflow-y: auto;
            height: calc(100vh - var(--header-height));
        }

        .menu-section {
            margin-bottom: 20px;
        }

        .menu-section-title {
            padding: 10px 20px;
            font-size: 12px;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 600;
            letter-spacing: 0.5px;
            white-space: nowrap;
            overflow: hidden;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-section-title {
            opacity: 0;
        }

        .menu-item {
            padding: 10px 20px;
            display: flex;
            align-items: center;
            color: var(--text-color);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            margin: 2px 0;
        }

        .menu-item:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .menu-item.active {
            background-color: var(--primary-light);
            color: var(--primary-color);
            font-weight: 500;
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: var(--primary-color);
        }

        .menu-icon {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .menu-text {
            transition: var(--transition);
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
            width: 0;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .dashboard-content {
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
        }

        .detail-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .announcement-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 10px;
        }

        .announcement-title-sw {
            font-size: 20px;
            font-weight: 500;
            color: var(--text-muted);
            font-style: italic;
        }

        .announcement-badges {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-end;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-muted);
        }

        .detail-value {
            color: var(--text-color);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .content-section {
            line-height: 1.7;
            font-size: 16px;
            color: var(--text-color);
            white-space: pre-line;
        }

        .content-sw {
            background-color: #f8fafc;
            padding: 20px;
            border-radius: var(--radius-md);
            border-left: 4px solid var(--primary-color);
            margin-top: 20px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .status-badge {
            padding: 8px 12px;
            border-radius: var(--radius-md);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.active {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-badge.expired {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .status-badge.draft {
            background-color: rgba(107, 114, 128, 0.1);
            color: var(--text-muted);
        }

        .priority-badge {
            padding: 8px 12px;
            border-radius: var(--radius-md);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .priority-badge.urgent {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .priority-badge.high {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .priority-badge.normal {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .priority-badge.low {
            background-color: rgba(107, 114, 128, 0.1);
            color: var(--text-muted);
        }

        .category-badge {
            padding: 8px 12px;
            border-radius: var(--radius-md);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .attachments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .attachment-card {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 15px;
            text-align: center;
            transition: var(--transition);
        }

        .attachment-card:hover {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .attachment-icon {
            font-size: 24px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .attachment-name {
            font-weight: 500;
            margin-bottom: 5px;
            word-break: break-word;
        }

        .attachment-size {
            font-size: 12px;
            color: var(--text-muted);
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

        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
                transform: translateX(calc(var(--sidebar-collapsed-width) * -1));
            }

            .main-content {
                margin-left: 0;
            }

            .page-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .announcement-header {
                flex-direction: column;
                gap: 15px;
            }

            .detail-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .btn-group {
                flex-wrap: wrap;
            }
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
            display: none;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <div class="dashboard-content">
                <div class="page-header">
                    <h2 class="dashboard-title">Taarifa za Tangazo</h2>
                    <div class="header-actions">
                        <a href="{{ route('mwenyekiti.matangazo.edit', ['id' => $announcement->id]) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Hariri
                        </a>
                        <a href="{{ route('mwenyekiti.matangazo.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Rudi Kwenye Orodha
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="content-container">
                    <!-- Basic Information -->
                    <div class="content-section">
                        <h3 class="section-title">
                            <i class="fas fa-info-circle"></i>
                            Taarifa za Msingi
                        </h3>
                        
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="detail-label">Namba ya Tangazo</div>
                                <div class="detail-value">{{ $announcement->id }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Aina</div>
                                <div class="detail-value">{{ $announcement->type == 'general' ? 'Tangazo la Kawaida' : 'Tangazo la Mkutano' }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Mtaa</div>
                                <div class="detail-value">{{ $announcement->mtaa }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Kategoria</div>
                                <div class="detail-value">{{ ucfirst($announcement->category) }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Kipaumbele</div>
                                <div class="detail-value">
                                    <span class="priority-badge {{ $announcement->priority }}">
                                        @switch($announcement->priority)
                                            @case('urgent')
                                                Haraka
                                                @break
                                            @case('high')
                                                Juu
                                                @break
                                            @case('normal')
                                                Kawaida
                                                @break
                                            @case('low')
                                                Chini
                                                @break
                                        @endswitch
                                    </span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Walengwa</div>
                                <div class="detail-value">{{ $announcement->target_audience }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Idadi ya Watazamaji</div>
                                <div class="detail-value">{{ $announcement->views_count }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Tarehe ya Kuanza</div>
                                <div class="detail-value">{{ $announcement->effective_date ? $announcement->effective_date->format('d/m/Y') : 'Hakuna' }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Tarehe ya Mwisho</div>
                                <div class="detail-value">{{ $announcement->expiry_date ? $announcement->expiry_date->format('d/m/Y') : 'Hakuna' }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Tangazo Maalum</div>
                                <div class="detail-value">{{ $announcement->is_featured ? 'Ndio' : 'Hapana' }}</div>
                            </div>

                            @if($announcement->type == 'meeting')
                                <div class="info-item">
                                    <div class="detail-label">Mkutano Husika</div>
                                    <div class="detail-value">{{ $announcement->mtaaMeeting ? $announcement->mtaaMeeting->title : 'Hakuna' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="detail-label">Tarehe ya Mkutano</div>
                                    <div class="detail-value">{{ $announcement->mtaaMeeting ? $announcement->mtaaMeeting->meeting_date->format('d/m/Y') : 'Hakuna' }}</div>
                                </div>
                            @endif

                            <div class="info-item">
                                <div class="detail-label">Imetengenezwa Na</div>
                                <div class="detail-value">{{ $announcement->creator ? $announcement->creator->name : 'Hakuna' }}</div>
                            </div>

                            <div class="info-item">
                                <div class="detail-label">Tarehe ya Kutengenezwa</div>
                                <div class="detail-value">{{ $announcement->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Announcement Content -->
                    <div class="content-section">
                        <h3 class="section-title">
                            <i class="fas fa-file-alt"></i>
                            Maudhui ya Tangazo
                        </h3>
                        
                        <div class="announcement-content">
                            <h4>Kiingereza</h4>
                            <div class="content-text">{{ $announcement->content }}</div>

                            <h4>Kiswahili</h4>
                            <div class="content-text">{{ $announcement->content_sw ?: 'Hakuna tafsiri ya Kiswahili' }}</div>
                        </div>
                    </div>

                    <!-- Attachments -->
                    @if($announcement->attachments && count($announcement->attachments) > 0)
                        <div class="content-section">
                            <h3 class="section-title">
                                <i class="fas fa-paperclip"></i>
                                Viambatisho
                            </h3>
                            
                            <div class="attachments-grid">
                                @foreach($announcement->attachments as $attachment)
                                    <div class="attachment-card">
                                        <div class="attachment-icon">
                                            <i class="fas fa-file"></i>
                                        </div>
                                        <div class="attachment-info">
                                            <div class="attachment-name">{{ $attachment->original_name }}</div>
                                            <div class="attachment-size">{{ $attachment->formatted_size }}</div>
                                        </div>
                                        <a href="{{ route('mwenyekiti.matangazo.download', $attachment->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i>
                                            Pakua
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay"></div>

    <script>
        // Sidebar toggle functionality
        document.querySelector('.sidebar-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

        // Close sidebar when clicking on overlay
        document.querySelector('.sidebar-overlay')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('collapsed');
            this.classList.remove('active');
        });
    </script>
</body>
</html>