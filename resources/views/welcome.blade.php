<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prototype System - Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
            color: #1e293b;
        }

        /* Decorative elements */
        .decoration {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(203, 213, 225, 0.8) 0%, rgba(203, 213, 225, 0) 70%);
            z-index: -1;
            animation: float 15s infinite ease-in-out;
        }

        .decoration-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .decoration-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        .decoration-3 {
            width: 150px;
            height: 150px;
            top: 20%;
            left: 10%;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(20px) scale(1.05);
            }
        }

        /* Navigation Bar */
        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            padding: 1rem 2rem;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            font-size: 1.25rem;
            color: #1e293b;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .nav-link:hover {
            color: #4f46e5;
            background: rgba(79, 70, 229, 0.1);
            transform: translateY(-2px);
        }

        .nav-link.announcements {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .nav-link.announcements:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
            color: white;
        }

        .nav-link.announcements::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #4f46e5, #6366f1, #8b5cf6);
            border-radius: 0.6rem;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .nav-link.announcements:hover::before {
            opacity: 1;
        }

        /* Mobile nav toggle */
        .nav-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
        }

        .nav-toggle span {
            width: 25px;
            height: 3px;
            background: #64748b;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        /* Logo and header styles */
        .logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 1rem;
            margin-top: 5rem; /* Add space for fixed nav */
        }

        .logo {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            background-color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .header {
            width: 100%;
            max-width: 28rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .title {
            font-size: 2.25rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
            background: linear-gradient(to right, #1e293b, #334155);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .subtitle {
            color: #64748b;
            max-width: 20rem;
            margin: 0 auto;
            line-height: 1.5;
        }

        /* Quick Actions Section */
        .quick-actions {
            width: 100%;
            max-width: 32rem;
            margin-bottom: 2rem;
        }

        .quick-actions-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .quick-actions-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .quick-actions-subtitle {
            color: #64748b;
            font-size: 0.875rem;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(226, 232, 240, 0.8);
            text-decoration: none;
            color: inherit;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
        }

        .action-card.featured {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            border: none;
        }

        .action-card.featured:hover {
            box-shadow: 0 15px 30px -5px rgba(79, 70, 229, 0.4);
        }

        .action-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .action-card .action-icon {
            background: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
        }

        .action-card.featured .action-icon {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .action-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .action-description {
            font-size: 0.875rem;
            opacity: 0.8;
            line-height: 1.5;
        }

        /* Card styles */
        .card {
            width: 100%;
            max-width: 28rem;
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .card-header {
            padding: 1.5rem 1.5rem 0.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .card-description {
            color: #64748b;
            font-size: 0.875rem;
        }

        .card-content {
            padding: 1rem 1.5rem;
            display: grid;
            gap: 1rem;
        }

        .card-footer {
            padding: 0.5rem 1.5rem 1.5rem;
            text-align: center;
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Button styles */
        .button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 3.5rem;
            padding: 0 1.25rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .button:hover::before {
            transform: translateX(0);
        }

        .button:active {
            transform: translateY(2px);
        }

        .button-admin {
            background-color: #0f172a;
        }

        .button-admin:hover {
            background-color: #1e293b;
        }

        .button-leaders {
            background-color: #059669;
        }

        .button-leaders:hover {
            background-color: #047857;
        }

        .button-icon {
            display: flex;
            align-items: center;
        }

        .button-icon i {
            margin-right: 0.5rem;
        }

        .button-arrow {
            opacity: 0.7;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                gap: 0.5rem;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-toggle {
                display: flex;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .title {
                font-size: 2rem;
            }

            .logo-container {
                margin-top: 4rem;
            }
        }

        /* Responsive styles */
        @media (min-width: 640px) {
            .title {
                font-size: 2.5rem;
            }
        }

        /* Animation for page load */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="top-nav">
        <div class="nav-container">
                <div class="nav-logo-icon">
                    <i class="fas fa-database"></i>
                </div>
                <span>Prototype System</span>
            </a>
            
            <div class="nav-links" id="navLinks">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('announcements.index') }}" class="nav-link announcements">
                    <i class="fas fa-bullhorn"></i>
                    <span>Announcements</span>
                </a>
                <a href="#services" class="nav-link">
                    <i class="fas fa-cogs"></i>
                    <span>Services</span>
                </a>
                <a href="#contact" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </div>

            <div class="nav-toggle" onclick="toggleNav()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Decorative elements -->
    <div class="decoration decoration-1"></div>
    <div class="decoration decoration-2"></div>
    <div class="decoration decoration-3"></div>

    <!-- Logo and header -->
    <div class="header animate-fade-in">
        <div class="logo-container">
            <div class="logo">
                <i class="fas fa-database"></i>
            </div>
        </div>
        <h1 class="title">Prototype System</h1>
        <p class="subtitle">Welcome to the management portal. Access community announcements and admin areas.</p>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions animate-fade-in delay-100">
        <div class="quick-actions-header">
            <h2 class="quick-actions-title">Quick Access</h2>
            <p class="quick-actions-subtitle">Choose what you'd like to access</p>
        </div>
        
        <div class="actions-grid">
            <a href="{{ route('announcements.index') }}" class="action-card featured">
                <div class="action-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3 class="action-title">Community Announcements</h3>
                <p class="action-description">Stay updated with the latest community news, events, and important announcements from local leaders.</p>
            </a>
            
            <a href="#services" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3 class="action-title">Community Services</h3>
                <p class="action-description">Access various community services, submit requests, and track service delivery progress.</p>
            </a>
        </div>
    </div>

    <!-- Login card -->
    <div class="card animate-fade-in delay-200">
        <div class="card-header">
            <h2 class="card-title">Administrative Access</h2>
            <p class="card-description">Login to manage the system and community resources</p>
        </div>
        <div class="card-content">
            <a href="{{ route('login') }}" class="button button-admin">
                <div class="button-icon">
                    <i class="fas fa-database"></i>
                    <span>Admin Login</span>
                </div>
                <div class="button-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
            <a href="{{ route('login1') }}" class="button button-leaders">
                <div class="button-icon">
                    <i class="fas fa-users"></i>
                    <span>Leaders Login</span>
                </div>
                <div class="button-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>
        <div class="card-footer">
            © <span id="current-year"></span> Prototype System. All rights reserved.
        </div>
    </div>

    <script>
        // Set current year in footer
        document.getElementById('current-year').textContent = new Date().getFullYear();

        // Toggle mobile navigation
        function toggleNav() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        // Add hover effect to buttons
        const buttons = document.querySelectorAll('.button');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', () => {
                button.querySelector('.button-arrow').style.transform = 'translateX(5px)';
            });
            
            button.addEventListener('mouseleave', () => {
                button.querySelector('.button-arrow').style.transform = 'translateX(0)';
            });
        });

        // Add subtle parallax effect to decorative elements
        document.addEventListener('mousemove', (e) => {
            const decorations = document.querySelectorAll('.decoration');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            decorations.forEach((decoration, index) => {
                const factor = (index + 1) * 10;
                decoration.style.transform = `translate(${x * factor}px, ${y * factor}px)`;
            });
        });

        // Smooth scroll for anchor links
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

        // Add scroll effect to navigation
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const nav = document.querySelector('.top-nav');
            
            if (scrollTop > lastScrollTop) {
                nav.style.transform = 'translateY(-100%)';
            } else {
                nav.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop;
        });
    </script>
</body>
</html>