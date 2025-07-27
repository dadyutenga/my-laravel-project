
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Announcements | Prototype System</title>
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
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-sm: 0.25rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --radius-xl: 1rem;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-color);
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
            color: white;
            padding: 20px 0;
            box-shadow: var(--shadow-lg);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 700;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .header-nav {
            display: flex;
            gap: 30px;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            padding: 8px 0;
            border-bottom: 2px solid transparent;
        }

        .nav-link:hover {
            border-bottom-color: rgba(255, 255, 255, 0.7);
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
        }

        .main-content {
            min-height: 600px;
        }

        /* Page Title */
        .page-title {
            margin-bottom: 30px;
            text-align: center;
        }

        .page-title h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .page-title p {
            font-size: 1.1rem;
            color: var(--text-muted);
        }

        /* Filters */
        .filters-section {
            background: white;
            padding: 25px;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
        }

        .filters-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .filter-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            color: var(--text-color);
        }

        .filter-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
        }

        .filter-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .filter-btn {
            background: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            margin-top: 15px;
        }

        .filter-btn:hover {
            background: var(--primary-hover);
        }

        .clear-filters {
            background: var(--text-muted);
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 12px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        /* Announcements */
        .announcements-section {
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .section-header {
            background: linear-gradient(135deg, var(--primary-light) 0%, rgba(79, 70, 229, 0.05) 100%);
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .announcements-list {
            padding: 20px;
        }

        .announcement-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 25px;
            margin-bottom: 20px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .announcement-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #6366f1);
        }

        .announcement-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .announcement-card.urgent::before {
            background: linear-gradient(90deg, var(--error-color), #f87171);
        }

        .announcement-card.featured {
            border-color: var(--warning-color);
            background: linear-gradient(135deg, #ffffff 0%, rgba(245, 158, 11, 0.02) 100%);
        }

        .announcement-card.featured::before {
            background: linear-gradient(90deg, var(--warning-color), #fbbf24);
        }

        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .announcement-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .announcement-title-sw {
            font-size: 16px;
            color: var(--text-muted);
            font-weight: 500;
            font-style: italic;
        }

        .announcement-badges {
            display: flex;
            flex-direction: column;
            gap: 5px;
            align-items: flex-end;
        }

        .badge {
            padding: 4px 10px;
            border-radius: var(--radius-sm);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge.priority-urgent {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .badge.priority-high {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .badge.priority-normal {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .badge.priority-low {
            background: rgba(107, 114, 128, 0.1);
            color: var(--text-muted);
        }

        .badge.category {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .badge.featured {
            background: linear-gradient(135deg, var(--warning-color), #fbbf24);
            color: white;
        }

        .announcement-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .announcement-content {
            line-height: 1.7;
            color: var(--text-color);
            margin-bottom: 15px;
        }

        .announcement-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }

        .read-more-btn {
            background: var(--primary-color);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .read-more-btn:hover {
            background: var(--primary-hover);
        }

        .attachments {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .attachment-link {
            background: var(--secondary-color);
            color: var(--text-color);
            padding: 6px 12px;
            border-radius: var(--radius-md);
            font-size: 12px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .attachment-link:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .sidebar-section {
            background: white;
            border-radius: var(--radius-xl);
            padding: 25px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-item {
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-item:last-child {
            border-bottom: none;
        }

        .sidebar-item-title {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 5px;
            font-size: 14px;
        }

        .sidebar-item-meta {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 20px;
            text-align: center;
            border-top: 1px solid var(--border-color);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 20px 10px;
            }

            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .header-nav {
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-title h1 {
                font-size: 2rem;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .announcement-header {
                flex-direction: column;
                gap: 10px;
            }

            .announcement-badges {
                align-items: flex-start;
                flex-direction: row;
                flex-wrap: wrap;
            }

            .announcement-meta {
                flex-direction: column;
                gap: 5px;
            }

            .announcement-actions {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <span>Community Announcements</span>
            </div>
            <nav class="header-nav">
                <a href="{{ route('welcome') }}" class="nav-link">Home</a>
                <a href="#" class="nav-link">Services</a>
                <a href="#" class="nav-link">Contact</a>
                <a href="{{ route('login1') }}" class="nav-link">Login</a>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <!-- Page Title -->
            <div class="page-title">
                <h1>Community Announcements</h1>
                <p>Stay updated with the latest news and announcements from your community</p>
            </div>

            <!-- Filters -->
            <div class="filters-section">
                <h3 class="filters-title">
                    <i class="fas fa-filter"></i>
                    Filter Announcements
                </h3>
                <form method="GET" action="{{ route('matangazo.index') }}">
                    <div class="filters-grid">
                        <div class="filter-group">
                            <label for="type">Announcement Type</label>
                            <select name="type" id="type" class="filter-control">
                                <option value="all" {{ $type == 'all' ? 'selected' : '' }}>All Announcements</option>
                                <option value="general" {{ $type == 'general' ? 'selected' : '' }}>General</option>
                                <option value="meeting" {{ $type == 'meeting' ? 'selected' : '' }}>Meetings</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="filter-control">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" class="filter-control">
                                <option value="">All Priorities</option>
                                <option value="urgent" {{ $priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="high" {{ $priority == 'high' ? 'selected' : '' }}>High</option>
                                <option value="normal" {{ $priority == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="low" {{ $priority == 'low' ? 'selected' : '' }}>Low</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="mtaa">Mtaa/Location</label>
                            <select name="mtaa" id="mtaa" class="filter-control">
                                <option value="">All Locations</option>
                                @foreach($availableMtaa as $location)
                                    <option value="{{ $location }}" {{ $mtaa == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-search"></i>
                        Apply Filters
                    </button>
                    
                    @if(request()->hasAny(['type', 'category', 'priority', 'mtaa']))
                        <a href="{{ route('matangazo.index') }}" class="clear-filters">
                            <i class="fas fa-times"></i>
                            Clear Filters
                        </a>
                    @endif
                </form>
            </div>

            <!-- General Announcements -->
            @if(($type == 'all' || $type == 'general') && $generalAnnouncements->count() > 0)
                <div class="announcements-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-bullhorn"></i>
                            General Announcements
                        </h2>
                    </div>
                    <div class="announcements-list">
                        @foreach($generalAnnouncements as $announcement)
                            <article class="announcement-card {{ $announcement->priority == 'urgent' ? 'urgent' : '' }} {{ $announcement->is_featured ? 'featured' : '' }}">
                                <div class="announcement-header">
                                    <div>
                                        <h3 class="announcement-title">{{ $announcement->title }}</h3>
                                        @if($announcement->title_sw)
                                            <p class="announcement-title-sw">{{ $announcement->title_sw }}</p>
                                        @endif
                                    </div>
                                    <div class="announcement-badges">
                                        @if($announcement->is_featured)
                                            <span class="badge featured">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @endif
                                        <span class="badge priority-{{ $announcement->priority }}">{{ $announcement->priority }}</span>
                                        <span class="badge category">{{ $announcement->category }}</span>
                                    </div>
                                </div>

                                <div class="announcement-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ $announcement->formatted_date }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $announcement->mtaa }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-eye"></i>
                                        {{ $announcement->views_count }} views
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-user"></i>
                                        {{ $announcement->createdBy->first_name }} {{ $announcement->createdBy->last_name }}
                                    </div>
                                </div>

                                <div class="announcement-content">
                                    {{ $announcement->short_content }}
                                </div>

                                <div class="announcement-actions">
                                    <a href="{{ route('matangazo.show', ['id' => $announcement->id, 'type' => 'general']) }}" class="read-more-btn">
                                        <i class="fas fa-arrow-right"></i>
                                        Read More
                                    </a>
                                    
                                    @if(!empty($announcement->attachments))
                                        <div class="attachments">
                                            @foreach($announcement->attachments as $index => $attachment)
                                                <a href="{{ route('matangazo.download', ['id' => $announcement->id, 'type' => 'general', 'attachment' => $index]) }}" 
                                                   class="attachment-link">
                                                    <i class="fas fa-paperclip"></i>
                                                    {{ Str::limit($attachment['name'], 20) }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach

                        @if($generalAnnouncements->hasPages())
                            <div class="pagination-wrapper">
                                {{ $generalAnnouncements->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Meeting Announcements -->
            @if(($type == 'all' || $type == 'meeting') && $meetingAnnouncements->count() > 0)
                <div class="announcements-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-calendar-alt"></i>
                            Meeting Announcements
                        </h2>
                    </div>
                    <div class="announcements-list">
                        @foreach($meetingAnnouncements as $announcement)
                            <article class="announcement-card">
                                <div class="announcement-header">
                                    <div>
                                        <h3 class="announcement-title">{{ $announcement->title }}</h3>
                                        @if($announcement->title_sw)
                                            <p class="announcement-title-sw">{{ $announcement->title_sw }}</p>
                                        @endif
                                    </div>
                                    <div class="announcement-badges">
                                        <span class="badge category">Meeting</span>
                                    </div>
                                </div>

                                <div class="announcement-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ $announcement->created_at->format('d/m/Y') }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $announcement->mtaa }}
                                    </div>
                                    @if($announcement->mtaaMeeting)
                                        <div class="meta-item">
                                            <i class="fas fa-clock"></i>
                                            Meeting: {{ $announcement->mtaaMeeting->meeting_date->format('d/m/Y') }}
                                        </div>
                                    @endif
                                    <div class="meta-item">
                                        <i class="fas fa-user"></i>
                                        {{ $announcement->createdBy->first_name }} {{ $announcement->createdBy->last_name }}
                                    </div>
                                </div>

                                <div class="announcement-content">
                                    {{ Str::limit($announcement->content, 200) }}
                                </div>

                                <div class="announcement-actions">
                                    <a href="{{ route('matangazo.show', ['id' => $announcement->id, 'type' => 'meeting']) }}" class="read-more-btn">
                                        <i class="fas fa-arrow-right"></i>
                                        Read More
                                    </a>
                                    
                                    @if(!empty($announcement->attachments))
                                        <div class="attachments">
                                            @foreach($announcement->attachments as $index => $attachment)
                                                <a href="{{ route('matangazo.download', ['id' => $announcement->id, 'type' => 'meeting', 'attachment' => $index]) }}" 
                                                   class="attachment-link">
                                                    <i class="fas fa-paperclip"></i>
                                                    {{ Str::limit($attachment['name'], 20) }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach

                        @if($meetingAnnouncements->hasPages())
                            <div class="pagination-wrapper">
                                {{ $meetingAnnouncements->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Empty State -->
            @if(($type == 'all' && $generalAnnouncements->count() == 0 && $meetingAnnouncements->count() == 0) ||
                ($type == 'general' && $generalAnnouncements->count() == 0) ||
                ($type == 'meeting' && $meetingAnnouncements->count() == 0))
                <div class="announcements-section">
                    <div class="empty-state">
                        <i class="fas fa-bullhorn"></i>
                        <h3>No Announcements Found</h3>
                        <p>There are currently no announcements matching your criteria. Please check back later or adjust your filters.</p>
                    </div>
                </div>
            @endif
        </main>

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Featured Announcements -->
            @if($featuredAnnouncements->count() > 0)
                <div class="sidebar-section">
                    <h3 class="sidebar-title">
                        <i class="fas fa-star"></i>
                        Featured Announcements
                    </h3>
                    @foreach($featuredAnnouncements as $featured)
                        <div class="sidebar-item">
                            <div class="sidebar-item-title">{{ Str::limit($featured->title, 50) }}</div>
                            <div class="sidebar-item-meta">
                                <i class="fas fa-calendar"></i> {{ $featured->formatted_date }} •
                                <i class="fas fa-eye"></i> {{ $featured->views_count }} views
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Urgent Announcements -->
            @if($urgentAnnouncements->count() > 0)
                <div class="sidebar-section">
                    <h3 class="sidebar-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Urgent Announcements
                    </h3>
                    @foreach($urgentAnnouncements as $urgent)
                        <div class="sidebar-item">
                            <div class="sidebar-item-title">{{ Str::limit($urgent->title, 50) }}</div>
                            <div class="sidebar-item-meta">
                                <i class="fas fa-calendar"></i> {{ $urgent->formatted_date }} •
                                <i class="fas fa-map-marker-alt"></i> {{ $urgent->mtaa }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <i class="fas fa-link"></i>
                    Quick Links
                </h3>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <a href="{{ route('welcome') }}" class="read-more-btn" style="justify-content: center;">
                        <i class="fas fa-home"></i>
                        Back to Home
                    </a>
                    <a href="#" class="read-more-btn" style="justify-content: center; background: var(--success-color);">
                        <i class="fas fa-envelope"></i>
                        Contact Us
                    </a>
                    <a href="{{ route('login1') }}" class="read-more-btn" style="justify-content: center; background: var(--warning-color);">
                        <i class="fas fa-sign-in-alt"></i>
                        Admin Login
                    </a>
                </div>
            </div>
        </aside>
    </div>
</body>
</html>