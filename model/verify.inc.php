<?php
include 'dbh.inc.php';
?>

<?php
if ((isset($_GET['uid'])) && (isset($_GET['email'])) && (isset($_GET['vcode']))) {
    $username = mysqli_real_escape_string($conn, $_GET['uid']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $vcode = mysqli_real_escape_string($conn, $_GET['vcode']);
    $conn = new mysqli($servername, $dBUsername, $dBPassword, $dBName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE users SET verifiedUsers='TRUE' WHERE  emailUsers=? AND vcodeUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $email, $vcode);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../acctver.php");
    }
} else {
}

?>
 

