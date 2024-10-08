<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <div class="container">
        <h1>Ashesi Saints 2FA System</h1>

        <h2>Register</h2>
        <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <!--Form Input Area-->
        <form id="registrationForm" action="../actions/add_user_action.php" method="post">
            <div class="form-group">
                <label for="fullName">User Name:</label>
                <input type="text" id="user_name" name="user_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}" 
                    title="Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.">
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
    <script src="../js/register.js"></script>
</body>
</html>
