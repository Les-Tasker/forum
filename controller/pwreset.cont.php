<?php

require 'header.php';
if (isset($_POST['submit'])) {
    $NewUser = new UserHandler;
    $NewUser->Update_user_password_Handler();
}
if (isset($_GET['mail']) && (isset($_GET['vcode']))) {
    $email = $_GET['mail'];
    $NewUser = new UserHandler;
    $NewUser->Get_user_info_by_email_Handler($email);
    if ($_GET['vcode'] == $NewUser->Uservcode) {
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