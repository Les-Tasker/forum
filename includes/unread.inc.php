<?php
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
