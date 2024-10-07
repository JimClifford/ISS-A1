<?php
session_start();
require('../controllers/login_controller.php');
require('../controllers/otp_controller.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
   
    $user = new User();
       
    // Validate user credentials
    $result = $user->validateUser($user_name, $password);
    
    if ($result) {
        // Set session variables after successful login
        $_SESSION['user_id'] = $result['id'];  
        $_SESSION["user"] = $result['user_name']; 

        // Generate OTP for the user
        if (sendOTPController($result['email'])) {
            // Redirect to OTP page
            header("Location: ../view/otp.php");
            exit();  
        } else {
            $error = "There was an issue. Please try again.";
            header("Location: ../view/login.php");
            exit();
        }
    } else {
        // Failed login
        $error = "Login failed. Please try again.";
        header("Location: ../view/login.php");
        exit();
    }
}
?>
