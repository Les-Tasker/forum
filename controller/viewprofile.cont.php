<?php

if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    require_once "view/viewprofile.view.php";
    View_profile();
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}
