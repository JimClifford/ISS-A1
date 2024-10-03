<?php

require('../controllers/login_controller.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $email = $_POST['user_name'];
    $password = $_POST['password'];
   
    $user = new User();
       // Validate the form data
    $result = $user->validateUser($user_name, $password);

    if ($result) {
            // Success - redirect or display a success message
            header("Location: ../view/otp.php"); // Redirect to a success page
            exit();
    } else {
            $error = "Login failed. Please try again.";
            header("Location: ../view/login.php");
     }
    
}





?>