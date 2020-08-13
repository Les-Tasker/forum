<?php

require 'header.php';
if (isset($_POST['submit'])) {
    $newUser = new UserHandler;
    $newUser->updateUserPasswordHandler();
}
if (isset($_GET['mail']) && (isset($_GET['vcode']))) {
    $email = $_GET['mail'];
    $newUser = new UserHandler;
    $newUser->getUserInfoByEmailHandler($email);
    if ($_GET['vcode'] == $newUser->Uservcode) {
        require "view/pwreset.view.php";
    } else {
?>
<div class="outline">

    <div class="main-content-logout">
        <h1>Password reset link has expired </h1><br>
        <h1>Please request a new link</h1>
        <?php }
}

require 'footer.php';