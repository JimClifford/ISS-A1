<?php
require(`../classes/otp.php`);

function generateOTPController($userId) {
    // Create an instance of the OTP class
    $newOtp = new Otp();

    $command = $newOtp->generateOTP($userId);
    if ($command) {
        return true;
    } else {
        return false;
    }



    
}

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



?>