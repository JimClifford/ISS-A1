<?php
// Include the User class
require('../classes/user.php');


 function loginController($email, $password) {
    // Create an instance of the User class
    $newUser = new User();

    // Return the addUser method
    return $newUser->validateUser($email, $password);
}
  
function getUserID($email) {
    // Create an instance of the User class
    $newUser = new User();

    // Return the User Details
    return $newUser->getUserIdByEmail($email);
}

?>

