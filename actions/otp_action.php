<?php
require('../controllers/otp_controller.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'request_new_otp') {
        // Handle new OTP generation
        if (isset($_SESSION['user_email'])) {
            $email = $_SESSION['user_email'];
            
            if (sendOTPController($email)) {
                echo "Success";  // Response for JavaScript
            } else {
                http_response_code(500);  // Internal Server Error
                echo "Failed to generate OTP";
            }
        } else {
            http_response_code(400);  // Bad Request
            echo "User email not found in session.";
        }
    } else {
        // Original OTP validation logic here
        if (isset($_SESSION['user_id']) && isset($_POST['otp'])) {
            $user_id = $_SESSION['user_id'];
            $userOtpInput = $_POST['otp'];
            
            if (validateOTPController($user_id, $userOtpInput)) {
                header("Location: ../view/success.php");
                exit();
            } else {
                $error = "OTP validation failed. Please try again.";
                header("Location: ../view/otp.php?error=" . urlencode($error));
                exit();
            }
        }
    }
}
?>
