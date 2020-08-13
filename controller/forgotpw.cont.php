<?php
//Check if valid form submit
if (isset($_POST['submit'])) {
    //create object
    $newUser = new UserHandler;
    //execute object method
    $newUser->userForgotPasswordHandler();
} else {
    // if not valid form submit display form
    require 'view/forgotpw.view.php';
}