<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prototype System - Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d9e4aff;
            --primary-hover: #0b7a3a;
            --primary-light: rgba(13, 148, 69, 0.1);
            --secondary-color: #f8fafc;
            --text-color: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --success-color: #37b025;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --white: #ffffff;
            --light-bg: #fafafa;
            --cream-bg: #fef9f5;
            --gradient-bg: linear-gradient(135deg, #0d9445ff 0%, #37b025 100%);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--cream-bg);
            color: var(--text-color);
            line-height: 1.6;
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Header Navigation */
        .header {
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 0;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .logo:hover {
            transform: translateY(-1px);
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: var(--gradient-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .logo:hover .logo-icon {
            box-shadow: var(--shadow-lg);
            transform: scale(1.05);
        }

        /* Hero Section */
        .hero {
            background: var(--cream-bg);
            padding: 6rem 0 8rem;
            min-height: 90vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 80%;
            height: 200%;
            background: radial-gradient(ellipse at center, rgba(13, 148, 69, 0.08) 0%, rgba(55, 176, 37, 0.04) 50%, transparent 70%);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: clamp(2.5rem, 5vw, 3.75rem);
            font-weight: 800;
            color: var(--text-color);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, var(--text-color) 0%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            line-height: 1.7;
            max-width: 95%;
            font-weight: 400;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--gradient-bg);
            color: white;
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .hero-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .hero-cta:hover::before {
            left: 100%;
        }

        .hero-cta:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        /* Dashboard Preview */
        .dashboard-preview {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            animation: slideInRight 0.8s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .dashboard-preview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-bg);
        }

        .dashboard-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--text-color);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dashboard-header::after {
            content: '';
            width: 10px;
            height: 10px;
            background: var(--success-color);
            border-radius: 50%;
            flex-shrink: 0;
            box-shadow: 0 0 0 2px rgba(55, 176, 37, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .dashboard-content {
            padding: 1.5rem;
        }

        .dashboard-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .dashboard-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
            background: linear-gradient(135deg, rgba(13, 148, 69, 0.1) 0%, rgba(55, 176, 37, 0.05) 100%);
            transition: width 0.3s ease;
        }

        .dashboard-item:hover::before {
            width: 100%;
        }

        .dashboard-item:hover {
            transform: translateX(4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(13, 148, 69, 0.2);
        }

        .dashboard-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
            position: relative;
            z-index: 1;
        }

        .dashboard-icon.green { 
            background: linear-gradient(135deg, var(--success-color) 0%, #2d8f1f 100%);
        }
        .dashboard-icon.blue { 
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        .dashboard-icon.purple { 
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        .dashboard-icon.orange { 
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .dashboard-text {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .dashboard-text h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.25rem;
        }

        .dashboard-text p {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.4;
        }

        /* Features Section */
        .features-section {
            background: white;
            padding: 8rem 0;
            position: relative;
        }

        .features-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-color), transparent);
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .features-section h2 {
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 1rem;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .features-section .subtitle {
            font-size: 1.125rem;
            color: var(--text-muted);
            margin-bottom: 4rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .feature-card {
            background: white;
            padding: 2rem 1.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
            text-align: center;
            border: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            group: hover;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 0;
            background: linear-gradient(135deg, rgba(13, 148, 69, 0.05) 0%, rgba(55, 176, 37, 0.02) 100%);
            transition: height 0.4s ease;
        }

        .feature-card:hover::before {
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: rgba(13, 148, 69, 0.1);
        }

        .feature-card-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 22px;
            color: white;
            box-shadow: var(--shadow-md);
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-card-icon {
            transform: scale(1.1);
            box-shadow: var(--shadow-lg);
        }

        .feature-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .feature-card p {
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 0.95rem;
            position: relative;
            z-index: 1;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 6rem 0;
            position: relative;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 1px;
            background: var(--gradient-bg);
        }

        .cta-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .cta-section h2 {
            font-size: clamp(2rem, 4vw, 2.5rem);
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .cta-section p {
            font-size: 1.125rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.25rem 2.5rem;
            border-radius: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            font-size: 1rem;
            min-width: 240px;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--gradient-bg);
            color: white;
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--success-color), #2d8f1f);
            color: white;
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        /* Footer */
        .footer {
            background: var(--text-color);
            color: white;
            padding: 3rem 0;
            text-align: center;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer p {
            font-size: 0.95rem;
            opacity: 0.8;
            line-height: 1.6;
        }

        .ditronics {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .ditronics:hover {
            color: #37b025;
            text-decoration: underline;
        }

        /* Scroll animations */
        @media (prefers-reduced-motion: no-preference) {
            .feature-card {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.6s ease forwards;
            }

            .feature-card:nth-child(1) { animation-delay: 0.1s; }
            .feature-card:nth-child(2) { animation-delay: 0.2s; }
            .feature-card:nth-child(3) { animation-delay: 0.3s; }

            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-container {
                padding: 0 1rem;
            }

            .logo {
                font-size: 1.25rem;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .hero {
                padding: 4rem 0 6rem;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .hero-content p {
                max-width: 100%;
            }

            .features-section {
                padding: 6rem 0;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 320px;
            }

            .dashboard-preview {
                margin-top: 2rem;
            }

            .feature-card {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                padding: 0 1rem;
            }

            .hero-container {
                padding: 0 1rem;
            }

            .features-container {
                padding: 0 1rem;
            }

            .cta-container {
                padding: 0 1rem;
            }

            .footer-container {
                padding: 0 1rem;
            }

            .feature-card {
                padding: 1.5rem 1rem;
            }

            .btn {
                padding: 1rem 2rem;
                min-width: auto;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .hero-content h1 {
                -webkit-text-fill-color: var(--text-color);
            }
            
            .dashboard-item:hover {
                border-color: var(--primary-color);
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header class="header" role="banner">
        <div class="nav-container">
            <a href="#" class="logo" aria-label="Community Management System Home">
                <div class="logo-icon" aria-hidden="true">
                    <i class="fas fa-database"></i>
                </div>
                <span>Prototype System</span>
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" role="main">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Everything you need to manage your community</h1>
                <p>A comprehensive digital platform designed for government and community organizations to streamline administrative processes, enhance citizen engagement, and promote transparency.</p>
                
                <a href="{{ route('announcements.index') }}" class="hero-cta" aria-label="View Community Announcements">
                    <i class="fas fa-bullhorn" aria-hidden="true"></i>
                    <span>View Community Announcements</span>
                </a>
            </div>

            <div class="dashboard-preview" role="img" aria-label="Community Dashboard Preview">
                <div class="dashboard-header">
                    <span>Community Dashboard</span>
                </div>
                <div class="dashboard-content">
                    <div class="dashboard-item">
                        <div class="dashboard-icon green" aria-hidden="true">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="dashboard-text">
                            <h4>Community Announcements</h4>
                            <p>Latest updates and important notices</p>
                        </div>
                    </div>
                    <div class="dashboard-item">
                        <div class="dashboard-icon blue" aria-hidden="true">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="dashboard-text">
                            <h4>Meetings & Events</h4>
                            <p>Scheduled community gatherings</p>
                        </div>
                    </div>
                    <div class="dashboard-item">
                        <div class="dashboard-icon purple" aria-hidden="true">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="dashboard-text">
                            <h4>Digital Certificates</h4>
                            <p>Official community documents</p>
                        </div>
                    </div>
                    <div class="dashboard-item">
                        <div class="dashboard-icon orange" aria-hidden="true">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="dashboard-text">
                            <h4>Reports & Analytics</h4>
                            <p>Community engagement insights</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" role="region" aria-labelledby="features-heading">
        <div class="features-container">
            <h2 id="features-heading">All that you need to stay organized and connected</h2>
            <p class="subtitle">We understand the unique challenges that government and community organizations face, which is why we've developed a comprehensive suite of digital tools.</p>

            <div class="features-grid">
                <article class="feature-card">
                    <div class="feature-card-icon" style="background: var(--gradient-bg);" aria-hidden="true">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3>Community Announcements</h3>
                    <p>Efficiently broadcast important information to community members with our real-time announcement system. Ensure every citizen stays informed about local developments and initiatives.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-card-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);" aria-hidden="true">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Administrative Control</h3>
                    <p>Comprehensive admin dashboard for managing users, permissions, and system settings. Maintain full control over your community platform with advanced security features.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-card-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);" aria-hidden="true">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Leadership Tools</h3>
                    <p>Empower community leaders with specialized tools for managing meetings, certificates, and resident data. Foster better communication and community engagement.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" role="region" aria-labelledby="cta-heading">
        <div class="cta-container">
            <h2 id="cta-heading">Access Your Portal</h2>
            <p>Choose your appropriate access level to manage and participate in community activities.</p>
            
            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary" aria-label="Access Administrative Portal">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    <span>Administrative Portal</span>
                </a>
                <a href="{{ route('login1') }}" class="btn btn-secondary" aria-label="Access Community Leaders Portal">
                    <i class="fas fa-users" aria-hidden="true"></i>
                    <span>Community Leaders Portal</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" role="contentinfo">
        <div class="footer-container">
            <p>&copy; <span id="current-year"></span> Prototype System. Built by <a href="https://ditronics.co.tz" target="_blank" rel="noopener noreferrer" class="ditronics">Ditronics</a>.</p>
        </div>
    </footer>

    <script>
        // Set current year
        document.getElementById('current-year').textContent = new Date().getFullYear();

        // Simple smooth scrolling for any anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add intersection observer for scroll animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                observer.observe(card);
            });
        }

        // Add focus management for better keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });
    </script>
</body>
</html>