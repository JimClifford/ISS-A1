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
    public function generateOTP($email) {
        // Generate a random 6-digit number
        $otp = rand(100000, 999999);
    
        // Update the database with the generated OTP and current timestamp
        $sql = "UPDATE user_details SET auth_pin = '$otp' WHERE email = '$email'";
        
        // Prepare and execute the statement
        
    
        if ($this->db->db_query($sql)) {
            return $otp; // Return the generated OTP if the update is successful
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
        if ($result['auth_pin'] == $enteredOTP) {
            $lastUpdate = strtotime($result['last_update']); // Convert last_update to Unix timestamp
            
            $currentTime = time(); // Get the current Unix timestamp
    
            // Calculate time difference in seconds
            $timeDifference = $currentTime - $lastUpdate;
    
            if ($timeDifference <= 120) { // 120 seconds = 2 minutes
                return true;  // OTP is valid and within the 2-minute window
            } else {
                return false; // OTP has expired
            }
        }
    
        return false; // OTP does not match
    }
    }

    // $ndb = new db_connection();
    // $otp = new OTP();
    // $otp->validateOTP(2, 553123);
    // $sql = "SELECT last_update, auth_pin FROM user_details WHERE id = '2'";
    // $result =  $ndb->db_fetch_one($sql);
    // $lastUpdate = strtotime($result['last_update']); // Convert last_update to Unix timestamp
    // $currentTime = time(); // Get the current Unix timestamp
    // $timeDifference = $currentTime - $lastUpdate;
    // echo "Last Update:" . $lastUpdate;
    // echo "  Current Time:" . $currentTime;
    // echo "   Time Difference:" . $timeDifference;
    // exit();
?>
