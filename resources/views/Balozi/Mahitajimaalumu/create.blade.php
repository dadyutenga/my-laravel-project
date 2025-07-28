<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Mahitaji Maalumu | Prototype System</title>
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
            min-height: 100vh;
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

        .dashboard-content {
            padding: 30px;
        }

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

        .form-control::placeholder {
            color: var(--text-muted);
        }

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

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            text-align: center;
            transition: var(--transition);
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .file-upload-text {
            color: var(--text-muted);
            font-size: 14px;
        }

        @media (max-width: 768px) {
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
                    <h1 class="header-title">Create Mahitaji Maalumu</h1>
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
                    <form action="{{ route('balozi.mahitaji-maalumu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" 
                                       value="{{ old('first_name') }}" placeholder="Enter first name" required>
                                @error('first_name')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name" class="form-control" 
                                       value="{{ old('middle_name') }}" placeholder="Enter middle name">
                                @error('middle_name')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" 
                                       value="{{ old('last_name') }}" placeholder="Enter last name" required>
                                @error('last_name')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="age">Age *</label>
                                <input type="number" id="age" name="age" class="form-control" 
                                       value="{{ old('age') }}" placeholder="Enter age" min="1" max="120" required>
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
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" class="form-control" 
                                       value="{{ old('phone') }}" placeholder="Enter phone number" required>
                                @error('phone')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nida_number">NIDA Number *</label>
                                <input type="text" id="nida_number" name="nida_number" class="form-control" 
                                       value="{{ old('nida_number') }}" placeholder="Enter NIDA number" required>
                                @error('nida_number')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="disability_type">Disability Type *</label>
                                <input type="text" id="disability_type" name="disability_type" class="form-control" 
                                       value="{{ old('disability_type') }}" placeholder="Enter disability type" required>
                                @error('disability_type')
                                    <span style="color: var(--error-color); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pdf_file">Supporting Document (PDF)</label>
                            <div class="file-upload-area">
                                <input type="file" id="pdf_file" name="pdf_file" class="form-control" 
                                       accept=".pdf" style="display: none;">
                                <div class="file-upload-text">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 24px; margin-bottom: 8px;"></i>
                                    <p>Click to upload PDF file or drag and drop</p>
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
                                Create Record
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

    <script>
        // File upload click handler
        document.querySelector('.file-upload-area').addEventListener('click', function() {
            document.getElementById('pdf_file').click();
        });

        // File input change handler
        document.getElementById('pdf_file').addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            if (fileName) {
                document.querySelector('.file-upload-text p').textContent = fileName;
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar')?.classList.toggle('mobile-open');
        });
    </script>
</body>
</html>