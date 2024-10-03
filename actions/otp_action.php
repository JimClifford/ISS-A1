<?php
// Include the User class
require('../controllers/otp_controller.php');

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $userOtpInput = $_POST['otp'];
    $user_id = $_SESSION['user_id'];
    
    // Validate the form data
    $result = validateOTPController($otp, $user_id);
    
    if ($result) {
        // Success - redirect or display a success message
        header("Location: ../view/success.php"); // Redirect to a success page
        exit();
    } else {
        $error = "OTP validation failed. Please try again.";
        header("Location: ../view/otp.php");
    } 
}






?>