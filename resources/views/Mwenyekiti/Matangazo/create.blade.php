<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tengeneza Tangazo | Prototype System</title>
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

        .form-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            max-width: 900px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .announcement-type-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .type-card {
            border: 2px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 25px;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            position: relative;
        }

        .type-card:hover {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .type-card.selected {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .type-card.selected::after {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 15px;
            color: var(--primary-color);
            font-size: 18px;
        }

        .type-icon {
            font-size: 36px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .type-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .type-description {
            color: var(--text-muted);
            font-size: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .form-control-file {
            padding: 8px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
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

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .alert {
            padding: 12px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .text-danger {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 4px;
        }

        .help-text {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .conditional-fields {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .conditional-fields.show {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }

            .announcement-type-selector {
                grid-template-columns: 1fr;
            }

            .sidebar {
                width: var(--sidebar-collapsed-width);
                transform: translateX(calc(var(--sidebar-collapsed-width) * -1));
            }

            .main-content {
                margin-left: 0;
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
                    <h2 class="dashboard-title">Tengeneza Tangazo Jipya</h2>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Announcement Type Selection -->
                <div class="section-title">Chagua Aina ya Tangazo</div>
                <div class="announcement-type-selector">
                    <div class="type-card" data-type="general" onclick="selectType('general')">
                        <div class="type-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="type-title">Tangazo la Kawaida</div>
                        <div class="type-description">Tangazo la kawaida kwa jamii</div>
                    </div>

                    <div class="type-card" data-type="meeting" onclick="selectType('meeting')">
                        <div class="type-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="type-title">Tangazo la Mkutano</div>
                        <div class="type-description">Tangazo linalohusiana na mkutano</div>
                    </div>
                </div>

                <form id="announcementForm" action="{{ route('mwenyekiti.matangazo.store') }}" method="POST" enctype="multipart/form-data" class="form-grid">
                    @csrf
                    <input type="hidden" name="announcement_type" id="announcement_type" value="general">

                    <!-- Basic Information -->
                    <div class="section-title">Taarifa za Msingi</div>
                    
                    <div class="form-group full-width">
                        <label for="title">Kichwa (Kiingereza)</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="title_sw">Kichwa (Kiswahili)</label>
                        <input type="text" id="title_sw" name="title_sw" value="{{ old('title_sw') }}" required>
                        @error('title_sw')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mtaa">Mtaa/Eneo</label>
                        <select id="mtaa" name="mtaa" required>
                            <option value="">Chagua Mtaa</option>
                            @foreach($mitaa as $mtaa)
                                <option value="{{ $mtaa->id }}" {{ old('mtaa') == $mtaa->id ? 'selected' : '' }}>
                                    {{ $mtaa->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('mtaa')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group conditional-fields" id="meeting-fields" style="display: none;">
                        <label for="meeting_id">Chagua Mkutano</label>
                        <select id="meeting_id" name="meeting_id">
                            <option value="">Chagua Mkutano</option>
                            @foreach($meetings as $meeting)
                                <option value="{{ $meeting->id }}" {{ old('meeting_id') == $meeting->id ? 'selected' : '' }}>
                                    {{ $meeting->title }} - {{ $meeting->meeting_date->format('d/m/Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('meeting_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="content">Maudhui (Kiingereza)</label>
                        <textarea id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="content_sw">Maudhui (Kiswahili)</label>
                        <textarea id="content_sw" name="content_sw" rows="5" required>{{ old('content_sw') }}</textarea>
                        @error('content_sw')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Announcement Settings -->
                    <div class="section-title">Mipangilio ya Tangazo</div>

                    <div class="form-group">
                        <label for="category">Kategoria</label>
                        <select id="category" name="category" required>
                            <option value="">Chagua Kategoria</option>
                            <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>Kawaida</option>
                            <option value="emergency" {{ old('category') == 'emergency' ? 'selected' : '' }}>Dharura</option>
                            <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Tukio</option>
                            <option value="notice" {{ old('category') == 'notice' ? 'selected' : '' }}>Taarifa</option>
                        </select>
                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="priority">Kiwango cha Umuhimu</label>
                        <select id="priority" name="priority" required>
                            <option value="">Chagua Kiwango</option>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Chini</option>
                            <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Kawaida</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Juu</option>
                            <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Haraka</option>
                        </select>
                        @error('priority')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="target_audience">Walengwa</label>
                        <select id="target_audience" name="target_audience" required>
                            <option value="">Chagua Walengwa</option>
                            <option value="all" {{ old('target_audience') == 'all' ? 'selected' : '' }}>Wote</option>
                            <option value="residents" {{ old('target_audience') == 'residents' ? 'selected' : '' }}>Wakazi</option>
                            <option value="leaders" {{ old('target_audience') == 'leaders' ? 'selected' : '' }}>Viongozi</option>
                            <option value="youth" {{ old('target_audience') == 'youth' ? 'selected' : '' }}>Vijana</option>
                            <option value="women" {{ old('target_audience') == 'women' ? 'selected' : '' }}>Wanawake</option>
                            <option value="elderly" {{ old('target_audience') == 'elderly' ? 'selected' : '' }}>Wazee</option>
                        </select>
                        @error('target_audience')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="effective_date">Tarehe ya Kuanza</label>
                        <input type="date" id="effective_date" name="effective_date" value="{{ old('effective_date') }}" required>
                        @error('effective_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="expiry_date">Tarehe ya Kuisha</label>
                        <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" required>
                        @error('expiry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Additional Options -->
                    <div class="section-title">Chaguo za Ziada</div>

                    <div class="form-group full-width">
                        <div class="checkbox-group">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label for="is_featured">Tangazo Muhimu</label>
                            <span class="help-text">Weka alama kama hili ni tangazo muhimu litakalopewa kipaumbele</span>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <div class="checkbox-group">
                            <input type="checkbox" id="send_notifications" name="send_notifications" value="1" {{ old('send_notifications') ? 'checked' : '' }}>
                            <label for="send_notifications">Tuma Taarifa</label>
                            <span class="help-text">Tuma taarifa kwa walengwa kupitia SMS na barua pepe</span>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="attachments">Viambatanisho</label>
                        <input type="file" id="attachments" name="attachments[]" multiple class="form-control-file">
                        <span class="help-text">Unaweza kuambatanisha faili nyingi (PDF, DOC, XLS, JPG, PNG)</span>
                        @error('attachments.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="btn-group full-width">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Tengeneza Tangazo
                        </button>
                        <a href="{{ route('mwenyekiti.matangazo.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Rudi Kwenye Orodha
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay"></div>

    <script>
        function selectType(type) {
            // Remove selected class from all cards
            document.querySelectorAll('.type-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            document.querySelector(`.type-card[data-type="${type}"]`).classList.add('selected');
            
            // Update hidden input value
            document.getElementById('announcement_type').value = type;
            
            // Show/hide meeting fields
            const meetingFields = document.getElementById('meeting-fields');
            if (type === 'meeting') {
                meetingFields.style.display = 'block';
                document.getElementById('meeting_id').required = true;
            } else {
                meetingFields.style.display = 'none';
                document.getElementById('meeting_id').required = false;
            }
        }

        // File input preview functionality
        document.getElementById('attachments').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const previewContainer = document.createElement('div');
            previewContainer.classList.add('file-preview');
            
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('div');
                    preview.classList.add('preview-item');
                    
                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        preview.appendChild(img);
                    } else {
                        const icon = document.createElement('i');
                        icon.classList.add('fas', 'fa-file');
                        preview.appendChild(icon);
                    }
                    
                    const fileName = document.createElement('span');
                    fileName.textContent = file.name;
                    preview.appendChild(fileName);
                    
                    previewContainer.appendChild(preview);
                }
                reader.readAsDataURL(file);
            });
            
            const existingPreview = this.parentElement.querySelector('.file-preview');
            if (existingPreview) {
                existingPreview.remove();
            }
            this.parentElement.appendChild(previewContainer);
        });
    </script>
</body>
</html>