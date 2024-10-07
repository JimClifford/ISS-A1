<?php
require('../controllers/otp_controller.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Handle new OTP generation request
    if (isset($_POST['action']) && $_POST['action'] === 'request_new_otp') {
        // Ensure user's email is stored in the session
        if (isset($_SESSION['user_email'])) {
            $email = $_SESSION['user_email'];
            
            // Send the OTP and respond to the request
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
        // OTP validation logic
        if (isset($_SESSION['user_id']) && isset($_POST['otp'])) {
            $user_id = $_SESSION['user_id'];
            $userOtpInput = $_POST['otp'];

            // Validate the OTP
            $validationResult = validateOTPController($user_id, $userOtpInput);

            if ($validationResult === "OTP is valid") {
                // Redirect to success page if OTP is valid
                header("Location: ../view/success_page.php");
                exit();
            } else {
                // Redirect back with an error message if OTP is invalid or expired
                header("Location: ../view/otp.php?error=" . urlencode($validationResult));
                exit();
            }
        }
    }
}
?>
