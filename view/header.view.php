<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/sae.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/style.css">
    <title>SAE Student Forum</title>
</head>


<body>

    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a class="navbar-brand" href="index.php"><img id="logo-sae" src="./img/saenav.png" alt="SAE Logo" /></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>





            <?php
            if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) { ?>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="profile.php" class="nav-item nav-link">Profile</a>
                    </div>
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="header-user-img" src="uploads/<?php echo $_SESSION['userImg'] ?>"></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <span><?php echo $_SESSION['userUid'] ?></span>
                            <a class="dropdown-item" href="profile.php">Profile <img src="img/profile.png"></a>
                            <a class="dropdown-item" href="inbox.php">
                                <span class="unread"><?php display_unread($_SESSION['userId']); ?></span> Inbox <img src="img/inbox.png">
                            </a>
                            <a class="dropdown-item" href="#">
                                <form action="model/logout.inc.php" method="post">
                                    <button class="logout-btn" type="submit" name="logout-submit">Logout<img src="img/logout.png"></button>
                                </form>
                            </a>
                        </div>
                    </div>
        </nav>

    <?php

            } else { ?>
        <form class="login-input" action="model/login.inc.php" method="post">
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

                ?>

    </header>
    <div class="wrapper">
        <div class="f-banner">

        </div>