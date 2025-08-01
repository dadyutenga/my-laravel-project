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
            --primary-color: #0d9445ff; /* Teal color */
            --primary-hover: #0d9445ff;
            --primary-light: rgba(20, 184, 166, 0.1);
            --secondary-color: #f8fafc;
            --text-color: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --success-color: #37b025;
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
            overflow-x: hidden;
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
                radial-gradient(circle at 20% 50%, rgba(20, 184, 110, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(13, 148, 136, 0.2) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(2deg); }
            66% { transform: translateY(15px) rotate(-1deg); }
        }

        /* Main content */
        .main-content {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* Hero section */
        .hero-section {
            text-align: center;
            margin-bottom: 4rem;
            max-width: 800px;
        }

        .logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            margin-bottom: 2rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 1s ease 0.2s both;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            box-shadow: var(--shadow-md);
            margin-right: 1rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-color);
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff, #f1f5f9);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            animation: fadeInUp 1s ease 0.4s both;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.6;
            animation: fadeInUp 1s ease 0.6s both;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 1rem 2rem;
            border-radius: var(--radius-xl);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-lg);
            animation: fadeInUp 1s ease 0.8s both;
        }

        .hero-cta:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.15));
        }

        /* Quick nav buttons */
        .quick-nav {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeInUp 1s ease 1s both;
        }

        .quick-nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--text-color);
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-lg);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
        }

        .quick-nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background: rgba(255, 255, 255, 0.95);
        }

        .quick-nav-btn.featured {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
        }

        .quick-nav-btn.featured:hover {
            background: linear-gradient(135deg, var(--primary-hover), #0891b2);
        }

        /* Cards container */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            width: 100%;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease 1.2s both;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-hover), #ffffff);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .card-header {
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-description {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-radius: var(--radius-lg);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--success-color), #37b025);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 3rem;
            padding: 2rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            animation: fadeInUp 1s ease 1.4s both;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }

            .cards-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .hero-section {
                margin-bottom: 3rem;
            }

            .card {
                padding: 1.5rem;
            }

            .quick-nav {
                flex-direction: column;
                align-items: center;
            }

            .quick-nav-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-cta {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }

            .logo-container {
                padding: 0.75rem;
            }

            .logo-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }

            .logo-text {
                font-size: 1.25rem;
            }
        }

        /* Scroll animations */
        @media (prefers-reduced-motion: no-preference) {
            .card:nth-child(2) {
                animation-delay: 1.4s;
            }
        }
    </style>
</head>
<body>
    <div class="bg-decoration"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-database"></i>
                </div>
                <div class="logo-text">Prototype System</div>
            </div>

            <h1 class="hero-title">Community Management Platform</h1>
            <p class="hero-subtitle">
                Modern community management platform. Stay connected with local announcements, 
                access administrative tools, and manage community resources efficiently.
            </p>

            <!-- Quick Navigation -->
            <div class="quick-nav">
                <a href="{{ route('announcements.index') }}" class="quick-nav-btn featured">
                    <i class="fas fa-bullhorn"></i>
                    <span>Community Announcements</span>
                </a>
                <a href="#about" class="quick-nav-btn">
                    <i class="fas fa-info-circle"></i>
                    <span>About Us</span>
                </a>
                <a href="#contact" class="quick-nav-btn">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </div>
        </section>

        <!-- Cards Section -->
        <section class="cards-container">
            <!-- Admin Login Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-shield-alt" style="color: var(--primary-color);"></i>
                        Admin Portal
                    </h2>
                    <p class="card-description">
                        Access the administrative dashboard to manage users, system settings, and monitor platform activities.
                    </p>
                </div>
                <div class="card-content">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Admin Login</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Leaders Login Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-users" style="color: var(--success-color);"></i>
                        Leaders Portal
                    </h2>
                    <p class="card-description">
                        Community leaders can manage announcements, meetings, certificates, and engage with residents.
                    </p>
                </div>
                <div class="card-content">
                    <a href="{{ route('login1') }}" class="btn btn-secondary">
                        <i class="fas fa-user-tie"></i>
                        <span>Leaders Login</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; <span id="current-year"></span> Prototype System. Built with modern web technologies.</p>
        </footer>
    </main>

    <script>
        // Set current year
        document.getElementById('current-year').textContent = new Date().getFullYear();

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('[style*="animation"]').forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });

        // Start hero animations immediately
        document.querySelectorAll('.hero-section [style*="animation"]').forEach(el => {
            el.style.animationPlayState = 'running';
        });
    </script>
</body>
</html>