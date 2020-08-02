<?php
session_start();
require 'model/UserHandler.class.php';
require 'view/header.view.php';
if (isset($_POST['login-submit'])) {
    $NewUser = new UserHandler;
    $NewUser->User_log_in_Handler();
}
if (isset($_POST['logout-submit'])) {
    $NewUser = new UserHandler;
    $NewUser->User_log_out_Handler();
}
