<?php

function campus()
{
    require "./model/dbh.inc.php";
    $sql = "SELECT * FROM campus;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // if amount of entries in table is greater than 0, loop through entries and echo out
    if ($resultCheck > 0) {
        return $result;
    }
}
function campusCount($campusName)
{
    require "./model/dbh.inc.php";
    $sql = "SELECT * FROM topics WHERE campus = '$campusName'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo $resultCheck;
}
function course()
{
    require "./model/dbh.inc.php";
    $sql = "SELECT * FROM courses;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // if amount of entries in table is greater than 0, loop through entries and echo out
    if ($resultCheck > 0) {
        return $result;
    }
}
function courseCount($campusName, $courseName)
{
    require "./model/dbh.inc.php";
    $sql = "SELECT * FROM topics WHERE campus = '$campusName' AND course ='$courseName' ";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo $resultCheck;
}


function category()
{
    require "./model/dbh.inc.php";
    $sql = "SELECT * FROM category;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // if amount of entries in table is greater than 0, loop through entries and echo out
    if ($resultCheck > 0) {
        return $result;
    }
}
function categoryCount($campusName, $courseName, $categoryName)
{
    require "./model/dbh.inc.php";
    $sql = "SELECT * FROM topics WHERE campus = '$campusName' AND course ='$courseName' AND category ='$categoryName' ";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo $resultCheck;
}
function topicReplyCount($topicid)
{
    require "./model/dbh.inc.php";
    $sql = "SELECT * FROM comments WHERE topicid='$topicid' ORDER BY posted DESC";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // if amount of entries in table is greater than 0, loop through entries and echo out
    echo $resultCheck;
}
function topicList($courseName, $campusName, $categoryName)
{
    require "./model/dbh.inc.php";
    $sql = "SELECT * FROM topics WHERE course='$courseName' AND campus='$campusName' AND category='$categoryName' ORDER BY recent DESC";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        return $result;
    }
}
function showTopic($id)
{
    require './model/dbh.inc.php';
    $sql = "SELECT * FROM topics where id='$id'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        return $result;
    }
}
function showComment($id)
{
    require './model/dbh.inc.php';
    $sql2 = "SELECT * FROM comments where topicid='$id'";
    $result2 = mysqli_query($conn, $sql2);
    $resultCheck2 = mysqli_num_rows($result2);
    if ($resultCheck2 > 0) {
        return $result2;
    }
}
function showUser($poster)
{
    require './model/dbh.inc.php';
    $sql3 = "SELECT * FROM users where uidUsers='$poster'";
    $result3 = mysqli_query($conn, $sql3);
    $resultCheck3 = mysqli_num_rows($result3);
    if ($resultCheck3 > 0) {
        $row = mysqli_fetch_assoc($result3);
        echo $row['imgUsers'];
    }
}
function searchResult($search)
{
    require './model/dbh.inc.php';
    $sql = "SELECT * FROM topics WHERE author LIKE '%$search%' OR title LIKE '%$search%' OR body LIKE '%$search%' OR campus LIKE '%$search%' OR course LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        return $result;
    }
}

// Check for legitimate connection via form submit
if (isset($_POST['topic-submit'])) {
    // If conneciton legitimate, connect to DB Handler
    require 'dbh.inc.php';
    // Fetch signup form info
    session_start();
    $title = $_POST['topic-title'];
    $string = $_POST['topic-body'];
    $campus = $_POST['campus'];
    $course = $_POST['course'];
    $category = $_POST['category'];
    $author = $_SESSION['userUid'];
    $authorimg = $_SESSION['userImg'];
    $tz = 'Europe/London';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    $posted = $dt->format('d/m/Y H:i:s');
    $url_pattern = '/(http|https|www|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
    $body = $string;
    // Form error check / Validate via PHP empty function
    if (empty($title) || empty($body)) {
        header("Location: ../topiclist.php?campus=" . $campus . "&course=" . $course . "&category=" . $category . "&error=emptyfields");
        exit();
    } else {
        // add new user info to DB
        $sql = "INSERT INTO topics (author, title, body,dateposted,authorimg,campus,course,category)
        VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssss", $author, $title, $body, $posted, $authorimg, $campus, $course, $category);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ../topiclist.php?campus=" . $campus . "&course=" . $course . "&category=" . $category);
        }
    }
    // close connection to DB

}
