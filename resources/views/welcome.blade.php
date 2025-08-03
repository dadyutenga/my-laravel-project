<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prototype System - Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--cream-bg);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Header Navigation */
        .header {
            background: white;
            padding: 1.2rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
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
            gap: 1rem;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-color);
            text-decoration: none;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            box-shadow: 0 4px 15px rgba(13, 148, 69, 0.3);
        }

        /* Hero Section */
        .hero {
            background: var(--cream-bg);
            padding: 8rem 0;
            min-height: 85vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60%;
            height: 100%;
            background: linear-gradient(135deg, rgba(13, 148, 69, 0.05) 0%, rgba(55, 176, 37, 0.03) 100%);
            border-radius: 0 0 0 100px;
        }

        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 6rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 800;
            color: var(--text-color);
            line-height: 1.1;
            margin-bottom: 2rem;
            letter-spacing: -0.02em;
        }

        .hero-content p {
            font-size: 1.4rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
            line-height: 1.7;
            max-width: 90%;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            background: var(--gradient-bg);
            color: white;
            padding: 1.25rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 8px 25px rgba(13, 148, 69, 0.3);
            transition: all 0.3s ease;
        }

        .hero-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(13, 148, 69, 0.4);
        }

        /* Advanced Dashboard Preview */
        .dashboard-preview {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .dashboard-preview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-bg);
        }

        .dashboard-header {
            background: #f8fafc;
            color: var(--text-color);
            padding: 1rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dashboard-header::after {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--success-color);
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dashboard-content {
            padding: 1.5rem;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e5e7eb;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            display: block;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        .dashboard-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem;
            margin-bottom: 1rem;
            background: #f8fafc;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .dashboard-item:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }

        .dashboard-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            flex-shrink: 0;
        }

        .dashboard-icon.green { background: var(--success-color); }
        .dashboard-icon.blue { background: #3b82f6; }
        .dashboard-icon.purple { background: #8b5cf6; }
        .dashboard-icon.orange { background: #f59e0b; }

        .dashboard-text {
            flex: 1;
        }

        .dashboard-text h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.25rem;
        }

        .dashboard-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* Features Section */
        .features-section {
            background: white;
            padding: 8rem 0;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .features-section h2 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .features-section .subtitle {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 4rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
            margin-top: 4rem;
        }

        .feature-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-bg);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .feature-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 20px;
            color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .feature-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            color: var(--text-muted);
            line-height: 1.5;
            font-size: 0.9rem;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 6rem 0;
        }

        .cta-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
        }

        .cta-buttons {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem 3rem;
            border-radius: 16px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            min-width: 220px;
            justify-content: center;
        }

        .btn-primary {
            background: var(--gradient-bg);
            color: white;
            box-shadow: 0 8px 25px rgba(13, 148, 69, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(13, 148, 69, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--success-color), #2d8f1f);
            color: white;
            box-shadow: 0 8px 25px rgba(55, 176, 37, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(55, 176, 37, 0.4);
        }

        /* Footer */
        .footer {
            background: var(--text-color);
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer p {
            font-size: 1rem;
            opacity: 0.8;
        }

        .ditronics {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-container {
                padding: 0 1rem;
            }

            .hero {
                padding: 4rem 0;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .hero-content h1 {
                font-size: 2.8rem;
            }

            .hero-content p {
                font-size: 1.2rem;
                max-width: 100%;
            }

            .features-section h2 {
                font-size: 2.2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }

            .dashboard-preview {
                margin-top: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .features-section h2 {
                font-size: 1.8rem;
            }

            .feature-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-database"></i>
                </div>
                <span>Community Management System</span>
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Everything you need to manage your community</h1>
                <p>A comprehensive digital platform designed for government and community organizations to streamline administrative processes, enhance citizen engagement, and promote transparency.</p>
                
                <a href="{{ route('announcements.index') }}" class="hero-cta">
                    <i class="fas fa-bullhorn"></i>
                    <span>View Community Announcements</span>
                </a>
            </div>

            <div class="dashboard-preview">
                <div class="dashboard-header">
                    Community Dashboard
                </div>
                <div class="dashboard-content">
                    <div class="dashboard-item">
                        <div class="dashboard-icon green">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="dashboard-text">
                            <h4>Community Announcements</h4>
                            <p>Latest updates and important notices</p>
                        </div>
                    </div>
                    <div class="dashboard-item">
                        <div class="dashboard-icon blue">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="dashboard-text">
                            <h4>Meetings & Events</h4>
                            <p>Scheduled community gatherings</p>
                        </div>
                    </div>
                    <div class="dashboard-item">
                        <div class="dashboard-icon purple">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="dashboard-text">
                            <h4>Digital Certificates</h4>
                            <p>Official community documents</p>
                        </div>
                    </div>
                    <div class="dashboard-item">
                        <div class="dashboard-icon orange">
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
    <section class="features-section">
        <div class="features-container">
            <h2>All that you need to stay organized and connected</h2>
            <p class="subtitle">We understand the unique challenges that government and community organizations face, which is why we've developed a comprehensive suite of digital tools.</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-card-icon" style="background: var(--gradient-bg);">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3>Community Announcements</h3>
                    <p>Efficiently broadcast important information to community members with our real-time announcement system. Ensure every citizen stays informed about local developments and initiatives.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-card-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Administrative Control</h3>
                    <p>Comprehensive admin dashboard for managing users, permissions, and system settings. Maintain full control over your community platform with advanced security features.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-card-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Leadership Tools</h3>
                    <p>Empower community leaders with specialized tools for managing meetings, certificates, and resident data. Foster better communication and community engagement.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container">
            <h2>Access Your Portal</h2>
            <p>Choose your appropriate access level to manage and participate in community activities.</p>
            
            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-shield-alt"></i>
                    <span>Administrative Portal</span>
                </a>
                <a href="{{ route('login1') }}" class="btn btn-secondary">
                    <i class="fas fa-users"></i>
                    <span>Community Leaders Portal</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <p>&copy; <span id="current-year"></span> Prototype System. Built by <a href="https://ditronics.co.tz" target="_blank" class="ditronics">Ditronics</a>.</p>
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
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>