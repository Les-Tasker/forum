<?php
require_once "../model/UserHandler.class.php";
if ((isset($_GET['uid'])) && (isset($_GET['email'])) && (isset($_GET['vcode']))) {
    $NewUser = new UserHandler;
    $NewUser->Verify_new_user_Handler($_GET['email'], $_GET['vcode']);
}