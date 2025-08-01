
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongeza Maendeleo ya Siku | Mwenyekiti Dashboard</title>
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
            --green-color: #059669;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
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

        /* Layout */
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
            max-width: 800px;
            margin: 0 auto;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--green-color);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: var(--text-muted);
        }

        /* Page Header */
        .page-header {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-left {
            flex: 1;
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

        /* Form Card */
        .form-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .form-header {
            padding: 20px 24px;
            background: rgba(5, 150, 105, 0.1);
            border-bottom: 1px solid var(--border-color);
        }

        .form-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-body {
            padding: 24px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-label.required::after {
            content: ' *';
            color: var(--error-color);
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            font-family: inherit;
            transition: var(--transition);
            background: white;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--green-color);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-help {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .form-error {
            font-size: 12px;
            color: var(--error-color);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-group.has-error .form-input,
        .form-group.has-error .form-textarea {
            border-color: var(--error-color);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Character Counter */
        .char-counter {
            font-size: 12px;
            color: var(--text-muted);
            text-align: right;
            margin-top: 4px;
        }

        .char-counter.warning {
            color: var(--warning-color);
        }

        .char-counter.danger {
            color: var(--error-color);
        }

        /* Form Actions */
        .form-actions {
            padding: 20px 24px;
            background: var(--secondary-color);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
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

        .btn-primary {
            background: var(--green-color);
            color: white;
        }

        .btn-primary:hover {
            background: #047857;
        }

        .btn-primary:disabled {
            background: var(--text-muted);
            cursor: not-allowed;
        }

        .btn-secondary {
            background: var(--border-color);
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background: var(--text-muted);
            color: white;
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

            .header-content {
                flex-direction: column;
                align-items: stretch;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                justify-content: center;
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
            <h1>Ongeza Maendeleo</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('mwenyekiti.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-separator">/</span>
                    <a href="{{ route('mwenyekiti.maendeleo.index') }}">Maendeleo ya Kila Siku</a>
                    <span class="breadcrumb-separator">/</span>
                    <span>Ongeza Maendeleo</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-content">
                        <div class="header-left">
                            <h1 class="page-title">Ongeza Maendeleo ya Siku</h1>
                            <p class="page-subtitle">Ongeza maendeleo yako ya leo au ya siku nyingine</p>
                        </div>
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

                <!-- Form Card -->
                <div class="form-card">
                    <div class="form-header">
                        <h3>
                            <i class="fas fa-chart-line"></i>
                            Taarifa za Maendeleo
                        </h3>
                    </div>

                    <form method="POST" action="{{ route('mwenyekiti.maendeleo.store') }}" id="maendeleo-form">
                        @csrf
                        <div class="form-body">
                            <!-- Tarehe -->
                            <div class="form-group {{ $errors->has('tarehe') ? 'has-error' : '' }}">
                                <label class="form-label required" for="tarehe">Tarehe</label>
                                <input type="date" 
                                       id="tarehe" 
                                       name="tarehe" 
                                       class="form-input" 
                                       value="{{ old('tarehe', date('Y-m-d')) }}"
                                       max="{{ date('Y-m-d') }}"
                                       required>
                                <div class="form-help">Chagua tarehe ya maendeleo (haiwezi kuwa ya baadaye)</div>
                                @if($errors->has('tarehe'))
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('tarehe') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Maelezo -->
                            <div class="form-group {{ $errors->has('maelezo') ? 'has-error' : '' }}">
                                <label class="form-label required" for="maelezo">Maelezo ya Maendeleo</label>
                                <textarea id="maelezo" 
                                          name="maelezo" 
                                          class="form-textarea" 
                                          placeholder="Eleza maendeleo yako ya siku hii..."
                                          required>{{ old('maelezo') }}</textarea>
                                <div class="char-counter" id="maelezo-counter">0/1000 herufi</div>
                                <div class="form-help">Eleza kwa ufupi maendeleo yako ya siku hii (Angalau herufi 10)</div>
                                @if($errors->has('maelezo'))
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('maelezo') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Maoni -->
                            <div class="form-group {{ $errors->has('maoni') ? 'has-error' : '' }}">
                                <label class="form-label" for="maoni">Maoni ya Ziada (Si lazima)</label>
                                <textarea id="maoni" 
                                          name="maoni" 
                                          class="form-textarea" 
                                          placeholder="Ongeza maoni yoyote ya ziada..."
                                          style="min-height: 80px;">{{ old('maoni') }}</textarea>
                                <div class="char-counter" id="maoni-counter">0/500 herufi</div>
                                <div class="form-help">Unaweza kuongeza maoni yoyote ya ziada kuhusu maendeleo haya</div>
                                @if($errors->has('maoni'))
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('maoni') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('mwenyekiti.maendeleo.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Ghairi
                            </a>
                            <button type="submit" class="btn btn-primary" id="submit-btn">
                                <i class="fas fa-save"></i> Hifadhi Maendeleo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
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

            // Character counters
            const maelezoTextarea = document.getElementById('maelezo');
            const maelezoCounter = document.getElementById('maelezo-counter');
            const maoniTextarea = document.getElementById('maoni');
            const maoniCounter = document.getElementById('maoni-counter');
            const submitBtn = document.getElementById('submit-btn');

            // Update character counters
            function updateCharCounter(textarea, counter, maxLength) {
                const currentLength = textarea.value.length;
                counter.textContent = currentLength + '/' + maxLength + ' herufi';
                
                // Color coding
                if (currentLength > maxLength * 0.9) {
                    counter.className = 'char-counter danger';
                } else if (currentLength > maxLength * 0.8) {
                    counter.className = 'char-counter warning';
                } else {
                    counter.className = 'char-counter';
                }
            }

            // Maelezo counter
            if (maelezoTextarea && maelezoCounter) {
                updateCharCounter(maelezoTextarea, maelezoCounter, 1000);
                maelezoTextarea.addEventListener('input', function() {
                    updateCharCounter(this, maelezoCounter, 1000);
                    validateForm();
                });
            }

            // Maoni counter
            if (maoniTextarea && maoniCounter) {
                updateCharCounter(maoniTextarea, maoniCounter, 500);
                maoniTextarea.addEventListener('input', function() {
                    updateCharCounter(this, maoniCounter, 500);
                });
            }

            // Form validation
            function validateForm() {
                const tarehe = document.getElementById('tarehe').value;
                const maelezo = document.getElementById('maelezo').value;
                
                const isValid = tarehe && maelezo.length >= 10 && maelezo.length <= 1000;
                
                if (submitBtn) {
                    submitBtn.disabled = !isValid;
                }
            }

            // Initial validation
            validateForm();

            // Add event listeners for validation
            document.getElementById('tarehe').addEventListener('change', validateForm);
            document.getElementById('maelezo').addEventListener('input', validateForm);

            // Form submission handling
            const form = document.getElementById('maendeleo-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inahifadhiwa...';
                    }
                });
            }
        });
    </script>
</body>
</html>