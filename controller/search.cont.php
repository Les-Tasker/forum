<?php
require_once 'model/TopicHandler.class.php';
require_once 'model/CommentHandler.class.php';
include_once "model/DBConnHandler.class.php";
if (!empty($_POST['search-string'])) {
    // Visible when logged in
    if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
        echo '<div class="main-content">';
        if (isset($_POST['search-submit'])) {
            require_once "view/search.view.php";
        }
    } else {
        //if user is not logged in or user is logged in but not verified
        //run loggedOut function which prompts user to login / check verification email
        require_once "view/loggedout.view.php";
        loggedOut();
    }
} else {
    header("location:" . $_SERVER['HTTP_REFERER']);
}