<?php
require_once 'header.php';
require_once 'model/UserHandler.class.php';
//chekc if froms submitted
if (isset($_POST['bio-submit'])) {
    //create new object
    $User = new UserHandler;
    //execute object method
    $User->Set_user_bio_Handler($_POST['bio'], $_SESSION['userId']);
} //chekc if froms submitted
else if (isset($_POST['cover-submit'])) {
    //create new object
    $User = new UserHandler;
    //execute object method
    $User->Set_user_cover_image_Handler();
} //chekc if froms submitted
else if (isset($_POST['submit'])) {
    //create new object
    $User = new UserHandler;
    //execute object method
    $User->Set_user_profile_image_Handler();
} //if no form submitted, check if valid user logged in
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    //display profile
    require_once 'view/profile.view.php';
    Display_Profile();
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}
require_once 'footer.php';