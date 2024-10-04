<?php
// Include the OTP controller
require('../controllers/otp_controller.php');

session_start();

// Check if the user is logged in (user_id is set in the session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if session is invalid
    header("Location: ../view/login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $userOtpInput = $_POST['otp'];
    $user_id = $_SESSION['user_id'];
    
    // Validate the OTP using the controller
    ;
    
    if (validateOTPController($user_id,$userOtpInput)) {
        // Success - redirect or display a success message
        header("Location: ../view/success.php"); // Redirect to a success page
        exit();
    } else {
        // OTP validation failed, redirect back to OTP page with an error
        $error = "OTP validation failed. Please try again.";
        header("Location: ../view/otp.php?error=" . urlencode($error));
        exit();
    }
}
?>
