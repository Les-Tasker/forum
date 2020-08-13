<div class="main-content">
    <div class="outline">
        <?php
        $message = new MessageHandler;
        $messages = $message->getMessagesHandler($_GET['conID']);
        $newUser = new UserHandler;
        ?>

        <h2>Messages to <?php $newUser->getUserInfoByIdHandler($_GET['toID']);
                        echo $newUser->Username; ?></h2>

        <?php
        if (empty($messages)) {
        } else {

            foreach ($messages as $row) {
                if ($_SESSION['userId'] == $row['fromID'] || $_SESSION['userId'] == $row['toID']) {
                    $stat = strtolower($row['msgstatus']);
                    if ($_SESSION['userId'] == $row['toID']) {
                        $conID = $_GET['conID'];
                        $message->setMsgStatusHandler($conID, $_SESSION['userId']);
                    }
        ?>
        <div class="forum-topic-post">
            <div class="forum-topic-post-poster">
                <img class="comment-img" src="uploads/<?php $newUser->getUserInfoByIdHandler($row['fromID']);
                                                                    echo $newUser->Userimage; ?>">
                <a class="forum-topic-post-poster-author"
                    href="./viewprofile.php?author=<?php $newUser->getUserInfoByIdHandler($row['fromID']);
                                                                                                        echo $newUser->Username; ?>">


                    <?php $newUser->getUserInfoByIdHandler($row['fromID']);
                                echo $newUser->Username; ?></a>
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
            } ?>
        <form action="messages.php" method="post" id="reply-message">
            <input type="hidden" name="fromUser" value="<?php echo $_SESSION['userId'] ?>">
            <input type="hidden" name="toUser" value="<?php echo $_GET['toID'] ?>">
            <input type="hidden" name="conID" value="<?php echo $_GET['conID'] ?>">
            <textarea name="message-body" id="message-textarea" cols="40" rows="5"
                placeholder="Say something..."></textarea>

            <button class="message-submit" type="submit" name="message-reply-submit">Send</button>

        </form>
    </div>
</div>
<?php }