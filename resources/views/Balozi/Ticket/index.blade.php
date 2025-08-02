
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiketi za Msaada | Prototype System</title>
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

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .dashboard-content {
            padding: 30px;
        }

        .filters-container {
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            padding: 24px;
            margin-bottom: 24px;
        }

        .filters-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 16px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 6px;
            font-size: 14px;
        }

        .form-control {
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .btn {
            padding: 10px 20px;
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

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .tickets-container {
            background-color: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .tickets-header {
            padding: 24px 30px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tickets-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .tickets-stats {
            display: flex;
            gap: 20px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .ticket-card {
            border-bottom: 1px solid var(--border-color);
            padding: 20px 30px;
            transition: var(--transition);
        }

        .ticket-card:hover {
            background-color: var(--secondary-color);
        }

        .ticket-card:last-child {
            border-bottom: none;
        }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .ticket-title-section {
            flex: 1;
        }

        .ticket-number {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .ticket-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
            margin: 4px 0;
            line-height: 1.4;
        }

        .ticket-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .ticket-badges {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-status-open { background-color: #dbeafe; color: #1e40af; }
        .badge-status-in_progress { background-color: #fef3c7; color: #92400e; }
        .badge-status-resolved { background-color: #d1fae5; color: #065f46; }
        .badge-status-closed { background-color: #f3f4f6; color: #4b5563; }

        .priority-badge {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 11px;
            font-weight: 600;
        }

        .priority-low { background-color: #ecfdf5; color: #065f46; }
        .priority-medium { background-color: #fffbeb; color: #92400e; }
        .priority-high { background-color: #fff7ed; color: #9a3412; }
        .priority-urgent { background-color: #fef2f2; color: #991b1b; }

        .ticket-description {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ticket-actions {
            display: flex;
            gap: 8px;
        }

        .btn-view {
            background-color: var(--info-color);
            color: white;
        }

        .btn-edit {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-delete {
            background-color: var(--error-color);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--border-color);
        }

        .pagination-wrapper {
            padding: 20px 30px;
            border-top: 1px solid var(--border-color);
            background-color: var(--secondary-color);
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

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .dashboard-content {
                padding: 20px;
            }

            .filters-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .ticket-header {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .ticket-badges {
                flex-wrap: wrap;
            }

            .ticket-actions {
                width: 100%;
                justify-content: flex-start;
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
                    <h1 class="page-title">Tiketi za Msaada</h1>
                </div>
                <div class="header-right">
                    <a href="{{ route('balozi.tickets.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Weka Tiketi Mpya
                    </a>
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

                <!-- Filters -->
                <div class="filters-container">
                    <form method="GET" action="{{ route('balozi.tickets.index') }}" id="filters-form">
                        <div class="filters-row">
                            <div class="filter-group">
                                <label for="search">Tafuta Tiketi</label>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       class="form-control" 
                                       placeholder="Andika nambari ya tiketi au kichwa..."
                                       value="{{ request('search') }}">
                            </div>
                            
                            <div class="filter-group">
                                <label for="status">Hali</label>
                                <select id="status" name="status" class="form-control auto-submit">
                                    <option value="">Hali zote</option>
                                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Wazi</option>
                                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Inashughulikiwa</option>
                                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Imetatuliwa</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Imefungwa</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="priority">Kiwango</label>
                                <select id="priority" name="priority" class="form-control auto-submit">
                                    <option value="">Viwango vyote</option>
                                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Chini</option>
                                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Wastani</option>
                                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Juu</option>
                                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Dharura</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                    Tafuta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tickets List -->
                <div class="tickets-container">
                    <div class="tickets-header">
                        <h2 class="tickets-title">Tiketi Zako</h2>
                        <div class="tickets-stats">
                            <span>Jumla: {{ $tickets->total() }}</span>
                        </div>
                    </div>

                    @if($tickets->count() > 0)
                        @foreach($tickets as $ticket)
                            <div class="ticket-card">
                                <div class="ticket-header">
                                    <div class="ticket-title-section">
                                        <div class="ticket-number">#{{ $ticket->ticket_number }}</div>
                                        <h3 class="ticket-title">{{ $ticket->title }}</h3>
                                        <div class="ticket-meta">
                                            <span><i class="fas fa-calendar"></i> {{ $ticket->created_at->format('d M Y, H:i') }}</span>
                                            <span><i class="fas fa-tag"></i> {{ ucfirst($ticket->category) }}</span>
                                            @if($ticket->tags && count($ticket->tags) > 0)
                                                <span><i class="fas fa-tags"></i> {{ implode(', ', array_slice($ticket->tags, 0, 2)) }}{{ count($ticket->tags) > 2 ? '...' : '' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ticket-badges">
                                        <span class="badge badge-status-{{ $ticket->status }}">
                                            @switch($ticket->status)
                                                @case('open') Wazi @break
                                                @case('in_progress') Inashughulikiwa @break
                                                @case('resolved') Imetatuliwa @break
                                                @case('closed') Imefungwa @break
                                            @endswitch
                                        </span>
                                        <span class="priority-badge priority-{{ $ticket->priority }}">
                                            @switch($ticket->priority)
                                                @case('low') 🟢 Chini @break
                                                @case('medium') 🟡 Wastani @break
                                                @case('high') 🟠 Juu @break
                                                @case('urgent') 🔴 Dharura @break
                                            @endswitch
                                        </span>
                                    </div>
                                </div>

                                <div class="ticket-description">
                                    {{ $ticket->description }}
                                </div>

                                <div class="ticket-actions">
                                    <a href="{{ route('balozi.tickets.show', $ticket->id) }}" class="btn btn-sm btn-view">
                                        <i class="fas fa-eye"></i>
                                        Angalia
                                    </a>
                                    @if($ticket->isOpen())
                                        <a href="{{ route('balozi.tickets.edit', $ticket->id) }}" class="btn btn-sm btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Badilisha
                                        </a>
                                        <form action="{{ route('balozi.tickets.destroy', $ticket->id) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('Una uhakika unataka kufuta tiketi hii?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete">
                                                <i class="fas fa-trash"></i>
                                                Futa
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if($tickets->hasPages())
                            <div class="pagination-wrapper">
                                {{ $tickets->appends(request()->query())->links() }}
                            </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <i class="fas fa-ticket-alt"></i>
                            <h3>Hakuna tiketi zilizopatikana</h3>
                            <p>Bado hujaweka tiketi yoyote ya msaada.</p>
                            <a href="{{ route('balozi.tickets.create') }}" class="btn btn-primary" style="margin-top: 16px;">
                                <i class="fas fa-plus"></i>
                                Weka Tiketi ya Kwanza
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-submit filters
        document.querySelectorAll('.auto-submit').forEach(element => {
            element.addEventListener('change', function() {
                document.getElementById('filters-form').submit();
            });
        });

        // Clear filters
        function clearFilters() {
            window.location.href = "{{ route('balozi.tickets.index') }}";
        }
    </script>
</body>
</html>