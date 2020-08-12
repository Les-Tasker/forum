<?php
//if new message sent from profile
if (isset($_POST['message-submit'])) {
    //load required files
    require_once "model/MessageHandler.class.php";
    //create new object
    $Message = new MessageHandler;
    //execute object method
    $Message->Send_message_from_profile_Handler();
}
//if new message submitted from inbox 
else if (isset($_POST['message-reply-submit'])) {
    //load required files
    require_once "model/MessageHandler.class.php";
    //create new object
    $Message = new MessageHandler;
    //execute object method
    $Message->Reply_inbox_Handler();
}
//if no forms submitted, check for valid logged in user
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    //load required files    
    require_once "model/MessageHandler.class.php";
    require_once "model/UserHandler.class.php";
    require_once "view/messages.view.php";
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}