<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badili Tiketi #{{ $ticket->ticket_number }} | Prototype System</title>
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
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
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
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin: 0 8px;
            color: var(--text-muted);
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
            font-weight: 500;
        }

        .dashboard-content {
            padding: 30px;
        }

        .form-container {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .form-header {
            padding: 30px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-subtitle {
            font-size: 16px;
            opacity: 0.9;
        }

        .form-content {
            padding: 30px;
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
            gap: 8px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
        }

        .form-control {
            padding: 12px 16px;
            border: 2px solid var(--border-color);
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

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        select.form-control {
            cursor: pointer;
        }

        .file-input {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 30px;
            text-align: center;
            background: var(--secondary-color);
            transition: var(--transition);
            cursor: pointer;
        }

        .file-input:hover {
            border-color: var(--primary-color);
            background: var(--primary-light);
        }

        .file-input input[type="file"] {
            display: none;
        }

        .file-input-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .file-input-icon {
            font-size: 48px;
            color: var(--text-muted);
        }

        .existing-attachments {
            background: var(--secondary-color);
            padding: 20px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
        }

        .attachment-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background: white;
            border-radius: var(--radius-sm);
            margin-bottom: 10px;
        }

        .attachment-item:last-child {
            margin-bottom: 0;
        }

        .attachment-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .attachment-icon {
            font-size: 20px;
            color: var(--primary-color);
        }

        .remove-attachment {
            background: var(--error-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
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

        .form-actions {
            display: flex;
            gap: 15px;
            padding: 30px;
            border-top: 1px solid var(--border-color);
            background: var(--secondary-color);
        }

        .char-counter {
            font-size: 12px;
            color: var(--text-muted);
            text-align: right;
            margin-top: 5px;
        }

        .alert {
            padding: 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .dashboard-content {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
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
                    <h1 class="page-title">Badili Tiketi</h1>
                    <nav class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('balozi.tickets.index') }}" class="breadcrumb-link">Tiketi</a>
                        </div>
                        <div class="breadcrumb-item">
                            <a href="{{ route('balozi.tickets.show', $ticket->id) }}" class="breadcrumb-link">#{{ $ticket->ticket_number }}</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">Badili</span>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="dashboard-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <strong>Kuna makosa yafuatayo:</strong>
                            <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('balozi.tickets.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-container">
                        <div class="form-header">
                            <h2 class="form-title">Badili Tiketi #{{ $ticket->ticket_number }}</h2>
                            <p class="form-subtitle">Badilisha maelezo ya tiketi yako ya msaada</p>
                        </div>

                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="subject">Kichwa cha Tiketi</label>
                                    <input type="text" 
                                           id="subject" 
                                           name="subject" 
                                           class="form-control" 
                                           value="{{ old('subject', $ticket->subject) }}" 
                                           required 
                                           maxlength="255">
                                    <div class="char-counter">
                                        <span id="subject-count">{{ strlen($ticket->subject) }}</span>/255 herufi
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="priority">Kipaumbele</label>
                                    <select id="priority" name="priority" class="form-control" required>
                                        <option value="low" {{ old('priority', $ticket->priority) === 'low' ? 'selected' : '' }}>🟢 Chini</option>
                                        <option value="medium" {{ old('priority', $ticket->priority) === 'medium' ? 'selected' : '' }}>🟡 Wastani</option>
                                        <option value="high" {{ old('priority', $ticket->priority) === 'high' ? 'selected' : '' }}>🟠 Juu</option>
                                        <option value="urgent" {{ old('priority', $ticket->priority) === 'urgent' ? 'selected' : '' }}>🔴 Dharura</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row full-width">
                                <div class="form-group">
                                    <label for="description">Maelezo ya Tatizo</label>
                                    <textarea id="description" 
                                              name="description" 
                                              class="form-control" 
                                              required 
                                              maxlength="2000" 
                                              rows="8" 
                                              placeholder="Eleza tatizo lako kwa undani...">{{ old('description', $ticket->description) }}</textarea>
                                    <div class="char-counter">
                                        <span id="description-count">{{ strlen($ticket->description) }}</span>/2000 herufi
                                    </div>
                                </div>
                            </div>

                            @if($ticket->attachments && count(json_decode($ticket->attachments, true)) > 0)
                                <div class="form-row full-width">
                                    <div class="form-group">
                                        <label>Faili Zilizopo</label>
                                        <div class="existing-attachments">
                                            @foreach(json_decode($ticket->attachments, true) as $index => $attachment)
                                                <div class="attachment-item">
                                                    <div class="attachment-info">
                                                        <i class="fas fa-file attachment-icon"></i>
                                                        <span>{{ $attachment['original_name'] }}</span>
                                                        <small>({{ number_format($attachment['size'] / 1024, 1) }} KB)</small>
                                                    </div>
                                                    <a href="{{ route('balozi.tickets.download-attachment', [$ticket->id, $index]) }}" 
                                                       class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-row full-width">
                                <div class="form-group">
                                    <label for="attachments">Ongeza Faili Mpya (Hiari)</label>
                                    <div class="file-input" onclick="document.getElementById('attachments').click()">
                                        <input type="file" 
                                               id="attachments" 
                                               name="attachments[]" 
                                               multiple 
                                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                        <div class="file-input-text">
                                            <i class="fas fa-cloud-upload-alt file-input-icon"></i>
                                            <div>
                                                <strong>Bofya hapa kuongeza faili</strong>
                                                <p>au buruta faili hapa</p>
                                            </div>
                                            <small>PDF, DOC, JPG, PNG, ZIP (Kima cha juu: 10MB kwa kila faili)</small>
                                        </div>
                                    </div>
                                    <div id="selected-files"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Sasisha Tiketi
                            </button>
                            <a href="{{ route('balozi.tickets.show', $ticket->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Ghairi
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Character counters
        function setupCharCounter(inputId, counterId, maxLength) {
            const input = document.getElementById(inputId);
            const counter = document.getElementById(counterId);
            
            input.addEventListener('input', function() {
                const currentLength = this.value.length;
                counter.textContent = currentLength;
                
                if (currentLength > maxLength * 0.9) {
                    counter.style.color = 'var(--error-color)';
                } else if (currentLength > maxLength * 0.7) {
                    counter.style.color = 'var(--warning-color)';
                } else {
                    counter.style.color = 'var(--text-muted)';
                }
            });
        }

        setupCharCounter('subject', 'subject-count', 255);
        setupCharCounter('description', 'description-count', 2000);

        // File input handling
        document.getElementById('attachments').addEventListener('change', function() {
            const files = this.files;
            const selectedFilesDiv = document.getElementById('selected-files');
            
            if (files.length > 0) {
                let filesHtml = '<div style="margin-top: 15px;"><strong>Faili zilizochaguliwa:</strong><ul>';
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const fileSize = (file.size / 1024 / 1024).toFixed(2);
                    filesHtml += `<li>${file.name} (${fileSize} MB)</li>`;
                }
                filesHtml += '</ul></div>';
                selectedFilesDiv.innerHTML = filesHtml;
            } else {
                selectedFilesDiv.innerHTML = '';
            }
        });

        // Drag and drop functionality
        const fileInput = document.querySelector('.file-input');
        
        fileInput.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = 'var(--primary-color)';
            this.style.background = 'var(--primary-light)';
        });
        
        fileInput.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = 'var(--border-color)';
            this.style.background = 'var(--secondary-color)';
        });
        
        fileInput.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = 'var(--border-color)';
            this.style.background = 'var(--secondary-color)';
            
            const files = e.dataTransfer.files;
            document.getElementById('attachments').files = files;
            
            // Trigger change event
            const event = new Event('change', { bubbles: true });
            document.getElementById('attachments').dispatchEvent(event);
        });
    </script>
</body>
</html>