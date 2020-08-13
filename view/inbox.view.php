<?php
function displayInbox($inbox)
{ ?>
<div class="main-content">
    <div class="outline">
        <h2>Chats With:</h2>
        <?php
            if (empty($inbox)) {
            } else {
                $newUser = new UserHandler;
                foreach ($inbox as $row) { ?>
        <div class="forum-category">
            <img class="topic-logo" src="uploads/<?php
                                                                if ($_SESSION['userId'] == $row['fromID']) {
                                                                    $newUser->getUserInfoByIdHandler($row['toID']);
                                                                    echo $newUser->Userimage;
                                                                } else {
                                                                    $newUser->getUserInfoByIdHandler($row['fromID']);
                                                                    echo $newUser->Userimage;
                                                                } ?>">
            <div class="topic-title-desc">
                <a class="topic-title" href="messages.php?toID=<?php
                                                                            if ($_SESSION['userId'] == $row['fromID']) {
                                                                                echo $row['toID'];
                                                                            } else {
                                                                                echo $row['fromID'];
                                                                            } ?>&conID=<?php echo $row['conID'] ?>">
                    <?php if ($_SESSION['userId'] == $row['fromID']) {
                                    $newUser->getUserInfoByIdHandler($row['toID']);
                                    echo $newUser->Username;
                                } else {
                                    $newUser->getUserInfoByIdHandler($row['fromID']);
                                    echo $newUser->Username;
                                } ?> </a>
            </div>
            <div class="topic-post-count">
                <?php $newMessage = new MessageHandler;
                            $newMessage->getNewMessageNotificationHandler($row['conID'], $_SESSION['userId']);
                            $mostRecent = $newMessage->getRecentMessageHandler($row['conID']) ?>

                <h6 class="topic-post-recent">Last
                    Message:<br><?php echo $mostRecent ?></h6>
            </div>
        </div>
        <?php }
            }
            ?>
    </div>
    <?php }