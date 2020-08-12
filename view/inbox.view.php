<?php
function displayInbox($inbox)
{ ?>
<div class="main-content">
    <div class="outline">
        <h2>Chats With:</h2>
        <?php
            if (empty($inbox)) {
            } else {
                $NewUser = new UserHandler;
                foreach ($inbox as $row) { ?>
        <div class="forum-category">
            <img class="topic-logo" src="uploads/<?php
                                                                if ($_SESSION['userId'] == $row['fromID']) {
                                                                    $NewUser->Get_user_info_by_id_Handler($row['toID']);
                                                                    echo $NewUser->Userimage;
                                                                } else {
                                                                    $NewUser->Get_user_info_by_id_Handler($row['fromID']);
                                                                    echo $NewUser->Userimage;
                                                                } ?>">
            <div class="topic-title-desc">
                <a class="topic-title" href="messages.php?toID=<?php
                                                                            if ($_SESSION['userId'] == $row['fromID']) {
                                                                                echo $row['toID'];
                                                                            } else {
                                                                                echo $row['fromID'];
                                                                            } ?>&conID=<?php echo $row['conID'] ?>">
                    <?php if ($_SESSION['userId'] == $row['fromID']) {
                                    $NewUser->Get_user_info_by_id_Handler($row['toID']);
                                    echo $NewUser->Username;
                                } else {
                                    $NewUser->Get_user_info_by_id_Handler($row['fromID']);
                                    echo $NewUser->Username;
                                } ?> </a>
            </div>
            <div class="topic-post-count">
                <?php $NewMessage = new MessageHandler;
                            $NewMessage->Get_new_message_notification_Handler($row['conID'], $_SESSION['userId']);
                            $MostRecent = $NewMessage->Get_recent_message_Handler($row['conID']) ?>

                <h6 class="topic-post-recent">Last
                    Message:<br><?php echo $MostRecent ?></h6>
            </div>
        </div>
        <?php }
            }
            ?>
    </div>
    <?php }