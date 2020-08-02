<div class="wrapper-main">
    <section class="section-default">
        <form class="signup" action="pwreset.php" method="POST">
            <h1>Enter your new password</h1>
            <input type="hidden" name="mail" value="<?php echo $email ?>">
            <input type="hidden" name="vcode" value="<?php echo $_GET['vcode'] ?>">
            <input type="password" name="password" placeholder="New Password">
            <input type="password" name="passwordrepeat" placeholder="Confirm Password">
            <button type="submit" name="submit">Submit</button>
        </form>

    </section>
</div>