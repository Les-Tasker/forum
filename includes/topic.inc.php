<?php

// Check for legitimate connection via form submit
if (isset($_POST['topic-submit'])) {
    // If conneciton legitimate, connect to DB Handler
    require 'dbh.inc.php';
    // Fetch signup form info
    session_start();
    $title = $_POST['topic-title'];
    $string = $_POST['topic-body'];
    $campus = $_POST['campus'];
    $course = $_POST['course'];
    $category = $_POST['category'];
    $author = $_SESSION['userUid'];
    $authorimg = $_SESSION['userImg'];
    $tz = 'Europe/London';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    $posted = $dt->format('d/m/Y H:i:s');
    $url_pattern = '/(http|https|www|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
    $body = $string;
    // Form error check / Validate via PHP empty function
    if (empty($title) || empty($body)) {
        header("Location: ../topiclist.php?campus=" . $campus . "&course=" . $course . "&category=" . $category . "&error=emptyfields");
        exit();
    } else {
        // add new user info to DB
        $sql = "INSERT INTO topics (author, title, body,dateposted,authorimg,campus,course,category)
        VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssss", $author, $title, $body, $posted, $authorimg, $campus, $course, $category);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ../topiclist.php?campus=" . $campus . "&course=" . $course . "&category=" . $category);
        }
    }
    // close connection to DB

}
