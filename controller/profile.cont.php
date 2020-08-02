<?php
require_once 'header.php';
require_once 'model/UserHandler.class.php';
if (isset($_POST['bio-submit'])) {
    $User = new UserHandler;
    $User->Set_user_bio_Handler($_POST['bio'], $_SESSION['userId']);
} else if (isset($_POST['cover-submit'])) {
    $User = new UserHandler;
    $User->Set_user_cover_image_Handler();
} else if (isset($_POST['submit'])) {
    $User = new UserHandler;
    $User->Set_user_profile_image_Handler();
}
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    require_once 'view/profile.view.php';
    Display_Profile();
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}
require_once 'footer.php';
