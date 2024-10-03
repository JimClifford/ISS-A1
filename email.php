<?php
require 'vendor/autoload.php'; // This automatically includes all the required files

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Create a new PHPMailer object
$mail = new PHPMailer(true);

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
    $mail->setFrom('jim200118@gmail.com', 'Jim');   // Set the sender of the email
    $mail->addAddress('jimcliffordedward@gmail.com');              // Add recipient

    // Subject and message body
    $random_number = rand(1000, 9999);                     // Generate a random 4-digit number
    $mail->Subject = 'Your 4-digit verification code';
    $mail->Body    = "Hello,\n\nYour verification code is: " . $random_number . "\n\nRegards,\nYour Team";

    // Send the email
    $mail->send();
    echo "Email successfully sent!";
} catch (Exception $e) {
    echo "Email sending failed. Error: {$mail->ErrorInfo} lol";
}
?>
