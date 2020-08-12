<?php
//Check if valid form submit
if (isset($_POST['submit'])) {
    //create object
    $NewUser = new UserHandler;
    //execute object method
    $NewUser->User_forgot_password_Handler();
} else {
    // if not valid form submit display form
    require 'view/forgotpw.view.php';
}