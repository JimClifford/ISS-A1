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
    public function addUser($name, $email, $password, $country, $city, $contactNumber) {
        // Escape user inputs to prevent SQL injection
        $name = mysqli_real_escape_string($this->db->db_conn(), $name);
        $email = mysqli_real_escape_string($this->db->db_conn(), $email);
        $password = mysqli_real_escape_string($this->db->db_conn(), $password);
        $country = mysqli_real_escape_string($this->db->db_conn(), $country);
        $city = mysqli_real_escape_string($this->db->db_conn(), $city);
        $contactNumber = mysqli_real_escape_string($this->db->db_conn(), $contactNumber);

        // Encrypt password (optional: use password_hash() for better security)
        $hashed_password = md5($password);

        // SQL query to insert the user
        $sql = "INSERT INTO user (full_name, email, password,country,city,contact_number) VALUES ('$name', '$email', '$hashed_password', '$country', '$city', '$contactNumber')";

        // Execute the query using db_query_escape_string
        return $this->db->db_query_escape_string($sql);
    }

   
    // Method to validate user login
    public function validateUser($email, $password) {
        $email = mysqli_real_escape_string($this->db->db_conn(), $email);
        $password = mysqli_real_escape_string($this->db->db_conn(), $password);

        // Encrypt password (md5 or you can use password_hash() and password_verify())
        $hashed_password = md5($password);

        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$hashed_password'";

        // Fetch and return user if found
        return $this->db->db_fetch_one($sql);
    }
}
?>
