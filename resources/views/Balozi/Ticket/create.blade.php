<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weka Tiketi Mpya | Prototype System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #3dd73a;
            --primary-light: rgba(78, 229, 70, 0.1);
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

        /* Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Complete Implementation */
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
            border-radius: var(--radius-sm);
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
            font-size: 16px;
            text-align: center;
        }

        .menu-text {
            white-space: nowrap;
            overflow: hidden;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
            width: 0;
        }

        .menu-badge {
            margin-left: auto;
            background-color: var(--primary-color);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-badge {
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

        .header {
            height: var(--header-height);
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            color: var(--border-color);
        }

        .breadcrumb-link {
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-link:hover {
            color: var(--primary-color);
        }

        .breadcrumb-current {
            color: var(--text-color);
        }

        .dashboard-content {
            padding: 30px;
        }

        /* Form Styles */
        .form-container {
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-subtitle {
            font-size: 14px;
            color: var(--text-muted);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row.full-width {
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
            background-color: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-display {
            padding: 12px 16px;
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            text-align: center;
            background-color: var(--secondary-color);
            transition: var(--transition);
            cursor: pointer;
        }

        .file-input-display:hover {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .file-input-display i {
            font-size: 24px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .selected-files {
            margin-top: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background-color: var(--secondary-color);
            border-radius: var(--radius-sm);
            margin-bottom: 4px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-remove {
            color: var(--error-color);
            cursor: pointer;
            padding: 4px;
        }

        .invalid-feedback {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 600;
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

        .btn-secondary:hover {
            background-color: #f3f4f6;
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

        .priority-selector {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .priority-option {
            display: flex;
            align-items: center;
            padding: 12px;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: var(--transition);
            background-color: white;
        }

        .priority-option:hover {
            border-color: var(--primary-color);
        }

        .priority-option.selected {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .priority-option input[type="radio"] {
            display: none;
        }

        .priority-icon {
            margin-right: 8px;
            font-size: 16px;
        }

        .priority-low { color: #10b981; }
        .priority-medium { color: #f59e0b; }
        .priority-high { color: #f97316; }
        .priority-urgent { color: #ef4444; }

        .char-counter {
            font-size: 12px;
            color: var(--text-muted);
            text-align: right;
            margin-top: 4px;
        }

        /* Mobile menu */
        .mobile-menu-toggle {
            display: none;
        }

        /* Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
                transform: translateX(calc(var(--sidebar-collapsed-width) * -1));
            }

            .sidebar.collapsed {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.collapsed ~ .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                right: -30px;
                transform: rotate(180deg);
            }

            .sidebar.collapsed .sidebar-toggle {
                transform: rotate(0);
            }

            .mobile-menu-toggle {
                display: flex;
                margin-right: 15px;
            }

            .dashboard-content {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .priority-selector {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none;
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
                    <div class="mobile-menu-toggle header-action" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1 class="page-title">Weka Tiketi Mpya</h1>
                </div>
                <div class="breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('balozi.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ route('balozi.tickets.index') }}" class="breadcrumb-link">Tiketi</a>
                    </div>
                    <div class="breadcrumb-item">
                        <span class="breadcrumb-current">Weka Mpya</span>
                    </div>
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

                <form action="{{ route('balozi.tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-container">
                        <div class="form-header">
                            <h2 class="form-title">Maelezo ya Tiketi</h2>
                            <p class="form-subtitle">Jaza fomu hii kwa makini ili tuweze kukusaidia vizuri</p>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="subject">Kichwa cha Tatizo *</label>
                                <input type="text" 
                                       id="subject" 
                                       name="subject" 
                                       class="form-control @error('subject') is-invalid @enderror" 
                                       value="{{ old('subject') }}" 
                                       maxlength="255"
                                       required>
                                <div class="char-counter">
                                    <span id="subject-count">0</span>/255 herufi
                                </div>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Aina ya Tatizo *</label>
                                <select id="category" 
                                        name="category" 
                                        class="form-control @error('category') is-invalid @enderror" 
                                        required>
                                    <option value="">Chagua aina ya tatizo</option>
                                    <option value="technical" {{ old('category') == 'technical' ? 'selected' : '' }}>Tatizo la Kiteknolojia</option>
                                    <option value="account" {{ old('category') == 'account' ? 'selected' : '' }}>Tatizo la Akaunti</option>
                                    <option value="data" {{ old('category') == 'data' ? 'selected' : '' }}>Tatizo la Data</option>
                                    <option value="feature" {{ old('category') == 'feature' ? 'selected' : '' }}>Ombi la Kipengele Kipya</option>
                                    <option value="training" {{ old('category') == 'training' ? 'selected' : '' }}>Mafunzo</option>
                                    <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Mengineyo</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row full-width">
                            <div class="form-group">
                                <label for="priority">Kiwango cha Haraka *</label>
                                <div class="priority-selector">
                                    <label class="priority-option {{ old('priority') == 'low' ? 'selected' : '' }}">
                                        <input type="radio" name="priority" value="low" {{ old('priority', 'medium') == 'low' ? 'checked' : '' }}>
                                        <span class="priority-icon priority-low">🟢</span>
                                        <div>
                                            <strong>Chini</strong><br>
                                            <small>Si haraka sana</small>
                                        </div>
                                    </label>
                                    <label class="priority-option {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}">
                                        <input type="radio" name="priority" value="medium" {{ old('priority', 'medium') == 'medium' ? 'checked' : '' }}>
                                        <span class="priority-icon priority-medium">🟡</span>
                                        <div>
                                            <strong>Wastani</strong><br>
                                            <small>Kiwango cha kawaida</small>
                                        </div>
                                    </label>
                                    <label class="priority-option {{ old('priority') == 'high' ? 'selected' : '' }}">
                                        <input type="radio" name="priority" value="high" {{ old('priority') == 'high' ? 'checked' : '' }}>
                                        <span class="priority-icon priority-high">🟠</span>
                                        <div>
                                            <strong>Juu</strong><br>
                                            <small>Inahitaji haraka</small>
                                        </div>
                                    </label>
                                    <label class="priority-option {{ old('priority') == 'urgent' ? 'selected' : '' }}">
                                        <input type="radio" name="priority" value="urgent" {{ old('priority') == 'urgent' ? 'checked' : '' }}>
                                        <span class="priority-icon priority-urgent">🔴</span>
                                        <div>
                                            <strong>Dharura</strong><br>
                                            <small>Inahitaji haraka sana</small>
                                        </div>
                                    </label>
                                </div>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row full-width">
                            <div class="form-group">
                                <label for="description">Maelezo ya Kina ya Tatizo *</label>
                                <textarea id="description" 
                                          name="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="6" 
                                          placeholder="Eleza tatizo lako kwa undani ili tuweze kukusaidia vizuri..."
                                          required>{{ old('description') }}</textarea>
                                <div class="char-counter">
                                    <span id="description-count">0</span> herufi
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row full-width">
                            <div class="form-group">
                                <label for="attachments">Faili za Ziada (Hadi 5)</label>
                                <div class="file-input-wrapper">
                                    <input type="file" 
                                           id="attachments" 
                                           name="attachments[]" 
                                           class="file-input" 
                                           multiple 
                                           accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    <div class="file-input-display">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p><strong>Bofya hapa kupakia faili</strong></p>
                                        <p><small>JPG, PNG, PDF, DOC (Hadi 5MB kila faili)</small></p>
                                    </div>
                                </div>
                                <div class="selected-files" id="selected-files"></div>
                                @error('attachments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('attachments.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('balozi.tickets.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Ghairi
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                Wasilisha Tiketi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>

    <script>
        // Mobile menu toggle functionality
        document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        });

        // Sidebar toggle functionality
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

        // Close sidebar when clicking on overlay
        document.querySelector('.sidebar-overlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('collapsed');
            this.classList.remove('active');
        });

        // Character counters
        function updateCharCount(inputId, countId, maxLength = null) {
            const input = document.getElementById(inputId);
            const counter = document.getElementById(countId);
            
            function updateCount() {
                const count = input.value.length;
                counter.textContent = count;
                
                if (maxLength && count > maxLength * 0.9) {
                    counter.style.color = 'var(--warning-color)';
                } else if (maxLength && count > maxLength * 0.8) {
                    counter.style.color = 'var(--info-color)';
                } else {
                    counter.style.color = 'var(--text-muted)';
                }
            }
            
            input.addEventListener('input', updateCount);
            updateCount(); // Initial count
        }

        updateCharCount('subject', 'subject-count', 255);
        updateCharCount('description', 'description-count');

        // Priority selector
        document.querySelectorAll('.priority-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.priority-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // File upload handler
        const fileInput = document.getElementById('attachments');
        const selectedFilesDiv = document.getElementById('selected-files');
        let selectedFiles = [];

        fileInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            
            // Limit to 5 files
            if (selectedFiles.length + files.length > 5) {
                alert('Unaweza kupakia faili 5 tu kwa pamoja');
                return;
            }
            
            files.forEach(file => {
                // Check file size (5MB limit)
                if (file.size > 5 * 1024 * 1024) {
                    alert(`Faili ${file.name} ni kubwa kuliko 5MB`);
                    return;
                }
                
                selectedFiles.push(file);
                displayFile(file, selectedFiles.length - 1);
            });
            
            updateFileInput();
        });

        function displayFile(file, index) {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            fileItem.innerHTML = `
                <div class="file-info">
                    <i class="fas fa-file"></i>
                    <span>${file.name}</span>
                    <small>(${formatFileSize(file.size)})</small>
                </div>
                <i class="fas fa-times file-remove" onclick="removeFile(${index})"></i>
            `;
            selectedFilesDiv.appendChild(fileItem);
        }

        function removeFile(index) {
            selectedFiles.splice(index, 1);
            selectedFilesDiv.innerHTML = '';
            selectedFiles.forEach((file, i) => displayFile(file, i));
            updateFileInput();
        }

        function updateFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
</body>
</html>