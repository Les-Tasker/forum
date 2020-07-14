<?php
session_start();
$id = $_SESSION['userId'];
if (isset($_POST['bio-submit'])) {
    // If conneciton legitimate, connect to DB Handler
    require 'dbh.inc.php';
    // Fetch signup form info
    $text = $_POST['bio'];
    $pattern = array("<", ">");
    $replace = array("", "");
    $text = str_replace($pattern, $replace, $text);
    $url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    $text = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $text);
    $bio = $text;

    if (empty($bio)) {
        header("Location: ../profile.php?error=emptyfields");
        exit();
    } else {


        if ($conn->connect_error) {
            header("Location: ../profile.php?error=DBCONNECT");
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE users SET
        bioUsers=? WHERE idUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "si", $bio, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            $_SESSION['userBio'] = $bio;
            header("Location: ../profile.php?conn=updsuc");
        }
    }
} else {
    header("Location: ../profile.php");
    exit();
}
