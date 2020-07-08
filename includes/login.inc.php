<?php
// check for legal access to page
if (isset($_POST['login-submit'])) {
    // load DB Handler
    require 'dbh.inc.php';

    $mailuid = mysqli_real_escape_string($conn, $_POST['mailuid']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);
    // check for empty fields
    if (empty($mailuid) || empty($password)) {
        header("Location: ../index.php?error=emptyfield");
        exit();
    } else {
        // check username and email credentials from DB to allow either username or email for login 
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                    // session issues - SOLVED $_SESSION was lower case
                } else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] =  $row['idUsers'];
                    $_SESSION['userUid'] =  $row['uidUsers'];
                    $_SESSION['userImg'] = $row['imgUsers'];
                    $_SESSION['userBio'] = $row['bioUsers'];
                    $_SESSION['userFname'] = $row['firstUsers'];
                    $_SESSION['userLname'] = $row['lastUsers'];
                    $_SESSION['userCampus'] = $row['campusUsers'];
                    $_SESSION['userCourse'] = strtolower($row['courseUsers']);
                    $_SESSION['userFace'] = $row['faceUsers'];
                    $_SESSION['userLinked'] = $row['linkedUsers'];
                    $_SESSION['userTwit'] = $row['twitUsers'];
                    $_SESSION['userInsta'] = $row['instaUsers'];
                    $_SESSION['userVerified'] = $row['verifiedUsers'];
                    header("Location: ../index.php");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
