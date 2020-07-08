<?php

function message()
{
    //Connect to Database

    require "includes/dbh.inc.php";

    //If there is a session active then user is logged in an able to see content and-
    //-If userVerified == TRUE then user has successfully activated account via email.

    if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
        $fromUser = $_GET['fromUser'];
        $toUser = $_SESSION['userId'];

        //Select all messages from inbox where data matches parameters fromUser and toUser to display specific conversation

        $sql = "SELECT * FROM inbox  WHERE fromUser = '$fromUser' AND toUser = '$toUser' OR  fromUser = '$toUser' AND toUser = '$fromUser' ORDER BY timeSent ASC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="main-content">';
            while ($row = mysqli_fetch_assoc($result)) {
                $from = $row['fromUser'];
                $sql2 = "SELECT * FROM users  WHERE idUsers = '$from' ";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $posterImg = $row2['imgUsers'];?>


                <div class="forum-topic-post">
                    <div class="forum-topic-post-poster">
                        <img class="comment-img" src="uploads/<?php echo $posterImg ?>" />
                        <a class="forum-topic-post-poster-author" href="./viewprofile.php?author=<?php echo $row2['uidUsers'] ?>"><?php echo $row2['uidUsers'] ?></a>
                    </div>
                    <div class="forum-topic-post-content">
                        <p>
                            <?php echo $row['msgBody'] ?>
                        </p>
                        <h6>Sent: <?php echo $row['timeSent'] ?></h6>
                    </div>
                </div>

            <?php
}?>
            </div>
            <br>
            <form id="comment-form" action="includes/reply.inc.php" method="POST">
                <h5>Reply</h5>
                <input type="hidden" name="toUser" value="<?php echo $toUser ?>">
                <input type="hidden" name="fromUser" value="<?php echo $fromUser ?>">
                <textarea name="reply-body" id="comment-body" cols="30" rows="5"></textarea>
                <button id="comment-body-submit" type="submit" name="reply-submit">Post</button>
            </form><?php
}
    }
}
