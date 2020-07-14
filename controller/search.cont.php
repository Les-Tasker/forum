<?php


if (!empty($_POST['search-string'])) {
    // Visible when logged in
    if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
        echo '<div class="main-content">';
        if (isset($_POST['search-submit'])) {
            require "view/search.view.php";
        }
    }
}
