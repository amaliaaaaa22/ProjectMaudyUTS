<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Poliklinik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(45deg, #ff66b2, #ff99cc);
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .circle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 50%;
            animation: float 15s infinite;
        }

        .circle:nth-child(1) {
            width: 200px;
            height: 200px;
            top: -100px;
            left: -100px;
        }

        .circle:nth-child(2) {
            width: 300px;
            height: 300px;
            top: 50%;
            right: -150px;
            animation-delay: 2s;
        }

        .circle:nth-child(3) {
            width: 150px;
            height: 150px;
            bottom: -75px;
            left: 50%;
            animation-delay: 4s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, 30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        .signup-container {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            width: 90%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .clinic-icon {
            font-size: 3em;
            color: #ff66b2;
            margin-bottom: 20px;
        }

        .signup-icon {
            font-size: 2em;
            color: #ff66b2;
            margin-bottom: 15px;
        }

        h2 {
            color: #ff66b2;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff66b2;
        }

        input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: none;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-size: 1em;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            box-shadow: 0 2px 15px rgba(255, 102, 178, 0.3);
        }

        button {
            background: linear-gradient(45deg, #ff66b2, #ff99cc);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 102, 178, 0.3);
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 102, 178, 0.4);
        }

        .login-link {
            margin-top: 20px;
            color: #666;
            font-size: 0.9em;
        }

        .login-link a {
            color: #ff66b2;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .signup-container {
                padding: 30px 20px;
                margin: 20px;
            }

            h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <!-- Background Animation -->
    <div class="background-animation">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <div class="signup-container">
        <i class="fas fa-hospital clinic-icon"></i>
        <i class="fas fa-user-plus signup-icon"></i>
        <h2>Sign Up</h2>
        <form action="inputuser.php" method="post">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">
                Create Account
                <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
            </button>
        </form>
        <div class="login-link">
            Already have an account? <a href="formlogin.php">Login here</a>
        </div>
    </div>
</body>
</html>