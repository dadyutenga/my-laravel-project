<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Meeting Request | Prototype System</title>
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
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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

        /* Complete Sidebar Styles */
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

        .dashboard-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
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
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 5px;
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

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
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

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: var(--radius-md);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .status-badge.approved {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-badge.rejected {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .text-danger {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 4px;
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

        /* Mobile Responsiveness */
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

            .detail-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .btn-group {
                flex-direction: column;
            }
        }

        /* Sidebar Overlay for Mobile */
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

        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('Mwenyekiti.shared.sidebar-menu')
        <div class="main-content">
            <div class="dashboard-content">
                <h2 class="dashboard-title">Process Meeting Request</h2>

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

                <!-- Request Details -->
                <div class="form-container">
                    <h3 class="section-title">Request Information</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">Request ID:</div>
                        <div class="detail-value">#MTG-{{ str_pad($meetingRequest->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Current Status:</div>
                        <div class="detail-value">
                            <span class="status-badge {{ $meetingRequest->status }}">
                                {{ ucfirst($meetingRequest->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Requested Date:</div>
                        <div class="detail-value">{{ $meetingRequest->requested_at ? $meetingRequest->requested_at->format('d/m/Y H:i') : 'N/A' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Request Details:</div>
                        <div class="detail-value">{{ $meetingRequest->request_details }}</div>
                    </div>

                    @if($meetingRequest->processed_at)
                    <div class="detail-row">
                        <div class="detail-label">Processed Date:</div>
                        <div class="detail-value">{{ $meetingRequest->processed_at->format('d/m/Y H:i') }}</div>
                    </div>
                    @endif

                    @if($meetingRequest->admin_comments)
                    <div class="detail-row">
                        <div class="detail-label">Previous Comments:</div>
                        <div class="detail-value">{{ $meetingRequest->admin_comments }}</div>
                    </div>
                    @endif
                </div>

                <!-- Balozi Information -->
                <div class="form-container">
                    <h3 class="section-title">Balozi Information</h3>
                    
                    <div class="detail-row">
                        <div class="detail-label">Full Name:</div>
                        <div class="detail-value">{{ $meetingRequest->balozi->first_name }} {{ $meetingRequest->balozi->middle_name }} {{ $meetingRequest->balozi->last_name }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Phone Number:</div>
                        <div class="detail-value">{{ $meetingRequest->balozi->phone }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">{{ $meetingRequest->balozi->email ?? 'N/A' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Street/Village:</div>
                        <div class="detail-value">{{ $meetingRequest->balozi->street_village ?? 'N/A' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Shina:</div>
                        <div class="detail-value">{{ $meetingRequest->balozi->shina ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Process Request Form -->
                <div class="form-container">
                    <h3 class="section-title">Update Request Status</h3>
                    
                    <form action="{{ route('mwenyekiti.meeting-requests.update-status', $meetingRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="status">Update Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="">Choose action...</option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>
                                    ✅ Approve Request
                                </option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>
                                    ❌ Reject Request
                                </option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                    ⏳ Keep Pending
                                </option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="admin_comments">Comments & Instructions</label>
                            <textarea id="admin_comments" name="admin_comments" class="form-control" rows="4" 
                                      placeholder="Add your comments and instructions for the Balozi..." required>{{ old('admin_comments') }}</textarea>
                            <small style="color: var(--text-muted);">
                                Example instructions: Meeting approved for next Wednesday at 2 PM. Please prepare agenda and notify all members.
                            </small>
                            @error('admin_comments')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i>
                                Update Request
                            </button>
                            <a href="{{ route('mwenyekiti.meeting-requests.index') }}" class="btn btn-secondary">
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