<?php
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\PHPException;



if (isset($_POST['submit'])) {
    require '../includes/dbh.inc.php';
    $email = $_POST['email'];
    $sql = "SELECT * FROM users where emailUsers='$email'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $vcode = $row['vcodeUsers'];

    if ($resultCheck > 0) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "studentforumsae@gmail.com";
        $mail->Password   = "123sae123";
        $mail->IsHTML(true);
        $mail->AddAddress($email, "Admin");
        $mail->SetFrom("No-Reply@SAE-Student-Forums.com");

        $mail->Subject = "SAE Student Forum";
        $content = "<b><h1>Password Reset<br><a href='http://localhost/Login/pwreset.php?mail=" . "$email" . "&vcode=" . "$vcode" . "'>Cick here to reset password</a></h1></b>";
        $mail->MsgHTML($content);
        if (!$mail->Send()) {
            echo "Error while sending Email.";
        } else {
            header("Location: ../forgotpw.php?pwreset=success");
        }
    } else {
        header("Location: ../forgotpw.php?pwreseterror");;
    }
}

mysqli_close($conn);
