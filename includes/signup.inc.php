<?php

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Check for legitimate connection via form submit
if (isset($_POST['signup-submit'])) {
    // If conneciton legitimate, connect to DB Handler
    require 'dbh.inc.php';

    // Fetch signup form info
    $username = mysqli_real_escape_string($conn, $_POST['uid']);
    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);
    $passwordRepeat = mysqli_real_escape_string($conn, $_POST['pwd-repeat']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $campus = mysqli_real_escape_string($conn, $_POST['campus']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    //Create random string for email verification
    $str = rand();
    $vcode = hash("sha256", $str);
    //prepare email setting for email verification
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
    $content = "<b><h1>Activate your SAE Student Forum account</h1><br><a href='http://localhost/Login/includes/verify.inc.php?uid=" . "$username" . "&email=" . "$email" . "&vcode=" . "$vcode" . "'>Click here to activate your account</a><br><h1>This sender does not support replies</h1></b>";
    $mail->MsgHTML($content);
    // Form error check / Validate via PHP empty function
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat) || empty($fname) || empty($lname) || empty($campus) || empty($course)) {
        // Send user back to signup page if signup fails, also sneds back partial form fill to save re-typing all fields
        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email . "&lname=" . $lname . "&fname=" . $lname . "&campus=" . $campus);
        exit();
        // Legal character and email check
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
        // Email validation
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=" . $username . "&lname=" . $lname . "&fname=" . $lname . "&campus=" . $campus);
        exit();
        //To limit the userbase to only SAE students, we check for a valid string that only sae students have in their student email
    } else if (!preg_match("/@saeinstitute/", $email)) {
        header("Location: ../signup.php?error=invalidmail&mail=" . $username . "&lname=" . $lname . "&fname=" . $lname . "&campus=" . $campus);
        exit();
        // Username validation Regex
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=" . $email . "&lname=" . $lname . "&fname=" . $lname . "&campus=" . $campus);
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
        header("Location: ../signup.php?error=invalidfname&mail=" . $email . "&uid=" . $username . "&lname=" . $lname . "&campus=" . $campus);
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $lname)) {
        header("Location: ../signup.php?error=invalidlname&mail=" . $email . "&uid=" . $username . "&fname=" . $fname . "&campus=" . $campus);
        exit();
    } else if (!preg_match("/^[a-zA-Z\s]*$/", $campus)) {
        header("Location: ../signup.php?error=invalidcampus&mail=" . $email . "&uid=" . $username . "&fname=" . $fname);
        exit();
        // Password confirmation check
    } else if (strlen($_POST["pwd"]) <= '8') {
        header("Location: ../signup.php?error=password8&uid=" . $username . "&mail=" . $email . "&lname=" . $fname . "&fname=" . $lname);
    } elseif (!preg_match("#[0-9]+#", $password)) {
        header("Location: ../signup.php?error=passwordnum&uid=" . $username . "&mail=" . $email . "&lname=" . $fname . "&fname=" . $lname);
    } elseif (!preg_match("#[A-Z]+#", $password)) {
        header("Location: ../signup.php?error=passwordcap&uid=" . $username . "&mail=" . $email . "&lname=" . $fname . "&fname=" . $lname);
    } elseif (!preg_match("#[a-z]+#", $password)) {
        header("Location: ../signup.php?error=passwordlow&uid=" . $username . "&mail=" . $email . "&lname=" . $fname . "&fname=" . $lname);
    } else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email . "&lname=" . $fname . "&fname=" . $lname);
        exit();
    }
    // Check for conflicting Usernames in Database 
    else {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            // if returned matching usernames = > 0 then no matching username exists so continue
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=" . $username);
                exit();
                // Check for conflicting Emails in Database 
            } else {

                $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    // if returned matching emails = > 0 then no matching emails exists so continue
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if ($resultCheck > 0) {
                        header("Location: ../signup.php?error=emailtaken&mail=" . $email);
                        exit();
                    } else {
                        //if verification email failed to send then error and stop
                        if (!$mail->Send()) {
                            echo "Error while sending Email.";
                            var_dump($mail);
                        } else {
                            // add new user info to DB
                            $sql = "INSERT INTO users (uidUsers,emailUsers,pwdUsers,imgUsers,bioUsers,firstUsers,lastUsers,campusUsers,courseUsers,faceUsers,linkedUsers,twitUsers,instaUsers,verifiedUsers,vcodeUsers) 
                            VALUES (?,?,?,'profiledefault.jpg','Add a bio',?,?,?,?,'NA','NA','NA','NA','FALSE',?)";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../signup.php?error=sqlerror");
                                exit();
                            } else {
                                //Send account activation email
                                // Hash password for security
                                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "ssssssss", $username, $email, $hashedPwd, $fname, $lname, $campus, $course, $vcode);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../signup.php?signup=success");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }

    // close connection to DB
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../signup.php");
    exit();
}
