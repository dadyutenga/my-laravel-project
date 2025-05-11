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
    </style>
</head>
<body>
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
        <p class="subtitle">Welcome to the management portal. Please select your login type to continue.</p>
    </div>

    <!-- Login card -->
    <div class="card animate-fade-in delay-200">
        <div class="card-header">
            <h2 class="card-title">Choose Login Type</h2>
            <p class="card-description">Select the appropriate portal for your role</p>
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
    </script>
</body>
</html>