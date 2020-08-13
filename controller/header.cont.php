<?php
//Start session in header to enable session in all pages site wide
session_start();
//load required files
require 'model/UserHandler.class.php';
require 'view/header.view.php';
//if login form submitted
if (isset($_POST['login-submit'])) {
    //create new object
    $NewUser = new UserHandler;
    //execute object login method
    $NewUser->userLogInHandler();
}
//if logout form submitted
if (isset($_POST['logout-submit'])) {
    //create new object
    $NewUser = new UserHandler;
    //execute object logout method
    $NewUser->userLogOutHandler();
}