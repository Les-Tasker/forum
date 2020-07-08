<?php
function headerControl()
{

    if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {?>
        <div class="dropdown">
            <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="header-user-img" src="uploads/<?php echo $_SESSION['userImg'] ?>"></button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <span ><?php echo $_SESSION['userUid'] ?></span>
                <a class="dropdown-item" href="profile.php">Profile <img src="img/profile.png"></a>
                <a class="dropdown-item" href="inbox.php">Inbox <img src="img/inbox.png"></a>
                <a class="dropdown-item" href="#">
                    <form action="includes/logout.inc.php" method="post">
                        <button class="logout-btn" type="submit" name="logout-submit">Logout<img src="img/logout.png"></button>
                    </form>
                </a>
            </div>
        </div>
        </nav>

    <?php
} else {?>
        <form class="login-input" action="includes/login.inc.php" method="post">
            <input type="text" name="mailuid" placeholder="Username/Email">
            <input type="password" name="pwd" placeholder="Password">
            <div class="login-button">
                <button type="submit" name="login-submit">Login</button>
                <span>or</span>
                <a href="signup.php">Signup</a></div>
            <?php
if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfield") {
            echo '<p class="loginerror"> Please Enter your login details. </p><a class="forgotpw" href="forgotpw.php">Forgot Password?</a>';
        } else if ($_GET['error'] == "wrongpwd") {
            echo '<p class="loginerror"> Invalid Password. </p><a class="forgotpw" href="forgotpw.php">Forgot Password?</a>';
        } else if ($_GET['error'] == "nouser") {
            echo '<p class="loginerror"> Username / Email not recognized. </p><a class="forgotpw" href="forgotpw.php">Forgot Password?</a>';
        }
    }
        ?>
        </form><?php
}
}
?>

