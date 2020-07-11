<?php

require "header.php"; ?>
<div class="main-content">
    <h2>Messages</h2>
    <?php
    require "controller/messages.cont.php";
    ?>
    <form action="includes/reply-message.inc.php" method="post" id="reply-message">
        <input type="hidden" name="fromUser" value="<?php echo $_SESSION['userId'] ?>">
        <input type="hidden" name="toUser" value="<?php echo $_GET['toID'] ?>">
        <input type="hidden" name="conID" value="<?php echo $_GET['conID'] ?>">
        <textarea name="message-body" id="message-textarea" cols="40" rows="5"></textarea>

        <button class="message-submit" type="submit" name="message-submit">Send</button>

    </form>
</div>


<?php
require "footer.php";
