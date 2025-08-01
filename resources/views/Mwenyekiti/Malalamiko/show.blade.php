
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maelezo ya Lalamiko | Mwenyekiti Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #4ee546;
            --primary-light: rgba(79, 70, 229, 0.1);
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --success-color: #37b025;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
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
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* SIDEBAR STYLES */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid var(--border-color);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 100;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-color);
            transition: var(--transition);
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 8px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .sidebar-toggle:hover {
            background: var(--secondary-color);
            color: var(--text-color);
        }

        .sidebar-toggle i {
            font-size: 16px;
            transition: var(--transition);
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-section {
            margin-bottom: 24px;
        }

        .menu-section-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 20px;
            margin-bottom: 8px;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-section-title {
            display: none;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: var(--transition);
            border-right: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(79, 70, 229, 0.05);
            color: var(--primary-color);
        }

        .menu-item.active {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
            border-right-color: var(--primary-color);
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .menu-text {
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-text {
            display: none;
        }

        .sidebar.collapsed .menu-item {
            padding: 12px;
            justify-content: center;
        }

        .sidebar.collapsed .menu-icon {
            margin-right: 0;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }

        .content-area {
            padding: 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        .page-header {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 14px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-btn:hover {
            color: var(--primary-hover);
        }

        /* Complaint Details */
        .complaint-details {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        .detail-card {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .detail-item {
            margin-bottom: 16px;
        }

        .detail-label {
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 4px;
            font-size: 14px;
        }

        .detail-value {
            color: var(--text-color);
            font-size: 15px;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            display: inline-block;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-resolved {
            background: #d1fae5;
            color: #047857;
        }

        .status-rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .balozi-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: var(--secondary-color);
            border-radius: var(--radius-md);
        }

        .balozi-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
        }

        .balozi-details h4 {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .balozi-meta {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 20px;
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

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #37b025;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: var(--error-color);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius-lg);
            padding: 24px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-muted);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success {
            background: #d1fae5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fca5a5;
        }

        /* Mobile Header */
        .mobile-header {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: white;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .mobile-menu-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-color);
            cursor: pointer;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-width);
                transform: translateX(-100%);
                z-index: 1001;
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar.collapsed ~ .main-content {
                margin-left: 0;
                width: 100%;
            }

            .mobile-header {
                display: flex;
            }

            .content-area {
                padding: 16px;
            }

            .complaint-details {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .header-top {
                flex-direction: column;
                align-items: stretch;
            }

            .action-buttons {
                flex-direction: column;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
            }

            .sidebar.mobile-open ~ .sidebar-overlay {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Include Shared Sidebar -->
        @include('Mwenyekiti.shared.sidebar-menu')

        <!-- Mobile Header -->
        <div class="mobile-header">
            <button class="mobile-menu-btn" id="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Maelezo ya Lalamiko</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-top">
                        <div>
                            <h1 class="page-title">Maelezo ya Lalamiko</h1>
                            <p class="page-subtitle">Angalia maelezo kamili ya lalamiko na ubadilishe hali yake</p>
                        </div>
                        <a href="{{ route('mwenyekiti.malalamiko.index') }}" class="back-btn">
                            <i class="fas fa-arrow-left"></i> Rudi Nyuma
                        </a>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Complaint Details -->
                <div class="complaint-details">
                    <!-- Main Details -->
                    <div class="detail-card">
                        <div class="card-header">
                            <h3 class="card-title">Maelezo ya Lalamiko</h3>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Jina la Mlalamikaji</div>
                            <div class="detail-value">
                                <strong>{{ $malalamiko->first_name }} {{ $malalamiko->middle_name }} {{ $malalamiko->last_name }}</strong>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Nambari ya Simu</div>
                            <div class="detail-value">{{ $malalamiko->phone }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Mtaa</div>
                            <div class="detail-value">{{ $malalamiko->mtaa }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Jinsia</div>
                            <div class="detail-value">{{ $malalamiko->jinsia }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Lalamiko</div>
                            <div class="detail-value">{{ $malalamiko->malalamiko ?: 'Hakuna maelezo ya ziada yaliyotolewa' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Hali ya Sasa</div>
                            <div class="detail-value">
                                <span class="status-badge status-{{ $malalamiko->status }}">
                                    @if($malalamiko->status == 'pending')
                                        Inasubiri Maamuzi
                                    @elseif($malalamiko->status == 'resolved')
                                        Imetatuliwa
                                    @else
                                        Imekataliwa
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Tarehe ya Kulalamika</div>
                            <div class="detail-value">{{ $malalamiko->created_at->format('d/m/Y - H:i') }}</div>
                        </div>

                        @if($malalamiko->admin_notes)
                            <div class="detail-item">
                                <div class="detail-label">Maelezo ya Mwenyekiti</div>
                                <div class="detail-value">{{ $malalamiko->admin_notes }}</div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        @if($malalamiko->status == 'pending')
                            <div class="action-buttons">
                                <button class="btn btn-success" onclick="updateStatus('resolved')">
                                    <i class="fas fa-check"></i> Tatua Lalamiko
                                </button>
                                <button class="btn btn-danger" onclick="updateStatus('rejected')">
                                    <i class="fas fa-times"></i> Kataa Lalamiko
                                </button>
                            </div>
                        @else
                            <div class="action-buttons">
                                <button class="btn btn-warning" onclick="updateStatus('pending')">
                                    <i class="fas fa-undo"></i> Rudisha Kusubiri
                                </button>
                                @if($malalamiko->status == 'resolved')
                                    <button class="btn btn-danger" onclick="updateStatus('rejected')">
                                        <i class="fas fa-times"></i> Kataa Lalamiko
                                    </button>
                                @else
                                    <button class="btn btn-success" onclick="updateStatus('resolved')">
                                        <i class="fas fa-check"></i> Tatua Lalamiko
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar Info -->
                    <div class="detail-card">
                        <div class="card-header">
                            <h3 class="card-title">Maelezo ya Balozi</h3>
                        </div>

                        @if($malalamiko->balozi)
                            <div class="balozi-info">
                                <div class="balozi-avatar">
                                    {{ strtoupper(substr($malalamiko->balozi->first_name, 0, 1) . substr($malalamiko->balozi->last_name, 0, 1)) }}
                                </div>
                                <div class="balozi-details">
                                    <h4>{{ $malalamiko->balozi->first_name }} {{ $malalamiko->balozi->last_name }}</h4>
                                    <div class="balozi-meta">
                                        <i class="fas fa-phone"></i>
                                        {{ $malalamiko->balozi->phone }}
                                    </div>
                                    @if($malalamiko->balozi->email)
                                        <div class="balozi-meta">
                                            <i class="fas fa-envelope"></i>
                                            {{ $malalamiko->balozi->email }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="detail-item" style="margin-top: 20px;">
                                <div class="detail-label">Eneo la Utumishi</div>
                                <div class="detail-value">{{ $malalamiko->balozi->street_village ?: 'Halijabainishwa' }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Shina</div>
                                <div class="detail-value">
                                    {{ $malalamiko->balozi->shina }} 
                                    @if($malalamiko->balozi->shina_number)
                                        - {{ $malalamiko->balozi->shina_number }}
                                    @endif
                                </div>
                            </div>
                        @else
                            <p style="color: var(--text-muted); text-align: center; padding: 20px;">
                                Maelezo ya Balozi hayapatikani
                            </p>
                        @endif

                        <!-- Complaint Timeline -->
                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                            <h4 style="margin-bottom: 16px; font-size: 16px;">Mtiririko wa Lalamiko</h4>
                            
                            <div style="position: relative; padding-left: 20px;">
                                <div style="position: absolute; left: 8px; top: 0; width: 2px; height: 100%; background: var(--border-color);"></div>
                                
                                <div style="position: relative; margin-bottom: 16px;">
                                    <div style="position: absolute; left: -16px; width: 12px; height: 12px; border-radius: 50%; background: var(--primary-color);"></div>
                                    <div style="font-size: 14px;">
                                        <strong>Limetengenezwa</strong><br>
                                        <span style="color: var(--text-muted);">{{ $malalamiko->created_at->format('d/m/Y - H:i') }}</span>
                                    </div>
                                </div>

                                @if($malalamiko->status != 'pending')
                                    <div style="position: relative;">
                                        <div style="position: absolute; left: -16px; width: 12px; height: 12px; border-radius: 50%; 
                                                    background: {{ $malalamiko->status == 'resolved' ? 'var(--success-color)' : 'var(--error-color)' }};"></div>
                                        <div style="font-size: 14px;">
                                            <strong>
                                                @if($malalamiko->status == 'resolved')
                                                    Limetatuliwa
                                                @else
                                                    Limekataliwa
                                                @endif
                                            </strong><br>
                                            <span style="color: var(--text-muted);">{{ $malalamiko->updated_at->format('d/m/Y - H:i') }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Badilisha Hali ya Lalamiko</h3>
                <button class="close-modal" onclick="closeModal()">&times;</button>
            </div>
            <form id="statusForm" method="POST" action="{{ route('mwenyekiti.malalamiko.update-status', $malalamiko->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Hali Mpya</label>
                    <select name="status" class="form-select" required>
                        <option value="">Chagua hali...</option>
                        <option value="resolved">Tatua</option>
                        <option value="rejected">Kataa</option>
                        <option value="pending">Rudisha Kusubiri</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Maelezo ya Ziada (Si Lazima)</label>
                    <textarea name="admin_notes" class="form-textarea" placeholder="Andika maelezo ya uamuzi wako...">{{ $malalamiko->admin_notes }}</textarea>
                </div>
                <div style="display: flex; gap: 12px; justify-content: end;">
                    <button type="button" class="btn btn-outline" onclick="closeModal()">Ghairi</button>
                    <button type="submit" class="btn btn-success">Hifadhi Mabadiliko</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Desktop sidebar toggle
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                });
            }

            // Mobile menu toggle
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-open');
                });
            }

            // Close mobile menu when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                });
            }
        });

        // Update status function
        function updateStatus(status) {
            const form = document.getElementById('statusForm');
            const statusSelect = form.querySelector('select[name="status"]');
            statusSelect.value = status;

            // Update modal title based on action
            const modalTitle = document.querySelector('.modal-title');
            if (status === 'resolved') {
                modalTitle.textContent = 'Tatua Lalamiko';
            } else if (status === 'rejected') {
                modalTitle.textContent = 'Kataa Lalamiko';
            } else {
                modalTitle.textContent = 'Rudisha Lalamiko Kusubiri';
            }

            // Show modal
            document.getElementById('statusModal').classList.add('show');
        }

        // Close modal function
        function closeModal() {
            document.getElementById('statusModal').classList.remove('show');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('statusModal');
            if (e.target === modal) {
                closeModal();
            }
        });

        // Form submission with loading state
        document.getElementById('statusForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inahifadhi...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>