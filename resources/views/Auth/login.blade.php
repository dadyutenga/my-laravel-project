<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prototype System Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4ee546;
            --primary-hover: #4ee546;
            --secondary-color: #f9fafb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --error-color: #ef4444;
            --success-color: #37b025;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
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
            background: linear-gradient(135deg, #f6f9fc 0%, #eef2f5 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-color);
            position: relative;
            overflow: hidden;
        }

        /* Background decoration */
        .bg-decoration {
            position: absolute;
            border-radius: 50%;
            z-index: -1;
        }

        .bg-decoration-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(79, 70, 229, 0.05) 100%);
            top: -100px;
            right: -100px;
        }

        .bg-decoration-2 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(79, 70, 229, 0.02) 100%);
            bottom: -200px;
            left: -200px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 40px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }

        /* Card decoration */
        .card-decoration {
            position: absolute;
            background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
            height: 8px;
            top: 0;
            left: 0;
            right: 0;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }

        .welcome-message {
            margin-bottom: 30px;
        }

        .welcome-message h1 {
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 10px;
            color: var(--text-color);
            line-height: 1.3;
        }

        .welcome-message p {
            color: var(--text-muted);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 24px;
            text-align: left;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-color);
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 16px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #f9fafb;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-group input::placeholder {
            color: #a0aec0;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            border: none;
            border-radius: var(--radius-md);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #4ee546, #4ee546);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .login-btn:active {
            transform: translateY(1px);
        }

        /* Button ripple effect */
        .login-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .login-btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            20% {
                transform: scale(25, 25);
                opacity: 0.3;
            }
            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }

        .additional-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .forgot-password:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .register-option {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        .register-option span {
            color: var(--text-muted);
            font-size: 14px;
        }

        .register-option a {
            color: var(--primary-color);
            text-decoration: none;
            margin-left: 5px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-option a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        /* Alert styles */
        .alert {
            position: relative;
            display: flex;
            align-items: center;
            padding: 14px 16px;
            margin-bottom: 16px;
            border-radius: var(--radius-md);
            background-color: white;
            box-shadow: var(--shadow-md);
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            animation: slideIn 0.3s ease forwards;
            animation-delay: calc(var(--delay) * 200ms);
            text-align: left;
        }

        .alert[data-alert-type="success"] {
            border-left-color: var(--success-color);
        }

        .alert[data-alert-type="success"] .alert-icon {
            color: var(--success-color);
        }

        .alert[data-alert-type="danger"] {
            border-left-color: var(--error-color);
        }

        .alert[data-alert-type="danger"] .alert-icon {
            color: var(--error-color);
        }

        .alert[data-alert-type="warning"] {
            border-left-color: var(--warning-color);
        }

        .alert[data-alert-type="warning"] .alert-icon {
            color: var(--warning-color);
        }

        .alert[data-alert-type="info"] {
            border-left-color: var(--info-color);
        }

        .alert[data-alert-type="info"] .alert-icon {
            color: var(--info-color);
        }

        .alert-icon {
            font-size: 20px;
            margin-right: 12px;
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
            color: var(--text-color);
        }

        .alert-message {
            font-size: 13px;
            line-height: 1.4;
            color: var(--text-muted);
        }

        .alert-close-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            padding: 5px;
            opacity: 0.7;
            transition: opacity 0.2s ease, transform 0.2s ease;
            color: var(--text-muted);
        }

        .alert-close-btn:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .alert-progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 0;
            background-color: rgba(0, 0, 0, 0.1);
            animation: progress 5000ms linear forwards;
            animation-delay: calc(var(--delay) * 200ms);
        }

        .invalid-feedback {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        /* Social login */
        .social-login {
            margin-top: 25px;
            margin-bottom: 25px;
        }

        .social-login-divider {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: var(--text-muted);
            font-size: 14px;
        }

        .social-login-divider::before,
        .social-login-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: var(--border-color);
        }

        .social-login-divider span {
            padding: 0 10px;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-muted);
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .social-btn.google:hover {
            color: #DB4437;
            border-color: #DB4437;
        }

        .social-btn.facebook:hover {
            color: #4267B2;
            border-color: #4267B2;
        }

        .social-btn.twitter:hover {
            color: #1DA1F2;
            border-color: #1DA1F2;
        }

        .social-btn i {
            font-size: 18px;
        }

        /* Animations */
        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes progress {
            to {
                width: 100%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive styles */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
            
            .welcome-message h1 {
                font-size: 20px;
            }

            .additional-options {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .alert {
                padding: 12px 14px;
            }
            
            .alert-icon {
                font-size: 18px;
                margin-right: 10px;
            }
            
            .alert-title {
                font-size: 13px;
            }
            
            .alert-message {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Background decorations -->
    <div class="bg-decoration bg-decoration-1"></div>
    <div class="bg-decoration bg-decoration-2"></div>

    <div id="alerts-container" style="position: fixed; top: 20px; right: 20px; width: 300px; z-index: 1000;">
        @if (session('error'))
            <div class="alert alert-danger" data-alert-type="danger">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="alert-content">
                    <div class="alert-title">Error</div>
                    <div class="alert-message">{{ session('error') }}</div>
                </div>
                <button class="alert-close-btn">
                    <i class="fas fa-times"></i>
                </button>
                <div class="alert-progress-bar"></div>
            </div>
        @endif
        
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" data-alert-type="danger">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Error</div>
                        <div class="alert-message">{{ $error }}</div>
                    </div>
                    <button class="alert-close-btn">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="alert-progress-bar"></div>
                </div>
            @endforeach
        @endif
        
        @if (session('success'))
            <div class="alert alert-success" data-alert-type="success">
                <div class="alert-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="alert-content">
                    <div class="alert-title">Success</div>
                    <div class="alert-message">{{ session('success') }}</div>
                </div>
                <button class="alert-close-btn">
                    <i class="fas fa-times"></i>
                </button>
                <div class="alert-progress-bar"></div>
            </div>
        @endif
    </div>

    <div class="login-container">
        <div class="login-card">
            <!-- Card top decoration -->
            <div class="card-decoration"></div>
            
            <div class="welcome-message">
                <h1>Welcome to the Prototype System</h1>
                <p>Please sign in to continue to your account</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                    </div>
                </div>
                
                <div class="additional-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                
                <button type="submit" class="login-btn">Sign In</button>
                
              
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        // Setup CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            // Set delay for staggered animation of alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach((alert, index) => {
                alert.style.setProperty('--delay', index);
                // Auto-dismiss after 5 seconds
                setTimeout(() => {
                    if (alert.style.opacity !== '0') {
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateY(-20px)';
                        setTimeout(() => alert.remove(), 300);
                    }
                }, 5000 + (index * 200));
                
                // Close button functionality
                alert.querySelector('.alert-close-btn').addEventListener('click', function() {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => alert.remove(), 300);
                });
            });
            
            // Animate form groups
            const formGroups = document.querySelectorAll('.form-group, .additional-options, .login-btn, .register-option');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                group.style.transition = 'all 0.3s ease';
                group.style.transitionDelay = `${index * 0.1 + 0.2}s`;
                setTimeout(() => {
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, 100);
            });
            
            // Button ripple effect
            const buttons = document.querySelectorAll('.login-btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const rect = button.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const ripple = document.createElement('span');
                    ripple.style.position = 'absolute';
                    ripple.style.width = '1px';
                    ripple.style.height = '1px';
                    ripple.style.borderRadius = '50%';
                    ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.7)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.animation = 'ripple 0.6s linear';
                    
                    button.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>
</body>
</html>