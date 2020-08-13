<?php
include_once "DBConn.class.php";

class Message extends DBConn
{


    protected function sendMessageFromProfile()
    {
        $conn = $this->Connection();
        // Fetch signup form info
        $from = $_POST['fromUser'];
        $to = $_POST['toUser'];
        $tz = 'Europe/London';
        $timeStamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timeStamp); //adjust the object to correct timestamp
        $posted = $dt->format('d/m/Y H:i:s');
        $string = $_POST['message-body'];
        $url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
        $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
        $body = $string;
        if ($from > $to) {
            $seed = $from . $to;
            srand($seed);
            $conId = rand();
        } else {
            $seed = $to . $from;
            srand($seed);
            $conId = rand();
        }
        if (empty($body)) {
            // header("Location: ../profile.php?error=emptyfields");
            header("location:" . $_SERVER['HTTP_REFERER']);
        } else {
            if ($conn->connect_error) {
                header("Location: ../profile.php?error=DBCONNECT");
                die("Connection failed: " . $conn->connect_error);
            } else {
                // add new user info to DB
                $sql = "INSERT INTO messages (fromID,toID,msg,ts,conID,msgstatus)
            VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                } else {
                    $msgStatus = "DELIVERED";
                    mysqli_stmt_bind_param($stmt, "iissis", $from, $to, $body, $posted, $conId, $msgStatus);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location:" . $_SERVER['HTTP_REFERER']);
                }
            }
        }
    }
    protected function replyInbox()
    {
        $conn = $this->Connection();
        // Fetch signup form info
        $from = $_POST['fromUser'];
        $to = $_POST['toUser'];
        $tz = 'Europe/London';
        $timeStamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timeStamp); //adjust the object to correct timestamp
        $posted = $dt->format('d/m/Y H:i:s');
        $string = $_POST['message-body'];
        $url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
        $string = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $string);
        $body = $string;
        $conId = $_POST['conID'];
        if (empty($body)) {
            // header("Location: ../profile.php?error=emptyfields");
            header("location:" . $_SERVER['HTTP_REFERER'] . '#reply-message');
        } else {
            if ($conn->connect_error) {
                header("Location: ../profile.php?error=DBCONNECT");
                die("Connection failed: " . $conn->connect_error);
            } else {
                // add new user info to DB
                $sql = "INSERT INTO messages (fromID,toID,msg,ts,conID,msgstatus)
                VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                } else {
                    $msgStatus = "DELIVERED";
                    mysqli_stmt_bind_param($stmt, "iissis", $from, $to, $body, $posted, $conId, $msgStatus);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location:" . $_SERVER['HTTP_REFERER'] . '#reply-message');
                }
            }
        }
    }
    protected function getMessages($conId)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM messages  WHERE conID = '$conId'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            // loop through all entries and echo out
            return $result;
        }
    }
    protected function setMsgStatus($conId, $user)
    {
        $conn = $this->Connection();
        $sql = "UPDATE messages SET msgstatus = 'SEEN' WHERE conID = ? AND toID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
        } else {
            mysqli_stmt_bind_param($stmt, "si", $conId, $user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
    protected function getInbox($userId)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM messages where toID = '$userId' OR fromID = '$userId' GROUP BY conID ORDER BY ts DESC ";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            // loop through all entries and echo out
            return $result;
        }
    }
    protected function getNewMessageNotification($conId, $toId)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM messages where conID = $conId AND toID = $toId AND msgstatus = 'DELIVERED'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            echo 'New Message';
        }
    }
    protected function getRecentMessage($id)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM messages WHERE conID = '$id' ORDER BY ts DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($resultCheck > 0) {
            return $row['ts'];
        }
    }
}