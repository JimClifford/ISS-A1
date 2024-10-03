<?php
// Include the User class
require('../classes/user.php');



function registerController($user_name, $email, $password) {
    // Create an instance of the User class
    $newUser = new User();

    // Return the addUser method
    return $newUser->addUser($user_name, $email, $password);

}
?>

