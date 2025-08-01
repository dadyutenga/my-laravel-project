<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahitaji Maalumu | Prototype System</title>
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
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background-color: white;
            border-right: 1px solid var(--border-color);
            transition: var(--transition);
            z-index: 1000;
            box-shadow: var(--shadow-sm);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background-color: var(--primary-color);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            transition: var(--transition);
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            padding: 8px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .sidebar-toggle i {
            transition: var(--transition);
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar-menu {
            padding: 20px 0;
            height: calc(100vh - var(--header-height));
            overflow-y: auto;
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .menu-section-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 0 20px;
            margin-bottom: 10px;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-section-title {
            opacity: 0;
            height: 0;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            margin: 2px 0;
        }

        .menu-item:hover {
            background-color: var(--secondary-color);
        }

        .menu-item.active {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background-color: var(--primary-color);
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: inherit;
            flex-shrink: 0;
        }

        .menu-text {
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-height: 100vh;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Header */
        .header {
            height: var(--header-height);
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-color);
            cursor: pointer;
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }

        /* Forms */
        .form-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-md);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
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

        .current-file {
            padding: 10px;
            background-color: var(--secondary-color);
            border-radius: var(--radius-md);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert i {
            font-size: 16px;
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

        /* Buttons */
        .btn {
            padding: 12px 24px;
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

        .btn-sm {
            padding: 8px 16px;
            font-size: 12px;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .dashboard-content {
                padding: 20px;
            }

            .form-container {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .btn-group {
                flex-direction: column;
            }
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Balozi.shared.sidebar-menu')
        
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="header-title">Edit Mahitaji Maalumu</h1>
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

                <div class="form-container">
                    <form action="{{ route('balozi.mahitaji-maalumu.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" 
                                       value="{{ old('first_name', $record->first_name) }}" placeholder="Enter first name" required>
                                @error('first_name')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name" class="form-control" 
                                       value="{{ old('middle_name', $record->middle_name) }}" placeholder="Enter middle name">
                                @error('middle_name')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" 
                                       value="{{ old('last_name', $record->last_name) }}" placeholder="Enter last name" required>
                                @error('last_name')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="age">Age *</label>
                                <input type="number" id="age" name="age" class="form-control" 
                                       value="{{ old('age', $record->age) }}" placeholder="Enter age" min="1" max="120" required>
                                @error('age')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="gender">Gender *</label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $record->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $record->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" class="form-control" 
                                       value="{{ old('phone', $record->phone) }}" placeholder="Enter phone number" required>
                                @error('phone')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nida_number">NIDA Number *</label>
                                <input type="text" id="nida_number" name="nida_number" class="form-control" 
                                       value="{{ old('nida_number', $record->nida_number) }}" placeholder="Enter NIDA number" required>
                                @error('nida_number')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="disability_type">Disability Type *</label>
                                <input type="text" id="disability_type" name="disability_type" class="form-control" 
                                       value="{{ old('disability_type', $record->disability_type) }}" placeholder="Enter disability type" required>
                                @error('disability_type')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pdf_file">Supporting Document (PDF)</label>
                            
                            @if($record->pdf_file_path)
                                <div class="current-file">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>Current file: {{ basename($record->pdf_file_path) }}</span>
                                    <a href="{{ route('balozi.mahitaji-maalumu.download-pdf', $record->id) }}" 
                                       class="btn btn-sm btn-secondary" style="margin-left: auto;">
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>
                                </div>
                            @endif

                            <div class="file-upload-area" onclick="document.getElementById('pdf_file').click()">
                                <input type="file" id="pdf_file" name="pdf_file" class="form-control" 
                                       accept=".pdf" style="display: none;">
                                <div class="file-upload-text">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 24px; margin-bottom: 8px;"></i>
                                    <p id="file-upload-text">{{ $record->pdf_file_path ? 'Click to replace current PDF file' : 'Click to upload PDF file or drag and drop' }}</p>
                                    <small>Maximum file size: 10MB</small>
                                </div>
                            </div>
                            @error('pdf_file')
                                <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Update Record
                            </button>
                            <a href="{{ route('balozi.mahitaji-maalumu.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>

    <script>
        // File input change handler
        document.getElementById('pdf_file').addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            const textElement = document.getElementById('file-upload-text');
            if (fileName) {
                textElement.textContent = `Selected: ${fileName}`;
            } else {
                textElement.textContent = '{{ $record->pdf_file_path ? "Click to replace current PDF file" : "Click to upload PDF file or drag and drop" }}';
            }
        });

        // Mobile menu toggle functionality
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar?.classList.toggle('mobile-open');
            overlay?.classList.toggle('active');
        });

        // Close sidebar when clicking overlay
        document.querySelector('.sidebar-overlay')?.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar?.classList.remove('mobile-open');
            overlay?.classList.remove('active');
        });
    </script>
</body>
</html>