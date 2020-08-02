<?php

if (isset($_POST['submit'])) {
    $NewUser = new UserHandler;
    $NewUser->User_forgot_password_Handler();
} else {
    require 'view/forgotpw.view.php';
}
