<?php

if (isset($_POST['signup-submit'])) {

    include_once "model/UserHandler.class.php";
    $NewUser = new UserHandler;
    $NewUser->Signup_new_user_Handler();
}
include_once "header.php";
include_once "view/signup.view.php";

include_once "footer.php";