<?php



if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    $messages = display_messages($_GET['conID']);
}
