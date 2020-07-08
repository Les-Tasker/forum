<?php

// Check for legitimate connection via form submit
if (isset($_POST['comment-submit'])) {
    // If conneciton legitimate, connect to DB Handler
    require 'dbh.inc.php';
    // Fetch signup form info
    session_start();
    $topicid = $_POST['topicid'];
    // $body = $_POST['comment-body'];
    $author = $_SESSION['userUid'];
    $tz = 'Europe/London';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    $posted = $dt->format('d/m/Y H:i:s');
    //code to process URL to clickable link - Causes problems with quotes and double quotes

    // $url_pattern = '/(http|https|www|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    // $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
    // $body = $string;

    //As HTML tags are not valid in the Reply form, I have created my own [quote] tags that are harmless
    //I then run the [quote] tag through str_replace() and substitute for <blockquote> tags before entering to DB
    //This enables a quote system to work and display correctly whilst removing the ability to alter HTML code (so far)
    $pattern = array("[quote]", "[/quote]", "[br]", "<div>", "</div>", "[b]", "[/b]", "<i>", "</i>", "<a");
    $replace = array("<blockquote>", "</blockquote>", "<br>", "", "", "<b>", "</b>", "", "", "");
    $body = str_replace($pattern, $replace, $_POST['comment-body']);

    // Form error check / Validate via PHP empty function

    if (empty($body)) {
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // add new comment info to DB
        $sql = "INSERT INTO comments (author, posted, body, topicid)
        VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssi", $author, $posted, $body, $topicid);
            mysqli_stmt_execute($stmt);
        }
        // update topics table to show time of most recent comment
        $sql = "UPDATE topics SET recent = ? WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "si", $posted, $topicid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("location:" . $_SERVER['HTTP_REFERER'] . "#comment-body");
        }
    }
}
