<?php
require_once 'header.php';
require_once './controller/signup.cont.php'
?>
<div class="wrapper-main">
    <section class="section-default">


        <form class="signup" action="controller/forgotpw.cont.php" method="POST">
            <h1>Please enter your email to reset your password</h1>
            <input type="text" name="email" placeholder="Email">
            <button type="submit" name="submit">Submit</button>
        </form>
        <?php
        signup() ?>
    </section>
</div>
<?php
require_once 'footer.php';
