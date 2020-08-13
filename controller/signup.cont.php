<?php

if (isset($_POST['signup-submit'])) {

    include_once "model/UserHandler.class.php";
    $NewUser = new UserHandler;
    $NewUser->signupNewUserHandler();
}
include_once "header.php";
include_once "view/signup.view.php";

include_once "footer.php";