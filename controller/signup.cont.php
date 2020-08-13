<?php

if (isset($_POST['signup-submit'])) {

    include_once "model/User.class.php";
    $newUser = new UserHandler;
    $newUser->signupNewUserHandler();
}
include_once "header.php";
include_once "view/signup.view.php";

include_once "footer.php";