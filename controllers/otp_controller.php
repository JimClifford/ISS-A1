<?php
require('../classes/otp.php');
require('../vendor/autoload.php'); // This automatically includes all the required files

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    // function generateOTPController($userId) {
    //     // Create an instance of the OTP class
    //     $newOtp = new Otp();

    //     $otp = $newOtp->generateOTP($userId);
    //     if ($otp != false) {
    //         return true;
    //     } else {
    //         return false;
    //     }



        
    // }


    function validateOTPController($userId, $otp) {
        // Create an instance of the OTP class
        $newOtp = new OTP();
    
        // Call validateOTP function to check OTP validity
        $command = $newOtp->validateOTP($userId, $otp);
    
        // Check the result and return appropriate messages
        if ($command === "valid") {
            return "OTP is valid";
        } elseif ($command === "expired") {
            return "OTP is expired";
        } else {
            return "Invalid OTP";
        }
    }
    

function sendOTPController($email) {
    // Create an instance of the OTP class
    $mail = new PHPMailer(true);
    $otpInstance = new OTP();
    $otp = $otpInstance->generateOTP($email);

    // If OTP is successfully generated
    if ($otp != false) {
        try {
            // SMTP server configuration
            $mail->isSMTP();                                      // Use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = getenv('SMTP_USERNAME');            // SMTP username (use environment variables for security)
            $mail->Password = getenv('SMTP_PASSWORD');            // SMTP password (use App Password if 2FA is enabled)
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption
            $mail->Port = 587;                                    // TCP port to connect to
        
            // Sender and recipient settings
            $mail->setFrom(getenv('SMTP_FROM_EMAIL'), 'Ashesi Saints');  // Set sender (from email and name)
            $mail->addAddress($email);                            // Add recipient email
        
            // Subject and message body
            $mail->Subject = 'Your 6-digit verification code';
            $mail->Body    = "Hello,\n\nYour verification code is: " . $otp . "\n\nRegards,\nAshesi Saints";
        
            // Send the email
            $mail->send();
            return true;  // Email sent successfully
        } catch (Exception $e) {
            error_log('Mailer Error: ' . $mail->ErrorInfo);       // Log the error for debugging purposes
            return false;  // Failed to send email
        }
    }

    return false;  // Failed to generate OTP
}

?>