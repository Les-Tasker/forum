<?php


if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
  $details = viewProfile($_SESSION['userId']);
}
