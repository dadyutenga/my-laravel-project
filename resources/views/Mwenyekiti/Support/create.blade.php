<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omba Msaada | Mwenyekiti Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #4ee546;
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --support-color: #8b5cf6;
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

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--support-color);
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
            background: rgba(139, 92, 246, 0.1);
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
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
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
        .form-textarea,
        .form-select {
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
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--support-color);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
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
        .form-group.has-error .form-textarea,
        .form-group.has-error .form-select {
            border-color: var(--error-color);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* File Upload */
        .file-upload {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 24px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
        }

        .file-upload:hover {
            border-color: var(--support-color);
            background: rgba(139, 92, 246, 0.05);
        }

        .file-upload.dragover {
            border-color: var(--support-color);
            background: rgba(139, 92, 246, 0.1);
        }

        .file-upload-icon {
            font-size: 32px;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .file-upload-text {
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .file-upload-hint {
            font-size: 12px;
            color: var(--text-muted);
        }

        .file-input {
            display: none;
        }

        /* Selected Files */
        .selected-files {
            margin-top: 16px;
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--secondary-color);
            border-radius: var(--radius-md);
            margin-bottom: 8px;
        }

        .file-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            background: var(--support-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .file-info {
            flex: 1;
        }

        .file-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .file-size {
            font-size: 12px;
            color: var(--text-muted);
        }

        .file-remove {
            background: none;
            border: none;
            color: var(--error-color);
            cursor: pointer;
            padding: 4px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .file-remove:hover {
            background: rgba(239, 68, 68, 0.1);
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
            background: var(--support-color);
            color: white;
        }

        .btn-primary:hover {
            background: #7c3aed;
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

            .form-row {
                grid-template-columns: 1fr;
                gap: 12px;
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
            <h1>Omba Msaada</h1>
            <div></div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('mwenyekiti.dashboard') }}">Dashboard</a>
                    <span class="breadcrumb-separator">/</span>
                    <a href="{{ route('mwenyekiti.support.index') }}">Maombi ya Msaada</a>
                    <span class="breadcrumb-separator">/</span>
                    <span>Omba Msaada</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-content">
                        <div class="header-left">
                            <h1 class="page-title">Omba Msaada</h1>
                            <p class="page-subtitle">Omba msaada kutoka kwa timu ya uongozi</p>
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
                            <i class="fas fa-headset"></i>
                            Taarifa za Ombi la Msaada
                        </h3>
                    </div>

                    <form method="POST" action="{{ route('mwenyekiti.support.store') }}" enctype="multipart/form-data" id="support-form">
                        @csrf
                        <div class="form-body">
                            <!-- Basic Information Row -->
                            <div class="form-row">
                                <!-- Category -->
                                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                    <label class="form-label required" for="category">Kategoria ya Ombi</label>
                                    <select id="category" name="category" class="form-select" required>
                                        <option value="">Chagua kategoria...</option>
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-help">Chagua kategoria inayofaa zaidi</div>
                                    @if($errors->has('category'))
                                        <div class="form-error">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $errors->first('category') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Priority -->
                                <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                                    <label class="form-label required" for="priority">Kipaumbele</label>
                                    <select id="priority" name="priority" class="form-select" required>
                                        <option value="">Chagua kipaumbele...</option>
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>
                                            🟢 Chini - Si haraka
                                        </option>
                                        <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>
                                            🟡 Wastani - Kawaida
                                        </option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>
                                            🟠 Juu - Muhimu
                                        </option>
                                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>
                                            🔴 Haraka - Dharura
                                        </option>
                                    </select>
                                    <div class="form-help">Je, ombi lako ni la haraka kiasi gani?</div>
                                    @if($errors->has('priority'))
                                        <div class="form-error">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $errors->first('priority') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label class="form-label required" for="title">Kichwa cha Ombi</label>
                                <input type="text" 
                                       id="title" 
                                       name="title" 
                                       class="form-input" 
                                       placeholder="Kwa ufupi, ombi lako ni kuhusu nini?"
                                       value="{{ old('title') }}"
                                       maxlength="255"
                                       required>
                                <div class="char-counter" id="title-counter">0/255 herufi</div>
                                <div class="form-help">Andika kichwa kifupi na kilichowazi</div>
                                @if($errors->has('title'))
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Description -->
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="form-label required" for="description">Maelezo ya Kina</label>
                                <textarea id="description" 
                                          name="description" 
                                          class="form-textarea" 
                                          placeholder="Eleza tatizo lako kwa undani zaidi..."
                                          maxlength="2000"
                                          style="min-height: 150px;"
                                          required>{{ old('description') }}</textarea>
                                <div class="char-counter" id="description-counter">0/2000 herufi</div>
                                <div class="form-help">Eleza tatizo lako kwa undani ili tuweze kukusaidia vizuri zaidi</div>
                                @if($errors->has('description'))
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>

                            <!-- File Attachments -->
                            <div class="form-group {{ $errors->has('attachments.*') ? 'has-error' : '' }}">
                                <label class="form-label" for="attachments">Faili za Ziada (Si lazima)</label>
                                <div class="file-upload" id="file-upload">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="file-upload-text">Bofya hapa au buruta faili</div>
                                    <div class="file-upload-hint">JPG, PNG, PDF, DOC, DOCX, TXT (Kila faili 5MB)</div>
                                </div>
                                <input type="file" 
                                       id="attachments" 
                                       name="attachments[]" 
                                       class="file-input" 
                                       multiple 
                                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt">
                                <div class="selected-files" id="selected-files"></div>
                                <div class="form-help">Unaweza kupakia hadi faili 5 za kuongeza uelewa</div>
                                @if($errors->has('attachments.*'))
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        @foreach($errors->get('attachments.*') as $error)
                                            {{ implode(', ', $error) }}
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('mwenyekiti.support.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Ghairi
                            </a>
                            <button type="submit" class="btn btn-primary" id="submit-btn">
                                <i class="fas fa-paper-plane"></i> Tuma Ombi
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
            const titleInput = document.getElementById('title');
            const titleCounter = document.getElementById('title-counter');
            const descriptionTextarea = document.getElementById('description');
            const descriptionCounter = document.getElementById('description-counter');
            const submitBtn = document.getElementById('submit-btn');

            // Update character counters
            function updateCharCounter(element, counter, maxLength) {
                const currentLength = element.value.length;
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

            // Title counter
            if (titleInput && titleCounter) {
                updateCharCounter(titleInput, titleCounter, 255);
                titleInput.addEventListener('input', function() {
                    updateCharCounter(this, titleCounter, 255);
                    validateForm();
                });
            }

            // Description counter
            if (descriptionTextarea && descriptionCounter) {
                updateCharCounter(descriptionTextarea, descriptionCounter, 2000);
                descriptionTextarea.addEventListener('input', function() {
                    updateCharCounter(this, descriptionCounter, 2000);
                    validateForm();
                });
            }

            // Form validation
            function validateForm() {
                const category = document.getElementById('category').value;
                const priority = document.getElementById('priority').value;
                const title = document.getElementById('title').value;
                const description = document.getElementById('description').value;
                
                const isValid = category && priority && title.length >= 5 && description.length >= 20;
                
                if (submitBtn) {
                    submitBtn.disabled = !isValid;
                }
            }

            // Add event listeners for validation
            document.getElementById('category').addEventListener('change', validateForm);
            document.getElementById('priority').addEventListener('change', validateForm);

            // File upload functionality
            const fileUpload = document.getElementById('file-upload');
            const fileInput = document.getElementById('attachments');
            const selectedFiles = document.getElementById('selected-files');
            let selectedFilesList = [];

            // Click to select files
            fileUpload.addEventListener('click', function() {
                fileInput.click();
            });

            // Drag and drop
            fileUpload.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            fileUpload.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });

            fileUpload.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                handleFiles(e.dataTransfer.files);
            });

            // File input change
            fileInput.addEventListener('change', function() {
                handleFiles(this.files);
            });

            // Handle selected files
            function handleFiles(files) {
                for (let file of files) {
                    if (selectedFilesList.length >= 5) {
                        alert('Unaweza kupakia hadi faili 5 tu');
                        break;
                    }

                    if (file.size > 5 * 1024 * 1024) {
                        alert('Faili ' + file.name + ' ni kubwa zaidi ya 5MB');
                        continue;
                    }

                    if (!isValidFileType(file)) {
                        alert('Faili ' + file.name + ' si la aina iliyoruhusiwa');
                        continue;
                    }

                    selectedFilesList.push(file);
                }
                displaySelectedFiles();
            }

            // Check valid file types
            function isValidFileType(file) {
                const validTypes = [
                    'image/jpeg', 'image/jpg', 'image/png',
                    'application/pdf',
                    'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'text/plain'
                ];
                return validTypes.includes(file.type);
            }

            // Display selected files
            function displaySelectedFiles() {
                selectedFiles.innerHTML = '';
                
                selectedFilesList.forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';
                    
                    const fileIcon = getFileIcon(file);
                    const fileSize = formatFileSize(file.size);
                    
                    fileItem.innerHTML = `
                        <div class="file-icon">
                            <i class="fas fa-${fileIcon}"></i>
                        </div>
                        <div class="file-info">
                            <div class="file-name">${file.name}</div>
                            <div class="file-size">${fileSize}</div>
                        </div>
                        <button type="button" class="file-remove" onclick="removeFile(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    
                    selectedFiles.appendChild(fileItem);
                });

                // Update file input
                updateFileInput();
            }

            // Get file icon
            function getFileIcon(file) {
                if (file.type.startsWith('image/')) return 'image';
                if (file.type === 'application/pdf') return 'file-pdf';
                if (file.type.includes('word')) return 'file-word';
                if (file.type === 'text/plain') return 'file-alt';
                return 'file';
            }

            // Format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Remove file function (global)
            window.removeFile = function(index) {
                selectedFilesList.splice(index, 1);
                displaySelectedFiles();
            };

            // Update file input with selected files
            function updateFileInput() {
                const dt = new DataTransfer();
                selectedFilesList.forEach(file => dt.items.add(file));
                fileInput.files = dt.files;
            }

            // Form submission handling
            const form = document.getElementById('support-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inatuma...';
                    }
                });
            }

            // Initial validation
            validateForm();
        });
    </script>
</body>
</html>