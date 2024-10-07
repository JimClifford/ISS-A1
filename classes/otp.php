<?php
require_once('../settings/db_class.php');

class OTP {
    
    private $expiryTime = 120;  // OTP expiry time in seconds (2 minutes)
    private $db;                // Property to hold the database connection

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new db_connection();
    }

    // Generate a random OTP and set its expiry time
    public function generateOTP($email) {
        // Generate a random 6-digit number
        $otp = rand(100000, 999999);
        
        // Get the current timestamp and calculate OTP expiry time (2 minutes later)
        $currentTime = date('Y-m-d H:i:s'); // Current timestamp in 'Y-m-d H:i:s' format
        $expiryTime = date('Y-m-d H:i:s', strtotime($currentTime) + $this->expiryTime); // Expiry is 2 minutes after current time

        // Update the database with the generated OTP, current timestamp, and expiry time
        $sql = "UPDATE user_details 
                SET auth_pin = '$otp', last_update = '$currentTime', otp_expiry = '$expiryTime' 
                WHERE email = '$email'";

        // Execute the update query
        if ($this->db->db_query($sql)) {
            return $otp; // Return the generated OTP if the update is successful
        } else {
            return false; // Return false if the update fails
        }
    }

    // Validate if the OTP is still valid
    public function validateOTP($userId, $enteredOTP) {
        // Fetch the last_update, auth_pin, and otp_expiry timestamp for the user
        $sql = "SELECT last_update, auth_pin, otp_expiry FROM user_details WHERE id = '$userId'";
        $result = $this->db->db_fetch_one($sql);

        // Check if the OTP matches and is within the expiry time
        if ($result && $result['auth_pin'] === $enteredOTP) {
            $otpExpiry = strtotime($result['otp_expiry']); // Convert otp_expiry to Unix timestamp
            $currentTime = time(); // Get the current Unix timestamp

            // Check if the current time is before the OTP expiry time
            if ($currentTime <= $otpExpiry) {
                return true;  // OTP is valid
            }
        }

        return false;  // OTP is invalid or expired
    }
}
?>
