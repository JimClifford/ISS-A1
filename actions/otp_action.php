<?php
// Include the OTP controller
require('../controllers/otp_controller.php');

session_start();

// Check if the user is logged in (user_id is set in the session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if session is invalid
    $error = "Your Session has is invalid or expired.";
    header("Location: ../view/login.php?error=" . urlencode($error));
    header("Location: ../view/login.php");
    exit();
}

// Check if the request is to regenerate OTP (this is for the AJAX request)
if (isset($_POST['action']) && $_POST['action'] == 'regenerate_otp') {
    
    $email = $_SESSION['email'];
    // Call a function from the OTP controller to generate and send the OTP
    if (sendOTPController($email)) {
        // OTP was successfully generated and sent
        echo json_encode(['status' => 'success', 'message' => 'New OTP has been sent to your email.']);
    } else {
        // OTP generation failed
        echo json_encode(['status' => 'error', 'message' => 'There was an issue generating the OTP.']);
    }
    exit();
}

// Check if the form is submitted for OTP validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form inputs
    $userOtpInput = $_POST['otp'];
    $user_id = $_SESSION['user_id'];
    
    // Validate the OTP using the controller
    if (validateOTPController($user_id, $userOtpInput)) {
        // Success - redirect to success page
        header("Location: ../view/success.php"); // Redirect to a success page
        exit();
    } else {
        // OTP validation failed, redirect back to OTP page with an error
        $error = "OTP invalid or expired. Generate a new otp with the button.";
        header("Location: ../view/otp.php?error=" . urlencode($error));
        exit();
    }
}
?>
