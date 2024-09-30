<?php
// Include the User class
require('../classes/user.php');

// Initialize the User class
$user = new User();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $contactNumber = $_POST['contactNumber'];
    // Validate the form data
    $result = $user->addUser($name, $email, $password, $country, $city, $contactNumber);

    if ($result) {
            
            header("Location: ../view/success.php"); // Redirect to a success page
            exit();
    } else {
            $error = "Registration failed. Please try again.";
            header("Location: ../view/register.php");
    }
    
}

?>

