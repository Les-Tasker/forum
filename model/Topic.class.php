<?php
include_once "DBConn.class.php";

class Topic extends DBConn
{


    protected function setNewTopic()
    {
        $conn = $this->Connection();
        // Fetch signup form info
        session_start();
        $title = $_POST['topic-title'];
        $string = $_POST['topic-body'];
        $campus =  $_POST['campus'];
        $course = $_POST['course'];
        $category = $_POST['category'];
        $author = $_SESSION['userUid'];
        $authorImg = $_SESSION['userImg'];
        $tz = 'Europe/London';
        $timeStamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timeStamp); //adjust the object to correct timestamp
        $posted = $dt->format('d/m/Y H:i:s');
        $url_pattern = '/(http|https|www|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
        $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
        $body = $string;
        // Form error check / Validate via PHP empty function
        if (empty($title) || empty($body)) {
            header("Location: topiclist.php?campus=" . $campus . "&course=" . $course . "&category=" . $category . "&error=emptyfields");
            exit();
        } else {
            // add new user info to DB
            $sql = "INSERT INTO topics (author, title, body,dateposted,authorimg,campus,course,category)
            VALUES (?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ssssssss", $author, $title, $body, $posted, $authorImg, $campus, $course, $category);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: topiclist.php?campus=" . $campus . "&course=" . $course . "&category=" . $category);
            }
        }
        // close connection to DB
    }
    protected function campusTopicCount($campusName)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE campus = '$campusName'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        return $resultCheck;
    }
    protected function getTopicList($courseName, $campusName, $categoryName)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE course='$courseName' AND campus='$campusName' AND category='$categoryName' ORDER BY recent DESC";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            return $result;
        }
    }
    protected function getTopicById($id)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics where id='$id'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            return $result;
        }
    }
    protected function getAuxTopic($aux)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE aux = '$aux'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            return $result;
        }
    }
    protected function topicQuote()
    {
        $Url = strval($_SERVER['HTTP_REFERER'] . '&quote=none');
        $pos = strpos($Url, "&quote");
        $Url = substr($Url, 0, $pos);
        header("location:" . $Url . "&quotetopic=" . $_POST['commentid'] . "&author=" . $_POST['author'] . "#comment-body");
    }
    protected function topicQuoteProcess($id)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE id= '$id'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            $row = mysqli_fetch_assoc($result);
            $body = $row['body'];
            $author = $row['author'];
            //as seen in comment.inc.php I have str_replace() my custom [quote] tags to substitute for <blockquote>
            //This enables the below line of code to act as <blockquote> $body </blockquote>
            $html = "[quote] $body  [br][br] [b]Posted By[/b] $author [br] Post #$id [/quote]";
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
    protected function topicEdit()
    {
        $conn = $this->Connection();
        $id = $_POST['topic-id'];
        $body = $_POST['topic-edit'];
        $sql = "UPDATE topics SET
        body=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "si", $body, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("location:" . $_SERVER['HTTP_REFERER']);
        }
    }
    protected function topicDelete()
    {
        $conn = $this->Connection();
        $id = $_POST['commentid'];
        $sql = "DELETE FROM topics WHERE id = '$id'";
        if ($conn->query($sql) === true) {
            echo "Record deleted successfully";
            echo "Returning to previous page in 5s";
            header("Location: index.php");
        } else {
            echo "Error deleting record: " . $conn->error;
            header("location: index.php");
        }
        $conn->close();
    }
    protected function searchResult($search)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE author LIKE '%$search%' OR title LIKE '%$search%' OR body LIKE '%$search%' OR campus LIKE '%$search%' OR course LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            return $result;
        }
    }
}
class TopicHandler extends Topic
{


    public function setNewTopicHandler()
    {
        $topicHandler = $this->setNewTopic();
        return $topicHandler;
    }
    public function campusTopicCountHandler($campusName)
    {
        $topicHandler = $this->campusTopicCount($campusName);
        return $topicHandler;
    }
    public function getTopicListHandler($courseName, $campusName, $categoryName)
    {
        $topicHandler = $this->getTopicList($courseName, $campusName, $categoryName);
        return $topicHandler;
    }
    public function getTopicByIdHandler($id)
    {
        $topicHandler = $this->getTopicById($id);
        return $topicHandler;
    }
    public function getAuxTopicHandler($aux)
    {
        $topicHandler = $this->getAuxTopic($aux);
        return $topicHandler;
    }
    public function topicQuoteHandler()
    {
        $topicHandler = $this->topicQuote();
        return $topicHandler;
    }
    public function topicQuoteProcessHandler($id)
    {
        $topicHandler = $this->topicQuoteProcess($id);
        return $topicHandler;
    }
    public function topicEditHandler()
    {
        $topicHandler = $this->topicEdit();
        return $topicHandler;
    }
    public function topicDeleteHandler()
    {
        $topicHandler = $this->topicDelete();
        return $topicHandler;
    }
    public function searchResultHandler($search)
    {
        $topicHandler = $this->searchResult($search);
        return $topicHandler;
    }
}