<?php
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) { ?>

    <div class="main-content">
        <h2>Chats With:</h2>
        <?php
        if (empty($inbox)) {
        } else {
            foreach ($inbox as $row) { ?>
                <div class="forum-category">
                    <img class="topic-logo" src="uploads/
                    <?php if ($_SESSION['userId'] == $row['fromID']) {
                        getuserimg($row['toID']);
                    } else {
                        getuserimg($row['fromID']);
                    } ?>">
                    <div class="topic-title-desc"> <a class="topic-title" href="messages.php?toID=
                    <?php if ($_SESSION['userId'] == $row['fromID']) {
                        echo $row['toID'];
                    } else {
                        echo $row['fromID'];
                    } ?>&conID=
                    <?php echo $row['conID'] ?>">
                            <?php if ($_SESSION['userId'] == $row['fromID']) {
                                getusername($row['toID']);
                            } else {
                                getusername($row['fromID']);
                            } ?>
                        </a>
                        <hr>
                        <p>Sample of message</p>
                    </div>
                    <div class="topic-post-count"><?php new_message($row['conID'], $_SESSION['userId']) ?> </div>

                    <h6 class="topic-post-recent">Last Message: <?php echo $row['ts'] ?></h6>
                </div>
        <?php }
        }
        ?>
    </div>
<?php }
