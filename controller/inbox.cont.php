<?php

function inbox()
{
    require "includes/dbh.inc.php";
    if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
        $toUser = $_SESSION['userId'];
        $sql = "SELECT COUNT(fromUser) AS Total, fromUser FROM inbox WHERE toUser = '$toUser' OR fromUser =  '$toUser'  GROUP BY fromUser HAVING COUNT(fromUser) >=1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $userid = $row['fromUser'];
                $sql2 = "SELECT * FROM users WHERE idUsers = '$userid'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo '<div class="main-content"><div class="forum-category">' . '
                            <img class="topic-logo" src="./uploads/' . $row2['imgUsers'] . '">
                           <div class="topic-title-desc">
                                <a class="topic-title" href="message.php?fromUser=' . $userid . '">' . $row2['uidUsers'] . '</a>
                                <hr>
                           </div>
                          </div>
                          </div>';
            }
        }
    }
}
