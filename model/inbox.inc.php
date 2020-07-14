<?php
function getusername($data)
{
    include 'dbh.inc.php';
    $sql2 = "SELECT * FROM users WHERE idUsers = '$data'";
    $result2 = mysqli_query($conn, $sql2);
    $resultCheck2 = mysqli_num_rows($result2);
    if ($resultCheck2 > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        echo $row2['uidUsers'];
    }
}
function getuserimg($data)
{
    include 'dbh.inc.php';
    $sql2 = "SELECT * FROM users WHERE idUsers = '$data'";
    $result2 = mysqli_query($conn, $sql2);
    $resultCheck2 = mysqli_num_rows($result2);
    if ($resultCheck2 > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        echo $row2['imgUsers'];
    }
}
function new_message($conID, $toid)
{
    include 'dbh.inc.php';
    $sql = "SELECT * FROM messages where conID = $conID AND toID = $toid AND msgstatus = 'DELIVERED'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        echo 'New Message';
    }
}
function display_inbox($userID)
{
    include 'dbh.inc.php';
    $sql = "SELECT * FROM messages where toID = '$userID' OR fromID = '$userID' GROUP BY conID ORDER BY ts DESC ";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // loop through all entries and echo out
        return $result;
    }
}
function msg_status($conID, $user)
{
    include 'dbh.inc.php';
    $sql = "UPDATE messages SET msgstatus = 'SEEN' WHERE conID = ? AND toID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "si", $conID, $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
function display_messages($conID)
{
    include 'dbh.inc.php';
    $sql = "SELECT * FROM messages  WHERE conID = '$conID'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // loop through all entries and echo out
        return $result;
    }
}
