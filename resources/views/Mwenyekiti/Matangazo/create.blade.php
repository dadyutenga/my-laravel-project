<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement | Prototype System</title>
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
            --error-color: #ef4444;
            --success-color: #10b981;
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
                    <h2 class="dashboard-title">Create New Announcement</h2>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="form-container">
                    <form action="{{ route('mwenyekiti.matangazo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Announcement Type Selection -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-layer-group"></i>
                                Select Announcement Type
                            </h3>
                            
                            <div class="announcement-type-selector">
                                <div class="type-card" onclick="selectType('general')">
                                    <div class="type-icon">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <div class="type-title">General Announcement</div>
                                    <div class="type-description">
                                        Create announcements for community updates, events, notices, and general information
                                    </div>
                                </div>

                                <div class="type-card" onclick="selectType('meeting')">
                                    <div class="type-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="type-title">Meeting Announcement</div>
                                    <div class="type-description">
                                        Create announcements specifically for upcoming meetings and gatherings
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="announcement_type" id="announcement_type" value="{{ old('announcement_type', 'general') }}">
                        </div>

                        <!-- Basic Information -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Basic Information
                            </h3>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="title">Title (English) *</label>
                                    <input type="text" id="title" name="title" class="form-control" 
                                           value="{{ old('title') }}" placeholder="e.g., Community Health Campaign" required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title_sw">Kichwa (Kiswahili) *</label>
                                    <input type="text" id="title_sw" name="title_sw" class="form-control" 
                                           value="{{ old('title_sw') }}" placeholder="mfano: Kampeni ya Afya ya Jamii" required>
                                    @error('title_sw')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mtaa">Mtaa/Location *</label>
                                    <input type="text" id="mtaa" name="mtaa" class="form-control" 
                                           value="{{ old('mtaa') }}" placeholder="e.g., Mtaa wa Amani" required>
                                    @error('mtaa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Meeting Selection (for meeting announcements) -->
                                <div class="form-group meeting-fields conditional-fields">
                                    <label for="mtaa_meeting_id">Select Meeting *</label>
                                    <select id="mtaa_meeting_id" name="mtaa_meeting_id" class="form-control">
                                        <option value="">Choose a meeting...</option>
                                        @foreach($availableMeetings as $meeting)
                                            <option value="{{ $meeting->id }}" {{ old('mtaa_meeting_id') == $meeting->id ? 'selected' : '' }}>
                                                {{ $meeting->title }} - {{ $meeting->meeting_date->format('d/m/Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mtaa_meeting_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group full-width">
                                <label for="content">Content (English) *</label>
                                <textarea id="content" name="content" class="form-control" rows="6" 
                                          placeholder="Enter the detailed announcement content..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group full-width">
                                <label for="content_sw">Maudhui (Kiswahili)</label>
                                <textarea id="content_sw" name="content_sw" class="form-control" rows="6" 
                                          placeholder="Ingiza maudhui ya tangazo kwa Kiswahili...">{{ old('content_sw') }}</textarea>
                                <span class="help-text">Optional: Add content in Kiswahili for better community reach</span>
                                @error('content_sw')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- General Announcement Settings -->
                        <div class="form-section general-fields conditional-fields show">
                            <h3 class="section-title">
                                <i class="fas fa-cog"></i>
                                Announcement Settings
                            </h3>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="category">Category *</label>
                                    <select id="category" name="category" class="form-control">
                                        <option value="">Select category...</option>
                                        <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General</option>
                                        <option value="emergency" {{ old('category') == 'emergency' ? 'selected' : '' }}>Emergency</option>
                                        <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Event</option>
                                        <option value="notice" {{ old('category') == 'notice' ? 'selected' : '' }}>Notice</option>
                                        <option value="health" {{ old('category') == 'health' ? 'selected' : '' }}>Health</option>
                                        <option value="security" {{ old('category') == 'security' ? 'selected' : '' }}>Security</option>
                                        <option value="infrastructure" {{ old('category') == 'infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                                        <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>Education</option>
                                        <option value="environment" {{ old('category') == 'environment' ? 'selected' : '' }}>Environment</option>
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="priority">Priority Level *</label>
                                    <select id="priority" name="priority" class="form-control">
                                        <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    </select>
                                    @error('priority')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="target_audience">Target Audience *</label>
                                    <select id="target_audience" name="target_audience" class="form-control">
                                        <option value="all" {{ old('target_audience') == 'all' ? 'selected' : '' }}>All Community</option>
                                        <option value="balozi" {{ old('target_audience') == 'balozi' ? 'selected' : '' }}>Balozi Only</option>
                                        <option value="residents" {{ old('target_audience') == 'residents' ? 'selected' : '' }}>Residents Only</option>
                                        <option value="youth" {{ old('target_audience') == 'youth' ? 'selected' : '' }}>Youth</option>
                                        <option value="elders" {{ old('target_audience') == 'elders' ? 'selected' : '' }}>Elders</option>
                                        <option value="women" {{ old('target_audience') == 'women' ? 'selected' : '' }}>Women Groups</option>
                                    </select>
                                    @error('target_audience')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="effective_date">Effective Date</label>
                                    <input type="date" id="effective_date" name="effective_date" class="form-control" 
                                           value="{{ old('effective_date') }}" min="{{ date('Y-m-d') }}">
                                    <span class="help-text">When should this announcement become active?</span>
                                    @error('effective_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group full-width">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="date" id="expiry_date" name="expiry_date" class="form-control" 
                                           value="{{ old('expiry_date') }}" min="{{ date('Y-m-d') }}">
                                    <span class="help-text">When should this announcement expire? Leave empty for no expiry.</span>
                                    @error('expiry_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Options -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-sliders-h"></i>
                                Additional Options
                            </h3>
                            
                            <div class="form-grid">
                                <div class="form-group general-fields conditional-fields show">
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="is_featured" name="is_featured" value="1" 
                                               {{ old('is_featured') ? 'checked' : '' }}>
                                        <label for="is_featured">Featured Announcement</label>
                                    </div>
                                    <span class="help-text">Featured announcements appear at the top of the list</span>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="send_notification" name="send_notification" value="1" 
                                               {{ old('send_notification', true) ? 'checked' : '' }}>
                                        <label for="send_notification">Send Notifications</label>
                                    </div>
                                    <span class="help-text">Notify community members about this announcement</span>
                                </div>

                                <div class="form-group full-width">
                                    <label for="attachments">Attachments</label>
                                    <input type="file" id="attachments" name="attachments[]" class="form-control form-control-file" 
                                           multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    <span class="help-text">You can attach PDF, images, or documents (max 5MB each)</span>
                                    @error('attachments.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Create Announcement
                            </button>
                            <a href="{{ route('mwenyekiti.matangazo.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay"></div>

    <script>
        function selectType(type) {
            // Remove selected class from all type cards
            document.querySelectorAll('.type-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            event.currentTarget.classList.add('selected');
            
            // Update hidden input
            document.getElementById('announcement_type').value = type;
            
            // Show/hide conditional fields
            const generalFields = document.querySelectorAll('.general-fields');
            const meetingFields = document.querySelectorAll('.meeting-fields');
            
            if (type === 'general') {
                generalFields.forEach(field => {
                    field.classList.add('show');
                });
                meetingFields.forEach(field => {
                    field.classList.remove('show');
                });
            } else {
                generalFields.forEach(field => {
                    field.classList.remove('show');
                });
                meetingFields.forEach(field => {
                    field.classList.add('show');
                });
            }
        }

        // Initialize form based on old input or default
        document.addEventListener('DOMContentLoaded', function() {
            const currentType = document.getElementById('announcement_type').value || 'general';
            
            // Find and click the appropriate type card
            const cards = document.querySelectorAll('.type-card');
            cards.forEach((card, index) => {
                if ((currentType === 'general' && index === 0) || (currentType === 'meeting' && index === 1)) {
                    card.click();
                }
            });
        });

        // Sidebar toggle functionality
        document.querySelector('.sidebar-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

        // Close sidebar when clicking on overlay
        document.querySelector('.sidebar-overlay')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('collapsed');
            this.classList.remove('active');
        });

        // File upload preview
        document.getElementById('attachments').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const fileList = files.map(file => `${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`).join(', ');
            
            if (fileList) {
                const helpText = e.target.nextElementSibling;
                helpText.textContent = `Selected files: ${fileList}`;
                helpText.style.color = 'var(--success-color)';
            }
        });
    </script>
</body>
</html>