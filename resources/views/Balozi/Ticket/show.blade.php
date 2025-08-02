
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiketi #{{ $ticket->ticket_number }} | Prototype System</title>
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

        .ticket-container {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .ticket-header {
            padding: 30px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
        }

        .ticket-number {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .ticket-subject {
            font-size: 20px;
            font-weight: 500;
            opacity: 0.9;
        }

        .ticket-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 30px;
            background: var(--secondary-color);
            border-bottom: 1px solid var(--border-color);
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .meta-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-open { background: #fef3c7; color: #92400e; }
        .status-in_progress { background: #dbeafe; color: #1e40af; }
        .status-resolved { background: #dcfce7; color: #166534; }
        .status-closed { background: #f3f4f6; color: #374151; }

        .priority-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .ticket-content {
            padding: 30px;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ticket-description {
            background: var(--secondary-color);
            padding: 20px;
            border-radius: var(--radius-md);
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .attachments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .attachment-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: var(--secondary-color);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--text-color);
            transition: var(--transition);
        }

        .attachment-item:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        .attachment-icon {
            font-size: 24px;
            color: var(--primary-color);
        }

        .attachment-info {
            flex: 1;
        }

        .attachment-name {
            font-weight: 500;
            margin-bottom: 2px;
        }

        .attachment-size {
            font-size: 12px;
            color: var(--text-muted);
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

        .btn-danger {
            background-color: var(--error-color);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            padding: 30px;
            border-top: 1px solid var(--border-color);
            background: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .dashboard-content {
                padding: 20px;
            }

            .ticket-meta {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .action-buttons {
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
                    <h1 class="page-title">Tiketi za Msaada</h1>
                    <nav class="breadcrumb">
                        <div class="breadcrumb-item">
                            <a href="{{ route('balozi.tickets.index') }}" class="breadcrumb-link">Tiketi</a>
                        </div>
                        <div class="breadcrumb-item">
                            <span class="breadcrumb-current">#{{ $ticket->ticket_number }}</span>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="ticket-container">
                    <div class="ticket-header">
                        <div class="ticket-number">#{{ $ticket->ticket_number }}</div>
                        <div class="ticket-subject">{{ $ticket->subject }}</div>
                    </div>

                    <div class="ticket-meta">
                        <div class="meta-item">
                            <div class="meta-label">Hali</div>
                            <div class="meta-value">
                                <span class="status-badge status-{{ $ticket->status }}">
                                    @if($ticket->status === 'open')
                                        🟡 Funguo
                                    @elseif($ticket->status === 'in_progress')
                                        🔵 Inaendelea
                                    @elseif($ticket->status === 'resolved')
                                        🟢 Imetatuliwa
                                    @else
                                        ⚫ Imefungwa
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Kipaumbele</div>
                            <div class="meta-value">
                                <span class="priority-badge">
                                    @if($ticket->priority === 'low')
                                        🟢 Chini
                                    @elseif($ticket->priority === 'medium')
                                        🟡 Wastani
                                    @elseif($ticket->priority === 'high')
                                        🟠 Juu
                                    @else
                                        🔴 Dharura
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Tarehe ya Kutengeneza</div>
                            <div class="meta-value">{{ $ticket->created_at->format('d/m/Y H:i') }}</div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Tarehe ya Mwisho Kusasishwa</div>
                            <div class="meta-value">{{ $ticket->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>

                    <div class="ticket-content">
                        <div class="content-section">
                            <h3 class="section-title">
                                <i class="fas fa-file-text"></i>
                                Maelezo ya Tatizo
                            </h3>
                            <div class="ticket-description">{{ $ticket->description }}</div>
                        </div>

                        @if($ticket->attachments && count(json_decode($ticket->attachments, true)) > 0)
                            <div class="content-section">
                                <h3 class="section-title">
                                    <i class="fas fa-paperclip"></i>
                                    Faili Zilizounganishwa
                                </h3>
                                <div class="attachments-grid">
                                    @foreach(json_decode($ticket->attachments, true) as $index => $attachment)
                                        <a href="{{ route('balozi.tickets.download-attachment', [$ticket->id, $index]) }}" 
                                           class="attachment-item">
                                            <div class="attachment-icon">
                                                <i class="fas fa-file"></i>
                                            </div>
                                            <div class="attachment-info">
                                                <div class="attachment-name">{{ $attachment['original_name'] }}</div>
                                                <div class="attachment-size">{{ number_format($attachment['size'] / 1024, 1) }} KB</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($ticket->admin_response)
                            <div class="content-section">
                                <h3 class="section-title">
                                    <i class="fas fa-reply"></i>
                                    Jibu la Msimamizi
                                </h3>
                                <div class="ticket-description">{{ $ticket->admin_response }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="action-buttons">
                        @if($ticket->status !== 'closed')
                            <a href="{{ route('balozi.tickets.edit', $ticket->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                                Badili Tiketi
                            </a>
                        @endif
                        
                        <a href="{{ route('balozi.tickets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Rudi Nyuma
                        </a>
                        
                        @if($ticket->status !== 'closed')
                            <form action="{{ route('balozi.tickets.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Una uhakika unataka kufuta tiketi hii?')">
                                    <i class="fas fa-trash"></i>
                                    Futa Tiketi
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>