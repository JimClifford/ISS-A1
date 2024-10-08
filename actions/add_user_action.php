<?php
require('../controllers/register_controller.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validate the form data
    $newUser = registerController($name, $email, $password);
    // if the register process was successful
    if ($newUser !== false) {
            
            header("Location: ../view/login.php"); 
            exit();
    } else {
        // if the registration was unsuccessful
            $error = "Registration failed. Please try again.";
            header("Location: ../view/register.php");
    }
    
}








?>