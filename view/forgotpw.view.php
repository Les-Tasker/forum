<div class="wrapper-main">
    <section class="section-default">


        <form class="signup" action="forgotpw.php" method="POST">
            <h1>Please enter your email to reset your password</h1>
            <input type="text" name="email" placeholder="Email">
            <?php

            include_once "controller/notify.cont.php";
            notify(); ?>
            <button type="submit" name="submit">Submit</button>

        </form>


    </section>
</div>