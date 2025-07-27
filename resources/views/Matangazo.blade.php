<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Announcements - Prototype System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #14b8a6;
            --primary-hover: #0d9488;
            --primary-light: rgba(20, 184, 166, 0.1);
            --secondary-color: #f8fafc;
            --text-color: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 50%, #ffffff 100%);
            min-height: 100vh;
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Background decorations */
        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: 
                radial-gradient(circle at 20% 50%, rgba(20, 184, 166, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(13, 148, 136, 0.2) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(2deg); }
            66% { transform: translateY(15px) rotate(-1deg); }
        }

        /* Header section */
        .page-header {
            position: relative;
            text-align: center;
            padding: 4rem 2rem 3rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .back-btn {
            position: absolute;
            top: 2.5rem;
            left: 2.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--text-color);
            padding: 0.75rem 1rem;
            border-radius: var(--radius-lg);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
            font-size: 0.9rem;
            z-index: 10;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background: rgba(255, 255, 255, 1);
            color: var(--primary-color);
        }

        .back-btn i {
            font-size: 0.85rem;
            transition: transform 0.3s ease;
        }

        .back-btn:hover i {
            transform: translateX(-2px);
        }

        .page-title {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff, #f1f5f9);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            line-height: 1.1;
            margin-top: 1rem;
        }

        .page-subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.85);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Main container */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Search and filter section */
        .search-filter-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-2xl);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-form {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .search-input-wrapper {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-xl);
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light), var(--shadow-md);
            transform: translateY(-1px);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .search-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: var(--radius-xl);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
            font-size: 1rem;
            white-space: nowrap;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .filter-select {
            padding: 0.875rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-xl);
            background: white;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light), var(--shadow-md);
        }

        /* Announcements grid */
        .announcements-section {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .announcement-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-2xl);
            padding: 2.5rem;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .announcement-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-hover), #ffffff);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .announcement-card:hover::before {
            transform: scaleX(1);
        }

        .announcement-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .announcement-badges {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .priority-badge {
            padding: 0.375rem 1rem;
            border-radius: var(--radius-lg);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .priority-urgent { 
            background: rgba(239, 68, 68, 0.15); 
            color: var(--error-color);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .priority-high { 
            background: rgba(245, 158, 11, 0.15); 
            color: var(--warning-color);
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .priority-normal { 
            background: rgba(16, 185, 129, 0.15); 
            color: var(--success-color);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .priority-low { 
            background: rgba(100, 116, 139, 0.15); 
            color: var(--text-muted);
            border: 1px solid rgba(100, 116, 139, 0.3);
        }

        .featured-badge {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 0.375rem 1rem;
            border-radius: var(--radius-lg);
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.375rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .announcement-date {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .announcement-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .announcement-content {
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }

        .announcement-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 1rem;
        }

        .announcement-author {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.95rem;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: var(--shadow-md);
        }

        .author-info {
            display: flex;
            flex-direction: column;
        }

        .author-name {
            font-weight: 600;
            color: var(--text-color);
        }

        .author-role {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .announcement-stats {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meeting-details {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary-light), rgba(255, 255, 255, 0.5));
            border-radius: var(--radius-xl);
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .meeting-details h4 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meeting-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .meeting-info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-color);
            font-weight: 500;
        }

        .meeting-info-item i {
            color: var(--primary-color);
            width: 16px;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: var(--primary-color);
            font-size: 2.5rem;
            box-shadow: var(--shadow-md);
        }

        .empty-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .empty-message {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .empty-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 1rem 2rem;
            border-radius: var(--radius-xl);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .empty-cta:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .page-header {
                padding: 3rem 1rem 2rem;
                text-align: center;
            }

            .back-btn {
                position: static;
                margin: 0 auto 2rem auto;
                align-self: center;
                font-size: 0.85rem;
                padding: 0.625rem 0.875rem;
            }

            .page-title {
                margin-top: 0;
            }

            .search-form {
                flex-direction: column;
            }

            .search-input-wrapper {
                min-width: auto;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .announcement-card {
                padding: 1.5rem;
            }

            .announcement-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .announcement-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .meeting-info {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .page-header {
                padding: 2rem 1rem 1.5rem;
            }

            .back-btn {
                font-size: 0.8rem;
                padding: 0.5rem 0.75rem;
                gap: 0.375rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
            }

            .announcement-title {
                font-size: 1.5rem;
            }

            .search-filter-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-decoration"></div>

    <!-- Page Header -->
    <header class="page-header">
        <a href="{{ url('/') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Home</span>
        </a>

        <h1 class="page-title">Community Announcements</h1>
        <p class="page-subtitle">
            Stay updated with the latest news, events, and important information from your community leaders.
        </p>
    </header>

    <div class="container">
        <!-- Search and Filter Section -->
        <section class="search-filter-section">
            <form method="GET" action="{{ route('announcements.index') }}" id="filterForm">
                <div class="search-form">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input 
                            type="text" 
                            name="search" 
                            class="search-input" 
                            placeholder="Search announcements, content, or keywords..." 
                            value="{{ request('search') }}"
                        >
                    </div>
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </button>
                </div>

                <div class="filters-grid">
                    <select name="type" class="filter-select" onchange="this.form.submit()">
                        <option value="all">All Types</option>
                        <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>General Announcements</option>
                        <option value="meeting" {{ request('type') == 'meeting' ? 'selected' : '' }}>Meeting Announcements</option>
                    </select>

                    <select name="category" class="filter-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>

                    <select name="priority" class="filter-select" onchange="this.form.submit()">
                        <option value="">All Priorities</option>
                        <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="normal" {{ request('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    </select>

                    <select name="mtaa" class="filter-select" onchange="this.form.submit()">
                        <option value="">All Areas</option>
                        @foreach($availableMtaa ?? [] as $area)
                            <option value="{{ $area }}" {{ request('mtaa') == $area ? 'selected' : '' }}>
                                {{ $area }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </section>

        <!-- Announcements Section -->
        <section class="announcements-section">
            @if(isset($generalAnnouncements) && $generalAnnouncements->count() > 0)
                @foreach($generalAnnouncements as $announcement)
                <article class="announcement-card">
                    <div class="announcement-header">
                        <div class="announcement-badges">
                            <span class="priority-badge priority-{{ $announcement->priority ?? 'normal' }}">
                                <i class="fas fa-{{ $announcement->priority == 'urgent' ? 'exclamation-triangle' : ($announcement->priority == 'high' ? 'exclamation' : 'info-circle') }}"></i>
                                {{ ucfirst($announcement->priority ?? 'normal') }}
                            </span>
                            @if($announcement->is_featured ?? false)
                                <span class="featured-badge">
                                    <i class="fas fa-star"></i>
                                    Featured
                                </span>
                            @endif
                            @if($announcement->category)
                                <span class="priority-badge priority-normal">
                                    <i class="fas fa-tag"></i>
                                    {{ ucfirst($announcement->category) }}
                                </span>
                            @endif
                        </div>
                        <div class="announcement-date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $announcement->created_at->format('M d, Y') }}
                        </div>
                    </div>

                    <h2 class="announcement-title">{{ $announcement->title }}</h2>
                    
                    <div class="announcement-content">
                        {{ Str::limit($announcement->content, 400) }}
                    </div>

                    <div class="announcement-meta">
                        <div class="announcement-author">
                            <div class="author-avatar">
                                {{ substr($announcement->createdBy->name ?? 'Admin', 0, 1) }}
                            </div>
                            <div class="author-info">
                                <span class="author-name">{{ $announcement->createdBy->name ?? 'Admin' }}</span>
                                <span class="author-role">Community Leader</span>
                            </div>
                        </div>

                        <div class="announcement-stats">
                            @if($announcement->mtaa)
                                <div class="stat-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $announcement->mtaa }}</span>
                                </div>
                            @endif
                            @if($announcement->views_count ?? 0 > 0)
                                <div class="stat-item">
                                    <i class="fas fa-eye"></i>
                                    <span>{{ $announcement->views_count }} views</span>
                                </div>
                            @endif
                            @if($announcement->attachments && count($announcement->attachments) > 0)
                                <div class="stat-item">
                                    <i class="fas fa-paperclip"></i>
                                    <span>{{ count($announcement->attachments) }} files</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            @endif

            @if(isset($meetingAnnouncements) && $meetingAnnouncements->count() > 0)
                @foreach($meetingAnnouncements as $announcement)
                <article class="announcement-card">
                    <div class="announcement-header">
                        <div class="announcement-badges">
                            <span class="priority-badge priority-normal">
                                <i class="fas fa-users"></i>
                                Meeting
                            </span>
                        </div>
                        <div class="announcement-date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $announcement->created_at->format('M d, Y') }}
                        </div>
                    </div>

                    <h2 class="announcement-title">{{ $announcement->title }}</h2>
                    
                    <div class="announcement-content">
                        {{ Str::limit($announcement->content, 300) }}
                    </div>

                    @if($announcement->mtaaMeeting)
                        <div class="meeting-details">
                            <h4>
                                <i class="fas fa-calendar-check"></i>
                                Meeting Details
                            </h4>
                            <div class="meeting-info">
                                <div class="meeting-info-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $announcement->mtaaMeeting->meeting_date->format('l, M d, Y') }}</span>
                                </div>
                                <div class="meeting-info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $announcement->mtaaMeeting->meeting_time }}</span>
                                </div>
                                <div class="meeting-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $announcement->mtaaMeeting->location }}</span>
                                </div>
                                @if($announcement->mtaaMeeting->mtaa)
                                    <div class="meeting-info-item">
                                        <i class="fas fa-map"></i>
                                        <span>{{ $announcement->mtaaMeeting->mtaa }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="announcement-meta">
                        <div class="announcement-author">
                            <div class="author-avatar">
                                {{ substr($announcement->createdBy->name ?? 'Admin', 0, 1) }}
                            </div>
                            <div class="author-info">
                                <span class="author-name">{{ $announcement->createdBy->name ?? 'Admin' }}</span>
                                <span class="author-role">Meeting Organizer</span>
                            </div>
                        </div>

                        <div class="announcement-stats">
                            <div class="stat-item">
                                <i class="fas fa-users"></i>
                                <span>Community Meeting</span>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            @endif

            @if((!isset($generalAnnouncements) || $generalAnnouncements->count() == 0) && (!isset($meetingAnnouncements) || $meetingAnnouncements->count() == 0))
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3 class="empty-title">No Announcements Found</h3>
                <p class="empty-message">
                    There are currently no announcements matching your criteria. Try adjusting your filters or check back later for new updates.
                </p>
                <a href="{{ route('announcements.index') }}" class="empty-cta">
                    <i class="fas fa-refresh"></i>
                    <span>Clear All Filters</span>
                </a>
            </div>
            @endif
        </section>
    </div>

    <script>
        document.getElementById('filterForm').addEventListener('submit', function() {
            const btn = this.querySelector('.search-btn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Searching...</span>';
        });

        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });
    </script>
</body>
</html>