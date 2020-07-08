<?php
function category()
{
    require "./includes/dbh.inc.php";
    // if ($_GET['campus'] && $_GET['course']) ensures that the URL cannot be altered to navigate to a page that is not permitted
    if ($_GET['campus'] && $_GET['course']) {
        // Visible when logged in
        if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
            echo '

            <div class="main-content"><div class="search-container">
            <form class="form-inline" action="search.php" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                    <div class="input-group-append">
                        <button name="search-submit" type="submit" class="btn btn-secondary">
                           <img src="./img/search.png">
                        </button>
                    </div>
                </div>
            </form>
        </div>';
            if ($_GET['course']) {
                $campusName = $_GET['campus'];
                $courseName = $_GET['course'];
                $userid = $_SESSION['userId'];
                echo '<div class="breadcrumbs">
            <a href="index.php">FRONT PAGE</a>' . " > " . '
            <a href="course.php?campus=' . strtoupper($_GET['campus']) . '">' . strtoupper($_GET['campus']) . '</a>' . " > " . strtoupper($_GET['course']) . '</div> ';
                $sql = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $categoryName = $row['category'];
                        $sql2 = "SELECT * FROM topics WHERE campus = '$campusName' AND course ='$courseName' AND category = '$categoryName'";
                        $result2 = mysqli_query($conn, $sql2);
                        $resultCheck2 = mysqli_num_rows($result2);
                        $category = strtoupper($row['category']);
                        echo '
                    <div class="forum-category">' . '
                    <img class="topic-logo" src="img/' . $courseName . ".png" . '">
                    <div class="topic-title-desc">

                    <a class="topic-title" href="topiclist.php?campus=' . $_GET['campus'] . '&course=' . $_GET['course'] . '&category=' . $row['category'] . '">' . $category . '</a>
                    <hr>
            <p></p>
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
