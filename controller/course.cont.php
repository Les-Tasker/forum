<?php
function course()
{

    require "includes/dbh.inc.php";

    if ($_GET['campus']) {
        // Visible when logged in
        if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
            echo '<div class="main-content"><div class="search-container">
            <form class="form-inline" action="search.php" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                    <div class="input-group-append">
                        <button name="search-submit" type="submit" class="btn btn-secondary">
                        <img src="./img/search.png">                        </button>
                    </div>
                </div>
            </form>
        </div>';
            if ($_GET['campus']) {
                $userid = $_SESSION['userId'];
                $campusName = ucwords($_GET['campus']);
                echo '<div class="breadcrumbs"><a href="index.php">FRONT PAGE</a>' . " > " . strtoupper($_GET['campus']) . '</div> ';
                // Select all entries from Courses table in database
                $sql = "SELECT * FROM courses";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    // loop through all entries and echo out
                    while ($row = mysqli_fetch_assoc($result)) {
                        $courseName = ucwords($row['course']);
                        $sql2 = "SELECT * FROM topics WHERE campus = '$campusName' AND course ='$courseName' ";
                        $result2 = mysqli_query($conn, $sql2);
                        $resultCheck2 = mysqli_num_rows($result2);
                        $course = strtoupper($row['course']);
                        echo '
                    <div class="forum-category">' . '
                    <img class="topic-logo" src="img/' . $row['course'] . ".png" . '">
                    <div class="topic-title-desc">
                    <a class="topic-title" href="category.php?campus=' . $campusName . '&course=' . $row['course'] . '">' . $course . '</a>
                    <hr>
                    </div>
                    <div class="topic-post-count">Topics: ' . $resultCheck2 . '
                    </div>
                    </div>';
                    }
                }
            }
        }
        // Visible when logged in
        // Visible when logged out
        else {
            echo '<div class="main-content-logout">
        <h1>You need to be logged in to view the forum</h1><br><h1>If you have registered, please check your email to verify your account</h1><br><a href="signup.php">Click here to register</a></div>

</div>';
        }
    } else {
        header("Location: index.php");
    }
    // Visible when logged out

}
