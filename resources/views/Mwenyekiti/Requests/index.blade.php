<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maombi ya Huduma | Mwenyekiti Dashboard</title>
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

        /* Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            position: relative;
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
            max-width: 100%;
            width: 100%;
            margin: 0;
        }

        /* Page Header */
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

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            text-align: center;
            transition: var(--transition);
            border-left: 4px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card.total {
            border-left-color: var(--info-color);
        }

        .stat-card.pending {
            border-left-color: var(--warning-color);
        }

        .stat-card.approved {
            border-left-color: var(--success-color);
        }

        .stat-card.rejected {
            border-left-color: var(--error-color);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 20px;
            color: white;
        }

        .stat-card.total .stat-icon {
            background: var(--info-color);
        }

        .stat-card.pending .stat-icon {
            background: var(--warning-color);
        }

        .stat-card.approved .stat-icon {
            background: var(--success-color);
        }

        .stat-card.rejected .stat-icon {
            background: var(--error-color);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Balozi Selection */
        .balozi-selection {
            background: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .selection-header {
            margin-bottom: 20px;
        }

        .selection-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .balozi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .balozi-card {
            padding: 20px;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
        }

        .balozi-card:hover {
            border-color: var(--primary-color);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .balozi-card.selected {
            border-color: var(--primary-color);
            background: var(--primary-light);
        }

        .balozi-info {
            display: flex;
            align-items: center;
            gap: 12px;
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pending-count {
            background: var(--warning-color);
            color: white;
            padding: 2px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
        }

        /* Service Requests Table */
        .requests-section {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .section-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .bulk-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .table-container {
            overflow-x: auto;
        }

        .requests-table {
            width: 100%;
            border-collapse: collapse;
        }

        .requests-table th,
        .requests-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .requests-table th {
            background: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
        }

        .requests-table td {
            font-size: 14px;
        }

        .requests-table tr:hover {
            background: var(--primary-light);
        }

        /* Status Badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #d1fae5;
            color: #047857;
        }

        .status-rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        /* Action Buttons */
        .btn {
            padding: 8px 16px;
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
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-danger {
            background: var(--error-color);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state h3 {
            margin-bottom: 8px;
            color: var(--text-color);
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

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .content-area {
                padding: 16px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .balozi-grid {
                grid-template-columns: 1fr;
            }

            .header-top {
                flex-direction: column;
                align-items: stretch;
            }

            .bulk-actions {
                flex-direction: column;
                gap: 8px;
            }

            .table-container {
                font-size: 12px;
            }

            .requests-table th,
            .requests-table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Include Shared Sidebar -->
        @include('Mwenyekiti.shared.sidebar-menu')

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-top">
                        <div class="header-left">
                            <h1 class="page-title">Maombi ya Huduma</h1>
                            <p class="page-subtitle">Dhibiti na uangalie maombi yote ya huduma kutoka kwa Balozi wako</p>
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

                <!-- Statistics Grid -->
                <div class="stats-grid">
                    <div class="stat-card total">
                        <div class="stat-icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['total']) }}</div>
                        <div class="stat-label">Jumla ya Maombi</div>
                    </div>

                    <div class="stat-card pending">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['pending']) }}</div>
                        <div class="stat-label">Yanangoja Maamuzi</div>
                    </div>

                    <div class="stat-card approved">
                        <div class="stat-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['approved']) }}</div>
                        <div class="stat-label">Yamekubaliwa</div>
                    </div>

                    <div class="stat-card rejected">
                        <div class="stat-icon">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="stat-number">{{ number_format($stats['rejected']) }}</div>
                        <div class="stat-label">Yamekataliwa</div>
                    </div>
                </div>

                <!-- Balozi Selection -->
                <div class="balozi-selection">
                    <div class="selection-header">
                        <h3 class="selection-title">Chagua Balozi ili Uone Maombi Yake</h3>
                        <p style="color: var(--text-muted); font-size: 14px;">Bofya jina la Balozi ili kuona maombi yake yote ya huduma</p>
                    </div>

                    <div class="balozi-grid">
                        @forelse($balozis as $balozi)
                            <a href="{{ route('mwenyekiti.requests.index', ['balozi_id' => $balozi->id]) }}" 
                               class="balozi-card {{ $selectedBaloziId == $balozi->id ? 'selected' : '' }}">
                                <div class="balozi-info">
                                    <div class="balozi-avatar">
                                        {{ strtoupper(substr($balozi->first_name, 0, 1) . substr($balozi->last_name, 0, 1)) }}
                                    </div>
                                    <div class="balozi-details">
                                        <h4>{{ $balozi->first_name }} {{ $balozi->last_name }}</h4>
                                        <div class="balozi-meta">
                                            <i class="fas fa-phone" style="font-size: 12px;"></i>
                                            {{ $balozi->phone }}
                                            @if($balozi->services_count > 0)
                                                <span class="pending-count">{{ $balozi->services_count }} yanangoja</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h3>Hakuna Balozi</h3>
                                <p>Haujaongeza Balozi yoyote bado</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Service Requests Table -->
                @if($selectedBalozi && $serviceRequests->count() > 0)
                    <div class="requests-section">
                        <div class="section-header">
                            <h3>Maombi ya {{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }}</h3>
                            <div class="bulk-actions">
                                <button class="btn btn-success btn-sm" onclick="bulkUpdateStatus('approved')">
                                    <i class="fas fa-check"></i> Kubali Yaliyochaguliwa
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="bulkUpdateStatus('rejected')">
                                    <i class="fas fa-times"></i> Kataa Yaliyochaguliwa
                                </button>
                            </div>
                        </div>

                        <div class="table-container">
                            <table class="requests-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes()">
                                        </th>
                                        <th>Kichwa cha Ombi</th>
                                        <th>Maelezo</th>
                                        <th>Mtaa</th>
                                        <th>Hali</th>
                                        <th>Tarehe</th>
                                        <th>Vitendo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($serviceRequests as $request)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="request-checkbox" value="{{ $request->id }}">
                                            </td>
                                            <td>
                                                <strong>{{ $request->title ?? $request->title_sw }}</strong>
                                            </td>
                                            <td>
                                                <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ Str::limit($request->description, 100) }}
                                                </div>
                                            </td>
                                            <td>{{ $request->mtaa }}</td>
                                            <td>
                                                <span class="status-badge status-{{ $request->status }}">
                                                    @if($request->status == 'pending')
                                                        Inasubiri
                                                    @elseif($request->status == 'approved')
                                                        Imekubaliwa
                                                    @else
                                                        Imekataliwa
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ $request->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div style="display: flex; gap: 8px;">
                                                    <a href="{{ route('mwenyekiti.requests.show', $request->id) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($request->status == 'pending')
                                                        <button class="btn btn-success btn-sm" 
                                                                onclick="updateSingleStatus({{ $request->id }}, 'approved')">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" 
                                                                onclick="updateSingleStatus({{ $request->id }}, 'rejected')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($serviceRequests->hasPages())
                            <div style="padding: 20px;">
                                {{ $serviceRequests->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                @elseif($selectedBalozi)
                    <div class="requests-section">
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h3>Hakuna Maombi</h3>
                            <p>{{ $selectedBalozi->first_name }} {{ $selectedBalozi->last_name }} hajafanya ombi lolote la huduma bado</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Badilisha Hali ya Ombi</h3>
                <button class="close-modal" onclick="closeModal()">&times;</button>
            </div>
            <form id="statusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Hali Mpya</label>
                    <select name="status" class="form-select" required>
                        <option value="">Chagua hali...</option>
                        <option value="approved">Kubali</option>
                        <option value="rejected">Kataa</option>
                        <option value="pending">Rudisha Kusubiri</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Maelezo ya Ziada (Si Lazima)</label>
                    <textarea name="admin_notes" class="form-textarea" placeholder="Andika maelezo ya uamuzi wako..."></textarea>
                </div>
                <div style="display: flex; gap: 12px; justify-content: end;">
                    <button type="button" class="btn btn-outline" onclick="closeModal()">Ghairi</button>
                    <button type="submit" class="btn btn-primary">Hifadhi Mabadiliko</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('collapsed');
                });
            }
        });

        // Checkbox functionality
        function toggleAllCheckboxes() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.request-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }

        // Get selected request IDs
        function getSelectedRequests() {
            const checkboxes = document.querySelectorAll('.request-checkbox:checked');
            return Array.from(checkboxes).map(cb => cb.value);
        }

        // Update single request status
        function updateSingleStatus(requestId, status) {
            const form = document.getElementById('statusForm');
            form.action = `{{ route('mwenyekiti.requests.index') }}/${requestId}/update-status`;
            form.querySelector('[name="status"]').value = status;
            
            document.getElementById('statusModal').classList.add('show');
        }

        // Bulk update status
        function bulkUpdateStatus(status) {
            const selectedRequests = getSelectedRequests();
            
            if (selectedRequests.length === 0) {
                alert('Tafadhali chagua ombi moja au zaidi');
                return;
            }

            if (confirm(`Je, una uhakika kuwa unataka ku${status === 'approved' ? 'kubali' : 'kataa'} maombi ${selectedRequests.length}?`)) {
                // Create a form for bulk update
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("mwenyekiti.requests.bulk-update") }}';
                
                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                // Add method
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);

                // Add status
                const statusInput = document.createElement('input');
                statusInput.type = 'hidden';
                statusInput.name = 'status';
                statusInput.value = status;
                form.appendChild(statusInput);

                // Add selected request IDs
                selectedRequests.forEach(id => {
                    const idInput = document.createElement('input');
                    idInput.type = 'hidden';
                    idInput.name = 'request_ids[]';
                    idInput.value = id;
                    form.appendChild(idInput);
                });

                document.body.appendChild(form);
                form.submit();
            }
        }

        // Modal functions
        function closeModal() {
            document.getElementById('statusModal').classList.remove('show');
        }

        // Close modal when clicking outside
        document.getElementById('statusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>