<?php
function loggedOut()
{



?>
<div class="main-content-logout">
    <h1>You need to be logged in to view the forum</h1><br>
    <h1>If you have registered, please check your email to verify your account</h1><br><a href="signup.php">Click
        here to register</a>
    <?php include_once "controller/notify.cont.php";
        notify(); ?>
</div>
</div>
<?php }