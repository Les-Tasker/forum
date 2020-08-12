<?php
//Check valid user logged in
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    //load required files
    require_once 'model/CampusHandler.class.php';
    require_once 'model/TopicHandler.class.php';
    //create new object
    $NewCampus = new CampusHandler;
    //execute object method
    $campus = $NewCampus->Get_campus_Handler();
    //load view and display
    require_once 'view/index.view.php';
    Display_campus($campus);
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}