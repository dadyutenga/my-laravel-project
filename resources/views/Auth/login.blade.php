<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prototype System Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .welcome-message h1 {
            font-weight: 500;
            font-size: 24px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .welcome-message p {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3498db;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #2980b9, #3498db);
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.3);
        }

        .additional-options {
            margin-top: 20px;
            font-size: 13px;
        }

        .forgot-password {
            color: #7f8c8d;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #3498db;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
            
            .welcome-message h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="welcome-message">
                <h1>Welcome to the prototype system</h1>
                <p>Please sign in to continue</p>
            </div>
            
            <form id="loginForm">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required placeholder="Enter your username">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                </div>
                
                <button type="submit" class="login-btn">Sign In</button>
                
                <div class="additional-options">
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Simple validation
            if(username.trim() === '' || password.trim() === '') {
                alert('Please enter both username and password');
                return;
            }
            
            // Here you would typically send the data to a server
            // For this prototype, we'll just show a success message
            alert('Login successful! Welcome to the prototype system.');
            
            // Reset the form
            this.reset();
            
            // In a real application, you would redirect to another page
            // window.location.href = 'dashboard.html';
        });
    </script>
</body>
</html>