<?php
//Check if valid form submit
if (isset($_POST['submit'])) {
    //create object
    $NewUser = new UserHandler;
    //execute object method
    $NewUser->userForgotPasswordHandler();
} else {
    // if not valid form submit display form
    require 'view/forgotpw.view.php';
}