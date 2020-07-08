<?php



if (isset($_POST['submit'])) {
    require_once 'dbh.inc.php';
    $vcode = $_POST['vcode'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordrepeat'];
    if (strlen($password) <= '8') {
        header("Location: ../pwreset.php?error=password8");
    } elseif (!preg_match("#[0-9]+#", $password)) {
        header("Location: ../pwreset.php?error=passwordnum");
    } elseif (!preg_match("#[A-Z]+#", $password)) {
        header("Location: ../pwreset.php?error=passwordcap");
    } elseif (!preg_match("#[a-z]+#", $password)) {
        header("Location: ../pwreset.php?error=passwordlow");
    } else if ($password !== $passwordRepeat) {
        header("Location: ../pwreset.php?error=passwordcheck");
        exit();
    } else {
        $str = rand();
        $vcodereplace = hash("sha256", $str);
        $sql = "UPDATE users SET pwdUsers = ?, vcodeUsers = ? WHERE vcodeUsers = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {

            //Send account activation email
            // Hash password for security
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sss",  $hashedPwd,  $vcodereplace,  $vcode);
            mysqli_stmt_execute($stmt);
            header("location:../index.php?pwresetsuccess");
            exit();
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
}
