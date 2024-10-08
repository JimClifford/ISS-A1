<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
        <h1>Ashesi Saints 2FA System..</h1>

        <h2>Login Page</h2>
<!--Form Area-->
        <form id="loginForm" action="../actions/login_user_action.php" method="POST"> 
            <div class="form-group">
                <label for="email">User Name</label>
                <input type="user_name" id="user_name" name="user_name" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="error" id="error">
                <?php
                // Display error message if OTP validation fails
                if (isset($_GET['error'])) {
                    echo htmlspecialchars($_GET['error']);
                }
                ?>
            </div>

            <!--Login Area-->
            <button type="submit">Login</button>
        </form>
        
        <p>Don't have an account? <a href="register.php" class="register-link">Register here</a></p>
    </div>

    <script src="../js/login.js"></script> 
</body>
</html>
