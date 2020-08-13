<?php
include_once "DBConn.class.php";

class Comment extends DBConn
{

    protected function getTopicReplies($topicid)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM comments WHERE topicid='$topicid' ORDER BY posted DESC";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        // if amount of entries in table is greater than 0, loop through entries and echo out
        echo $resultCheck;
    }
    protected function getCommentById($id)
    {
        $conn = $this->Connection();
        $sql2 = "SELECT * FROM comments where topicid='$id'";
        $result2 = mysqli_query($conn, $sql2);
        $resultCheck2 = mysqli_num_rows($result2);
        if ($resultCheck2 > 0) {
            return $result2;
        }
    }
    protected function setTopicComment()
    {
        $conn = $this->Connection();
        session_start();
        $topicid = $_POST['topicid'];
        $author = $_SESSION['userUid'];
        $tz = 'Europe/London';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        $posted = $dt->format('d/m/Y H:i:s');
        $pattern = array("[quote]", "[/quote]", "[br]", "<div>", "</div>", "[b]", "[/b]", "<i>", "</i>", "<a");
        $replace = array("<blockquote>", "</blockquote>", "<br>", "", "", "<b>", "</b>", "", "", "");
        $body = str_replace($pattern, $replace, $_POST['comment-body']);
        $url_pattern = '/(http|https|www|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
        $body = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $body);
        // Form error check / Validate via PHP empty function
        if (empty($body)) {
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // add new comment info to DB
            $sql = "INSERT INTO comments (author, posted, body, topicid)
            VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "sssi", $author, $posted, $body, $topicid);
                mysqli_stmt_execute($stmt);
            }
            // update topics table to show time of most recent comment
            $sql = "UPDATE topics SET recent = ? WHERE id = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "si", $posted, $topicid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location:" . $_SERVER['HTTP_REFERER'] . "#comment-body");
            }
        }
    }
    protected function commentQuote()
    {
        $Url = strval($_SERVER['HTTP_REFERER'] . '&quote=none');
        $pos = strpos($Url, "&quote");
        $Url = substr($Url, 0, $pos);
        header("location:" . $Url . "&quotecomment=" . $_POST['commentid'] . "&author=" . $_POST['author'] . "#comment-body");
    }
    protected function commentQuoteProcess($id)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM comments WHERE id= '$id'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            $row = mysqli_fetch_assoc($result);
            $body = $row['body'];
            $author = $row['author'];
            $html = "[quote] $body [br][br][b]Posted By[/b] $author [br]Post #$id [/quote]";
            $pattern = array("<blockquote>", "</blockquote>", "<br>", "<i>", "</i>", "<b>", "</b>", '<a target="_blank" href="condish">', "</a>");
            $replace = array("[quote]", "[/quote]", "[br]", "", "", "[b]", "[/b]");
            $body = str_replace($pattern, $replace, $html);
            $body .= "\r\n\r\n\r\n\r\n";
            echo htmlspecialchars($body);
        }
    }
    protected function commentEdit()
    {
        $conn = $this->Connection();
        $id = $_POST['comment-id'];
        $body = $_POST['comment-edit'];
        $sql = "UPDATE comments SET
            body=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "si", $body, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("location:" . $_SERVER['HTTP_REFERER'] . '#post-' . $id);
        }
    }
    protected function commentDelete()
    {
        $conn = $this->Connection();
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
}