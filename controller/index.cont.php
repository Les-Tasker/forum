<?php
function indexSelect()
{
    require "./includes/dbh.inc.php";

    // Visible when logged in
    if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
?>



        <div class="main-content">
            <div class="search-container">
                <form class="form-inline" action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                        <div class="input-group-append">
                            <button name="search-submit" type="submit" class="btn btn-secondary">
                                <img src="./img/search.png"> </button>
                        </div>
                    </div>
                </form>
            </div>
    <?php

        // topic content
        // Selects all entries in campus table
        $sql = "SELECT * FROM campus;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        // if amount of entries in table is greater than 0, loop through entries and echo out
        if ($resultCheck > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $campusName = ucwords($row['campus']);
                $sql2 = "SELECT * FROM topics WHERE campus = '$campusName'";
                $result2 = mysqli_query($conn, $sql2);
                $resultCheck2 = mysqli_num_rows($result2);
                $campus = strtoupper($row['campus']);
                echo '
            <div class="forum-category">' . '
            <img class="topic-logo" src="img/sae.png">
            <div class="topic-title-desc">
            <a class="topic-title" href="course.php?campus=' . $row['campus'] . '">' . $campus . '</a>
            <hr>

            </div>
            <div class="topic-post-count">Topics: ' . $resultCheck2 . '
            </div>
            </div>';
            }
        }
    }

    // Visible when logged out
    else {

        echo '<div class="main-content-logout">
    <h1>You need to be logged in to view the forum</h1><br><h1>If you have registered, please check your email to verify your account</h1><br><a href="signup.php">Click here to register</a></div>

</div>';
        signup();
    }
}
