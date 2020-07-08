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
    $url_pattern = '/(http|https|www|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
    $body = $string;

    if (empty($body)) {
        // header("Location: ../profile.php?error=emptyfields");
        echo 'emtpy failed';
        exit();
    } else {

        // ------
        // Create connection
        $conn = new mysqli($servername, $dBUsername, $dBPassword, $dBName);
        // Check connection
        if ($conn->connect_error) {
            // WORKS!!! Returns an error if i change anything in server info
            header("Location: ../profile.php?error=DBCONNECT");
            die("Connection failed: " . $conn->connect_error);
        } else {
            // add new user info to DB
            $sql = "INSERT INTO inbox (fromUser,toUser,msgBody,timeSent)
            VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "iiss", $from, $to, $body, $posted);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: ../inbox.php");
            }
        }
    }
} else {
    header("Location: ../profile.php");
    exit();
}
