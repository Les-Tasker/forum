<?php
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    require_once 'model/CampusHandler.class.php';
    require_once 'model/TopicHandler.class.php';
    $NewCampus = new CampusHandler;
    $campus = $NewCampus->Get_campus_Handler();
    require_once 'view/index.view.php';
    Display_campus($campus);
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}