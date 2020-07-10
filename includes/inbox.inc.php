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
function display_inbox($userID)
{
    include 'dbh.inc.php';

    $sql = "SELECT * FROM messages where toID = '$userID' OR fromID = '$userID' GROUP BY conID  ";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // loop through all entries and echo out
        while ($row = mysqli_fetch_assoc($result)) {
?>

            <div class="forum-category">
                <img class="topic-logo" src="uploads/profiledefault.jpg">
                <div class="topic-title-desc">
                    <a class="topic-title" href="">

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
                <div class="topic-post-count">Messages: </div>
                <h6 class="topic-post-recent">Last Message: <?php echo $row['ts'] ?></h6>
            </div>

<?php }
    }
}
