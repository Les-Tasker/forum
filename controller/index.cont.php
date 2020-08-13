<?php
//Check valid user logged in
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    //load required files
    require_once 'model/CampusHandler.class.php';
    require_once 'model/TopicHandler.class.php';
    //create new object
    $newCampus = new CampusHandler;
    //execute object method
    $campus = $newCampus->getCampusHandler();
    //load view and display
    require_once 'view/index.view.php';
    displayCampus($campus);
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}