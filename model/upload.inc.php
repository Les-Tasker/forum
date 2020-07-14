<?php
session_start();
require 'dbh.inc.php';

$id = $_SESSION['userId'];
$uid = $_SESSION['userUid'];

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                unlink('../uploads/' . $_SESSION['userImg']);
                $fileNameNew = $id . "." . $fileActualExt;
                $fileDestination = '../uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                // header("Location: ../profile.php?uploadsuccess");
                // ------
                // Create connection
                // Check connection
                if ($conn->connect_error) {
                    // WORKS!!! Returns an error if i change anything in server info
                    header("Location: ../profile.php?error=DBCONNECT");
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "UPDATE users SET imgUsers=? WHERE  idUsers=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "si", $fileNameNew, $id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    $_SESSION['userImg'] = $fileNameNew;
                    $sql2 = "UPDATE topics SET authorimg=? WHERE  author=?";
                    $stmt2 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                        header("Location: ../profile.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt2, "ss", $fileNameNew, $uid);
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_close($stmt2);
                        mysqli_close($conn);
                        sleep(1);
                        header("Location: ../profile.php");
                    }


                    header("Location: ../profile.php");
                }



                // -------
            } else {
                header("Location: ../profile.php?error=filetoobig");
            }
        } else {
            header("Location: ../profile.php?error=fileerror");
        }
    } else {
        header("Location: ../profile.php?error=notallowed");
    }
}
