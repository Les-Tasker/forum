<?php
require_once 'header.php';
require_once 'model/UserHandler.class.php';
//chekc if froms submitted
if (isset($_POST['bio-submit'])) {
    //create new object
    $user = new UserHandler;
    //execute object method
    $user->setUserBioHandler($_POST['bio'], $_SESSION['userId']);
} //chekc if froms submitted
else if (isset($_POST['cover-submit'])) {
    //create new object
    $user = new UserHandler;
    //execute object method
    $user->setUserCoverImageHandler();
} //chekc if froms submitted
else if (isset($_POST['submit'])) {
    //create new object
    $user = new UserHandler;
    //execute object method
    $user->setUserProfileImageHandler();
} //if no form submitted, check if valid user logged in
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    //display profile
    require_once 'view/profile.view.php';
    displayProfile();
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}
require_once 'footer.php';