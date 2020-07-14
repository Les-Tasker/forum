<?php

function viewProfile()
{
    require "dbh.inc.php";
    $author = $_GET['author'];
    $sql = "SELECT * FROM users WHERE uidUsers = '$author'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // loop through all entries and echo out
        return $result;
    }
}
function display_unread($user)
{
    include 'dbh.inc.php';
    $sql = "SELECT * FROM messages WHERE toID = $user AND msgstatus = 'DELIVERED' ";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        echo $resultCheck;
    } else {
        echo '0';
    }
}
function userVcode($email)
{
    require "dbh.inc.php";
    $sql = "SELECT * FROM users where emailUsers='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['vcodeUsers'];
}
