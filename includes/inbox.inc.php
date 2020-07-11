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
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="forum-category">
                <img class="topic-logo" src="uploads/profiledefault.jpg">
                <div class="topic-title-desc"> <a class="topic-title" href="messages.php?toID=<?php
                                                                                                if ($userID == $row['fromID']) {
                                                                                                    echo $row['toID'];
                                                                                                } else {
                                                                                                    echo $row['fromID'];
                                                                                                }
                                                                                                ?>&conID=<?php echo $row['conID'] ?>">
                        <?php
                        if ($userID == $row['fromID']) {
                            getusername($row['toID']);
                        } else {
                            getusername($row['fromID']);
                        }
                        ?>
                    </a>
                    <hr>
                    <p>Sample Message</p>
                </div>
                <div class="topic-post-count"><?php new_message($row['conID'], $_SESSION['userId']) ?> </div>

                <h6 class="topic-post-recent">Last Message: <?php echo $row['ts'] ?></h6>
            </div>
            <?php }
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
        while ($row = mysqli_fetch_assoc($result)) {
            if ($_SESSION['userId'] == $row['fromID'] || $_SESSION['userId'] == $row['toID']) {
                $stat = strtolower($row['msgstatus']);
                if ($_SESSION['userId'] == $row['toID']) {
                    msg_status($conID, $_SESSION['userId']);
                }
            ?>
                <div class="forum-topic-post">
                    <div class="forum-topic-post-poster">
                        <img class="comment-img" src="./uploads/profiledefault.jpg">
                        <a class="forum-topic-post-poster-author" href="./viewprofile.php?author=<?php getusername($row['fromID']); ?>"><?php getusername($row['fromID']);                ?></a>
                    </div>
                    <div class="forum-topic-post-content">
                        <p><?php echo $row['msg'] ?>
                        </p>
                        <h6>
                            Sent: <?php echo $row['ts'] ?>
                        </h6>
                        <h6><i>
                                <?php echo $stat ?></i>
                        </h6>
                    </div>
                </div>
<?php

            }
        }
    }
}
