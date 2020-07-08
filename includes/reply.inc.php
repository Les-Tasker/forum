<?php


// Check for legitimate connection via form submit
if (isset($_POST['reply-submit'])) {
    // If conneciton legitimate, connect to DB Handler
    require 'dbh.inc.php';
    // Fetch signup form info
    session_start();
    $toUser = $_POST['toUser'];
    $string = $_POST['reply-body'];
    $fromUser = $_POST['fromUser'];
    date_default_timezone_set('Europe/London');
    $posted = date('d/m/Y H:i:s');
    $url_pattern = '/(http|https|www|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
    $body = $string;



    // Form error check / Validate via PHP empty function
    if (empty($body)) {
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // add new comment info to DB
        $sql = "INSERT INTO inbox (fromUser, toUser, msgBody, timeSent) 
        VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "iiss", $toUser, $fromUser, $body, $posted);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("location:" . $_SERVER['HTTP_REFERER'] . '#comment-body-submit');
        }
    }
}
