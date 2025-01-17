<?php
// Include the db_connection class
require('../settings/db_class.php');

class User {
    // Property to hold the database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new db_connection();
    }

    // Method to add a new user
    public function addUser($user_name, $email, $password) {
        // Escape user inputs to prevent SQL injection
        $user_name = mysqli_real_escape_string($this->db->db_conn(), $user_name);
        $email = mysqli_real_escape_string($this->db->db_conn(), $email);
        $password = mysqli_real_escape_string($this->db->db_conn(), $password);
        
        // Encrypt password (optional: use password_hash() for better security)
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // SQL query to insert the user
        $sql = "INSERT INTO user_details (user_name, email, password) VALUES ('$user_name', '$email', '$hashedPassword')";

        // Execute the query using db_query_escape_string
        return $this->db->db_query_escape_string($sql);
    }

   
    // Method to validate user login
    public function validateUser($user_name, $password) {
        // Sanitize the input values to prevent SQL injection
        $user_name = mysqli_real_escape_string($this->db->db_conn(), $user_name);
        
        // SQL query to fetch user details based on the provided username
        $sql = "SELECT * FROM user_details WHERE user_name = '$user_name'";
        
        // Fetch the user record from the database
        $user = $this->db->db_fetch_one($sql);
    
        // Check if user exists
        if ($user) {
            // Verify the entered password against the hashed password in the database
            if (password_verify($password, $user['password'])) {
                // If password is valid, return user data
                return $user;
            } else {
                // If password does not match, return false
                return false;
            }
        } else {
            // If no user is found, return false
            return false;
        }
    }
    

    public function getUserIdByEmail($email) {
        // Sanitize the email input
        $email = mysqli_real_escape_string($this->db->db_conn(), $email);
        
        // Create the SQL query to fetch the user id based on the email
        $sql = "SELECT id FROM user_details WHERE email = '$email'";
        
        // Fetch and return the user id if found
        $result = $this->db->db_fetch_one($sql);
        
        // Return the user id if found, otherwise return false
        return $result ? $result['id'] : false;
    }
    
} 
?>
