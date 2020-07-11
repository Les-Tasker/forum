<?php
function search()
{

    require "includes/dbh.inc.php";
    if (!empty($_POST['search-string'])) {
        // Visible when logged in
        if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
            echo '<div class="main-content">';
            if (isset($_POST['search-submit'])) {
                $search = mysqli_real_escape_string($conn, $_POST['search-string']);
                $sql = "SELECT * FROM topics WHERE author LIKE '%$search%' OR title LIKE '%$search%' OR body LIKE '%$search%' OR campus LIKE '%$search%' OR course LIKE '%$search%'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        $topicid = $row['id'];
                        $sql3 = "SELECT * FROM topics WHERE id=$topicid";
                        $result3 = mysqli_query($conn, $sql3);
                        $resultCheck3 = mysqli_num_rows($result3);
                        $time = $row['recent'];
                        $DS = date("M jS, Y", strtotime($time));
                        $TS = date("H:i", strtotime($time));
                        $campusName = $row['campus'];
                        $courseName = $row['course'];
                        $categoryName = $row['category'];
                        $sql2 = "SELECT * FROM comments WHERE topicid='$topicid' ORDER BY posted DESC";
                        $result2 = mysqli_query($conn, $sql2);
                        $resultCheck2 = mysqli_num_rows($result2);
                        // $campus = strtoupper($row['campus']);


                        echo '<div class="forum-category">' . '
                            <img class="topic-logo" src="uploads/' . $row['authorimg'] . '">
                           <div class="topic-title-desc"> 
                                <a class="topic-title" href="topic.php?campus=' . $campusName . '&course=' . $courseName . '&category=' . $categoryName . '&id=' . $row['id'] . '">' . $row['title'] . '</a>
                                <hr>
                                <p>' . ucwords($campusName) . " " . ucwords($courseName) . " " . ucwords($categoryName) . " " . '</p>
                           </div> 
                           <div class="topic-post-count">Replies:' . $resultCheck2 . '</div>
                           <h6>' . "Most Recent<br>" . $DS . '<br>' . 'at ' . $TS . '</h6>
                          </div>';
                    }
                } else {
                    echo '<h1>Nobody here but us chickens!</h1>';
                }
            }
        }
    } else {
        header("location:" . $_SERVER['HTTP_REFERER']);
    }
}
