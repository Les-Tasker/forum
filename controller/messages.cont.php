<?php

if (isset($_POST['message-submit'])) {
    require_once "model/MessageHandler.class.php";
    $Message = new MessageHandler;
    $Message->Send_message_from_profile_Handler();
} else if (isset($_POST['message-reply-submit'])) {
    require_once "model/MessageHandler.class.php";
    $Message = new MessageHandler;
    $Message->Reply_inbox_Handler();
}
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    require_once "model/MessageHandler.class.php";
    require_once "model/UserHandler.class.php";
    require_once "view/messages.view.php";
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}
