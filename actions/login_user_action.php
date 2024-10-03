<?php
require('../controllers/login_controller.php');
require('../controllers/otp_controller.php');
session_start();
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
        $user_id = $user->getUserIdByEmail($email);
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION["User"];
        if (generateOTPController($user_id)){
        header("Location: ../view/otp.php"); // Redirect to a otp page
        exit();   

        } else {
            $error = "There was an issue. Please try again.";
            header("Location: ../view/login.php");
        };
        
    } else {
            $error = "Login failed. Please try again.";
            header("Location: ../view/login.php");
     }
    
}





?>