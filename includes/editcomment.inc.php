<?php
require 'dbh.inc.php';
//Controls for Topic replies
if (isset($_POST['comment-quote-submit'])) {
    // Remove duplicate &quote=X GET Parameters from URL -
    // Insert &quote=none to end of URL before its is processed
    // This ensures that there is a &quote parameter found within the string to prevent the code returning false and failing
    // There is probably a much simpler way of doing this
    $Url = strval($_SERVER['HTTP_REFERER'] . '&quote=none');
    $pos = strpos($Url, "&quote");
    $Url = substr($Url, 0, $pos);
    header("location:" . $Url . "&quotecomment=" . $_POST['commentid'] . "&author=" . $_POST['author'] . "#comment-body");

} elseif (isset($_POST['topic-quote-submit'])) {
    $Url = strval($_SERVER['HTTP_REFERER'] . '&quote=none');
    $pos = strpos($Url, "&quote");
    $Url = substr($Url, 0, $pos);
    header("location:" . $Url . "&quotetopic=" . $_POST['commentid'] . "&author=" . $_POST['author'] . "#comment-body");
}

if (isset($_POST['topic-edit-submit'])) {
    echo $_POST['commentid'];
    echo $_POST['author'];
    header("location:" . $_SERVER['HTTP_REFERER'] . "&quote=" . "#comment-body");
}
if (isset($_POST['comment-edit-submit'])) {
    echo $_POST['commentid'];
    echo $_POST['author'];
}
if (isset($_POST['topic-delete-submit'])) {
    $id = $_POST['commentid'];
    $sql = "DELETE FROM topics WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        echo "Record deleted successfully";
        echo "Returning to previous page in 5s";
        header("Location: ../index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
        header("location:" . $_SERVER['HTTP_REFERER'] . "&quote=" . "#comment-body");
    }

    $conn->close();
}

if (isset($_POST['comment-delete-submit'])) {
    $id = $_POST['commentid'];
    $sql = "DELETE FROM comments WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        echo "Record deleted successfully";
        echo "Returning to previous page in 5s";
        header("location:" . $_SERVER['HTTP_REFERER'] . "&quote=" . "#comment-body");

    } else {
        echo "Error deleting record: " . $conn->error;
        header("location:" . $_SERVER['HTTP_REFERER'] . "&quote=" . "#comment-body");
    }

    $conn->close();

}

//Function for quoting Topic replies
// $pattern = array("[quote]", "[/quote]");
// $replace = array("<blockquote>", "</blockquote>");
// $body = str_replace($pattern, $replace, $_POST['comment-body']);
function quote($data)
{
    require 'dbh.inc.php';
    $sql = "SELECT * FROM comments WHERE id= '$data'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        $body = $row['body'];
        $author = $row['author'];
        //as seen in comment.inc.php I have str_replace() my custom [quote] tags to substitute for <blockquote>
        //This enables the below line of code to act as <blockquote> $body </blockquote>
        $html = "[quote] $body  [br][br] [b]Posted By[/b] $author [br] Post #$data  [/quote]";
        //As $body will be taken direct from DB it will contain <blockquote> tags
        // The below code takes the <blockquote> tags and substitutes for [quote]
        $pattern = array("<blockquote>", "</blockquote>", "<br>", "<i>", "</i>", "<b>", "</b>");
        $replace = array("[quote]", "[/quote]", "[br]", "", "", "[b]", "[/b]");
        $body = str_replace($pattern, $replace, $html);
        $body = preg_replace('/\r|\n/', '', $body);
        $body = preg_replace('~>\\s+<~m', '><', $body);
        echo htmlspecialchars($body);
    }
}
//Function for quoting the original post of the topic
function Opquote($data)
{
    require 'dbh.inc.php';
    $sql = "SELECT * FROM topics WHERE id= '$data'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        $body = $row['body'];
        $author = $row['author'];
        //as seen in comment.inc.php I have str_replace() my custom [quote] tags to substitute for <blockquote>
        //This enables the below line of code to act as <blockquote> $body </blockquote>
        $html = "[quote] $body  [br][br] [b]Posted By[/b] $author [br] Post #$data [/quote]";
        //As $body will be taken direct from DB it will contain <blockquote> tags
        // The below code takes the <blockquote> tags and substitutes for [quote]
        $pattern = array("<blockquote>", "</blockquote>", "<br>");
        $replace = array("[quote]", "[/quote]", "[br]");
        $body = str_replace($pattern, $replace, $html);
        $body = preg_replace('/\r|\n/', '', $body);
        $body = preg_replace('~>\\s+<~m', '><', $body);
        echo htmlspecialchars($body);
    }
}
