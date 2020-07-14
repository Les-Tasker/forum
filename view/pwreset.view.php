<?php
$email = $_GET['mail'];
$vcode = userVcode($email);
if (isset($_GET['mail']) && (isset($_GET['vcode']))) {
    if ($_GET['vcode'] == $vcode) {
?><div class="wrapper-main">
            <section class="section-default">
                <form class="signup" action="model/pwreset.inc.php" method="POST">
                    <h1>Enter your new password</h1>
                    <input type="hidden" name="mail" value="<?php $_GET['mail'] ?>">
                    <input type="hidden" name="vcode" value="<?php $_GET['vcode'] ?>">
                    <input type="password" name="password" placeholder="New Password">
                    <input type="password" name="passwordrepeat" placeholder="Confirm Password">
                    <button type="submit" name="submit">Submit</button>
                </form>
                <?php
                signup();
                ?>
            </section>
        </div>
    <?php
    } else {
    ?> <h1>Password reset link has expired </h1><br>
        <h1>Please request a new link</h1>
<?php   }
} else {
    header("Location: index.php");
}
