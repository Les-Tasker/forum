<?php

if (isset($_POST['signup-submit'])) {

    include_once "model/UserHandler.class.php";
    $NewUser = new UserHandler;
    $NewUser->Signup_new_user_Handler();
}
include_once "header.php";
include_once "view/signup.view.php";
include_once "footer.php";
function signup()
{
    // Funciton was orignally intented for displaying error messages for the signup page,
    // however I have modified and reused this function as a general error message display function for the user
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
            echo '<p class="signuperror"> Please fill in all fields. </p>';
        } else if ($_GET['error'] == "invalidmailuid") {
            echo '<p class="signuperror"> Invalid Username and Email. </p>';
        } else if ($_GET['error'] == "invalidmail") {
            echo '<p class="signuperror"> Email must be a valid SAE Institute email. </p>';
        } else if ($_GET['error'] == "uid") {
            echo '<p class="signuperror"> Invalid Username, please use only A-Z 0-9. </p>';
        } else if ($_GET['error'] == "fname") {
            echo '<p class="signuperror"> Invalid Name, please use only A-Z. </p>';
        } else if ($_GET['error'] == "lname") {
            echo '<p class="signuperror"> Invalid Last name, please use only A-Z. </p>';
        } else if ($_GET['error'] == "campus") {
            echo '<p class="signuperror"> Invalid Campus Name, please use only A-Z. </p>';
        } else if ($_GET['error'] == "usertaken") {
            echo '<p class="signuperror"> Username already in use. </p>';
        } else if ($_GET['error'] == "emailtaken") {
            echo '<p class="signuperror"> Email already in use. </p>';
        }
    } else if (isset($_GET["signup"])) {
        echo '<p class="signupsuccess"> You have successfully signed up. <br> Please check your email to verify your account </p>';
    } else if (isset($_GET["pwreset"])) {
        echo '<p class="signupsuccess"> Please check your email to reset your password </p>';
    } else if (isset($_GET["pwreseterror"])) {
        echo '<p class="signuperror"> Email not recognised </p>';
    } else if (isset($_GET["pwresetexpired"])) {
        echo '<p class="signuperror"> Password Reset Link is invalid, please request a new link </p>';
    } else if (isset($_GET["pwresetsuccess"])) {
        echo '<p class="signupsuccess"> Password has been successfully changed </p>';
    }
}
