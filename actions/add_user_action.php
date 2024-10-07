<?php
require('../controllers/register_controller.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validate the form data
    $newUser = registerController($name, $email, $password);

    if ($newUser !== false) {
        header("Location: ../view/login.php"); 
        exit();
    } else {
        $error = "Registration failed. Please try again.";
        header("Location: ../view/register.php");
    }
    
} else {
        echo "Registration failed. Please try again.";
        exit();
    }


?>