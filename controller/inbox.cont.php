<?php

require_once "header.php";
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    require_once "model/Message.class.php";
    require_once "view/inbox.view.php";
    $newMessage = new MessageHandler;
    $inbox = $newMessage->getInboxHandler($_SESSION['userId']);
    displayInbox($inbox);
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}
require_once "footer.php";