<?php

if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    $inbox = display_inbox($_SESSION['userId']);
}
