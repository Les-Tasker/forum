<?php
if (isset($_POST['message-submit'])) {
    // If conneciton legitimate, connect to DB Handler
    require 'dbh.inc.php';
    // Fetch signup form info
    $from = $_POST['fromUser'];
    $to = $_POST['toUser'];
    $tz = 'Europe/London';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    $posted = $dt->format('d/m/Y H:i:s');
    $string = $_POST['message-body'];
    $url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
    $body = $string;
    $conID = $_POST['conID'];

    if (empty($body)) {
        // header("Location: ../profile.php?error=emptyfields");
        echo 'emtpy failed';
        exit();
    } else {

        if ($conn->connect_error) {
            header("Location: ../profile.php?error=DBCONNECT");
            die("Connection failed: " . $conn->connect_error);
        } else {
            // add new user info to DB
            $sql = "INSERT INTO messages (fromID,toID,msg,ts,conID,msgstatus)
            VALUES (?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "iissis", $from, $to, $body, $posted, $conID, $msgstatus = "DELIVERED");
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location:" . $_SERVER['HTTP_REFERER'] . '#reply-message');
            }
        }
    }
} else {
    header("Location: ../profile.php");
    exit();
}
