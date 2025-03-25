<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/Login.css">
</head>
<body class="user-login">
    <div class="adminlogin-container">
        <div class="login-box">
            <h2>FLEXI GYM</h2>
            <h2>Log In</h2>
            <form action="php/login.php" method="POST">
                <div class="input-group username">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group password-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <span id="toggle-password">👁️</span>
                </div>
                <div class="remember-forgot">
                    <label class="remember">
                        <input type="checkbox"> Remember
                    </label>
                </div>
                <button type="submit" class="login-btn">Log In</button>
            </form>
            <p class="register-text">Don't have an account? <a href="SignUp.php">Register</a></p>
        </div>
    </div>
</body>
</html>
