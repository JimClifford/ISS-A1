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
        $user_name = mysqli_real_escape_string($this->db->db_conn(), $user_name);
        $password = mysqli_real_escape_string($this->db->db_conn(), $password);

        // Encrypt password (md5 or you can use password_hash() and password_verify())
        $hashed_password = md5($password);

        $sql = "SELECT * FROM user_details WHERE user_name = '$user_name' AND password = '$hashed_password'";

        // Fetch and return user if found
        return $this->db->db_fetch_one($sql);
    }
}
?>
