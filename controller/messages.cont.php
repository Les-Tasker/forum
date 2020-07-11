<?php

include './includes/inbox.inc.php';

if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    display_messages($_GET['conID']);
}
