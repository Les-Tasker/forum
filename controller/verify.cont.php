<?php
require_once "../model/UserHandler.class.php";
if ((isset($_GET['uid'])) && (isset($_GET['email'])) && (isset($_GET['vcode']))) {
    $newUser = new UserHandler;
    $newUser->verifyNewUserHandler($_GET['email'], $_GET['vcode']);
}