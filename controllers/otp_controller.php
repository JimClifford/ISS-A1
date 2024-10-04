<?php
require('../classes/otp.php');
require ('../vendor/autoload.php'); // This automatically includes all the required files

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
    $newOtp = new Otp();

    $command = $newOtp->validateOTP($userId, $otp);
    if ($command) {
        return true;
    } else {
        return false;
    }
}


function sendOTPController($email) {
    // Create an instance of the OTP class
    

    $mail = new PHPMailer(true);
    $ot = new Otp();
    $otp = $ot->generateOTP($email);

    if ($otp != false){
        try {
            // SMTP server configuration
            $mail->isSMTP();                                      // Use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'jim200118@gmail.com';             // SMTP username (your Gmail email)
            $mail->Password = 'wdmq chpf hahi dthf';                // SMTP password (use App Password if 2FA is enabled)
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption
            $mail->Port = 587;                                    // TCP port to connect to
        
            // Sender and recipient settings
            $mail->setFrom('jim200118@gmail.com', 'Ashesi Saints');   // Set the sender of the email
            $mail->addAddress($email);              // Add recipient
        
            // Subject and message body
                                 // Generate a random 4-digit number
            $mail->Subject = 'Your 6-digit verification code';
            $mail->Body    = "Hello,\n\nYour verification code is: " . $otp . "\n\nRegards,\n Ashesi Saints ";
        
            // Send the email
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    return false;


}



?>