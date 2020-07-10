<?php

include_once './includes/inbox.inc.php';

if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    display_inbox($_SESSION['userId']);

}
