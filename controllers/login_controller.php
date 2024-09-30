<?php
// Include the User class
require('../classes/user.php');

// Initialize the User class
$user = new User();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    
       // Validate the form data
        $result = $user->validateUser($email, $password);

        if ($result) {
            // Success - redirect or display a success message
            header("Location: ../view/success.php"); // Redirect to a success page
            exit();
        } else {
            $error = "Login failed. Please try again.";
            header("Location: ../view/login.php");
        }
    
}

?>

