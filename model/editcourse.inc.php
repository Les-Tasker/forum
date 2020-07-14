<?php
session_start();
$id = $_SESSION['userId'];
if (isset($_POST['course-submit'])) {
    // If conneciton legitimate, connect to DB Handler
    require 'dbh.inc.php';
    // Fetch signup form info
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    if (empty($course)) {
        header("Location: ../profile.php?error=emptyfields");
        exit();
    } else {

        // ------
        // Create connection
        // Check connection
        if ($conn->connect_error) {
            // WORKS!!! Returns an error if i change anything in server info
            header("Location: ../profile.php?error=DBCONNECT");
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE users SET          
        courseUsers=? WHERE idUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "si", $course, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            $_SESSION['userCourse'] = $course;
            header("Location: ../profile.php");
        }



        // -------
    }
} else {
    header("Location: ../profile.php");
    exit();
}
