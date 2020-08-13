<?php
//if new message sent from profile
if (isset($_POST['message-submit'])) {
    //load required files
    require_once "model/Message.class.php";
    //create new object
    $message = new MessageHandler;
    //execute object method
    $message->sendMessageFromProfileHandler();
}
//if new message submitted from inbox 
else if (isset($_POST['message-reply-submit'])) {
    //load required files
    require_once "model/Message.class.php";
    //create new object
    $message = new MessageHandler;
    //execute object method
    $message->ReplyInboxHandler();
}
//if no forms submitted, check for valid logged in user
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    //load required files    
    require_once "model/Message.class.php";
    require_once "model/User.class.php";
    require_once "view/messages.view.php";
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}