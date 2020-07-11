<?php

require 'header.php';
require "./controller/signup.cont.php";

require "./includes/dbh.inc.php";
$email = $_GET['mail'];
$sql2 = "SELECT * FROM users where emailUsers='$email'";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);
if (isset($_GET['mail']) && (isset($_GET['vcode']))) {

    if ($_GET['vcode'] == $row['vcodeUsers']) {
        echo '<div class="wrapper-main">
    <section class="section-default">
        <form class="signup" action="includes/pwreset.inc.php" method="POST">
            <h1>Enter your new password</h1>

            <input type="hidden" name="mail" value="' . $_GET['mail'] . '">
            <input type="hidden" name="vcode" value="' . $_GET['vcode'] . '">
            <input type="password" name="password" placeholder="New Password">
            <input type="password" name="passwordrepeat" placeholder="Confirm Password">
            <button type="submit" name="submit">Submit</button>
        </form>';
        signup();
        echo '</section></div>';
    } else {
        echo '<h1>Password reset link has expired </h1><br><h1>Please request a new link</h1>';
    }
} else {
    header("Location: index.php");
}


require_once 'footer.php';
