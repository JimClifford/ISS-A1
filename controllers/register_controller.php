<?php
// Include the User class
require('../classes/user.php');



function registerController($user_name, $email, $password) {
    // Create an instance of the User class
    $newUser = new User();

    // Return the User Detail
    return $newUser->addUser($user_name, $email, $password);

}
?>

