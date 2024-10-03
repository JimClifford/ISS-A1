<?php
require_once('../settings/db_class.php');

class OTP {
    
    private $expiryTime = 120;  // OTP expiry time in seconds (2 minutes)
    // Property to hold the database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new db_connection();
    }


    // Generate a random OTP
    public function generateOTP($userId) {
        // Generate a random 6-digit number
        $otp = rand(100000, 999999);
    
        // Update the database with the generated OTP and current timestamp
        $sql = "UPDATE user_details SET auth_pin = '$otp' WHERE id = '$userId'";
        
        // Prepare and execute the statement
        $run_query = $this->db->db_query($sql);
        
        if ($run_query) {
            return true; // Return the generated OTP if the update is successful
        } else {
            return false; // Return false if the update fails
        }
    }
    

    // Validate if the OTP is still valid
    public function validateOTP($userId, $enteredOTP) {
        // Fetch the last_update timestamp for the user
        $sql = "SELECT last_update, auth_pin FROM user_details WHERE id = '$userId'";
        $result =  $this->db->db_fetch_one($sql);



        // Check if the OTP matches and if it is within the expiry time
        if ($result['auth_pin'] === $enteredOTP) {
            // Calculate the time difference in seconds
            $timeDifference = time() - strtotime($result['last_update']);

            // Validate if the OTP is still valid
            if ($timeDifference <= $this->expiryTime) {
                return true;  // OTP is valid
            }
        }

        return false;  // OTP is invalid or expired
    }
}
?>
