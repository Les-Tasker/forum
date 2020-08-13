<?php
include_once "DBConn.class.php";
include_once 'PHPMailer-master/src/Exception.php';
include_once 'PHPMailer-master/src/PHPMailer.php';
include_once 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

//Create class User
class User extends DBConn
{
    //Create attributes for database table Users
    public $UserName;
    public $Usermail;
    public $Userimage;
    public $Usercover;
    public $Userbio;
    public $Userfirstname;
    public $Userlastname;
    public $Usercourse;
    public $Uservcode;
    public $Userid;
    public $Userverified;

    //Query database for Users by ID
    protected function getUserInfoById($id)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM users WHERE idUsers = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        //Set class attributes using data from database table Users
        $this->Username = $row['uidUsers'];
        $this->Usermail = $row['emailUsers'];
        $this->Userimage = $row['imgUsers'];
        $this->Usercover = $row['coverUsers'];
        $this->Userbio = $row['bioUsers'];
        $this->Userfirstname = $row['firstUsers'];
        $this->Userlastname = $row['lastUsers'];
        $this->Usercampus = $row['campusUsers'];
        $this->Usercourse = $row['courseUsers'];
        $this->Uservcode = $row['vcodeUsers'];
        $this->Userid = $row['idUsers'];
        $this->Userverified = $row['verifiedUsers'];
    }

    protected function getUserInfoByEmail($email)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM users where emailUsers='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        //Set class attributes using data from database table Users
        $this->Username = $row['uidUsers'];
        $this->Usermail = $row['emailUsers'];
        $this->Userimage = $row['imgUsers'];
        $this->Usercover = $row['coverUsers'];
        $this->Userbio = $row['bioUsers'];
        $this->Userfirstname = $row['firstUsers'];
        $this->Userlastname = $row['lastUsers'];
        $this->Usercampus = $row['campusUsers'];
        $this->Usercourse = $row['courseUsers'];
        $this->Uservcode = $row['vcodeUsers'];
        $this->Userid = $row['idUsers'];
        $this->Userverified = $row['verifiedUsers'];
    }

    //Query database for Users by Username
    protected function getUserInfoByUsername($uid)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM users WHERE uidUsers = '$uid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        //Set class attributes using data from database table Users
        $this->Username = $row['uidUsers'];
        $this->Usermail = $row['emailUsers'];
        $this->Userimage = $row['imgUsers'];
        $this->Usercover = $row['coverUsers'];
        $this->Userbio = $row['bioUsers'];
        $this->Userfirstname = $row['firstUsers'];
        $this->Userlastname = $row['lastUsers'];
        $this->Usercampus = $row['campusUsers'];
        $this->Usercourse = $row['courseUsers'];
        $this->Uservcode = $row['vcodeUsers'];
        $this->Userid = $row['idUsers'];
        $this->Userverified = $row['verifiedUsers'];
    }
    protected function setUserBio($text, $id)
    {
        $conn = $this->Connection();
        $text = htmlspecialchars($text);
        $url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
        $text = preg_replace($url_pattern, '<a target="_blank" href="$0">$0</a>', $text);
        $bio = $text;

        if (empty($bio)) {
            header("Location: profile.php?error=emptyfields");
            exit();
        } else {
            if ($conn->connect_error) {
                header("Location: profile.php?error=DBCONNECT");
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "UPDATE users SET bioUsers=? WHERE idUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: profile.php");
            } else {
                mysqli_stmt_bind_param($stmt, "si", $bio, $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                $_SESSION['userBio'] = $bio;
                header("Location: profile.php");
            }
        }
    }

    protected function displayUnreadMessage($user)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM messages WHERE toID = $user AND msgstatus = 'DELIVERED'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            echo $resultCheck;
        } else {
            echo '0';
        }
    }
    protected function verifyNewUser($email, $vCode)
    {
        $conn = $this->Connection();
        $sql = "UPDATE users SET verifiedUsers='TRUE' WHERE  emailUsers=? AND vcodeUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $email, $vCode);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ../acctver.php");
        }
    }

    protected function SetUserProfileImage()
    {

        $conn = $this->Connection();
        $id = $_SESSION['userId'];
        $uid = $_SESSION['userUid'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    if (!$_SESSION['userImg'] == 'profiledefault.png') {
                        unlink('uploads/' . $_SESSION['userImg']);
                    }
                    $fileNameNew = $id . "." . $fileActualExt;
                    $fileDestination = 'uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    // header("Location: profile.php?uploadsuccess");
                    // ------
                    // Create connection
                    // Check connection
                    if ($conn->connect_error) {
                        // WORKS!!! Returns an error if i change anything in server info
                        header("Location: profile.php?error=DBCONNECT");
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "UPDATE users SET imgUsers=? WHERE  idUsers=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: signup.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "si", $fileNameNew, $id);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        $_SESSION['userImg'] = $fileNameNew;
                        $sql2 = "UPDATE topics SET authorimg=? WHERE author=?";
                        $stmt2 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                            header("Location: profile.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt2, "ss", $fileNameNew, $uid);
                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_close($stmt2);
                            mysqli_close($conn);
                            header("Location: profile.php");
                        }
                        header("Location: profile.php");
                    }
                } else {
                    header("Location: profile.php?error=filetoobig");
                }
            } else {
                header("Location: profile.php?error=fileerror");
            }
        } else {
            header("Location: profile.php?error=notallowed");
        }
    }
    protected function setUserCoverImage()
    {
        $conn = $this->Connection();
        $id = $_SESSION['userId'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    if (!$_SESSION['userCover'] == 'coverdefault.png') {
                        unlink('uploads/' . $_SESSION['userCover']);
                    }
                    $fileNameNew = "cover" . $id . "." . $fileActualExt;
                    $fileDestination = 'uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    // header("Location: profile.php?uploadsuccess");
                    // ------
                    // Create connection
                    // Check connection
                    if ($conn->connect_error) {
                        header("Location: profile.php?error=DBCONNECT");
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "UPDATE users SET coverUsers=? WHERE  idUsers=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: profile.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "si", $fileNameNew, $id);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        $_SESSION['userCover'] = $fileNameNew;
                        mysqli_close($conn);
                        header("Location: profile.php");
                    }
                } else {
                    header("Location: profile.php?error=filetoobig");
                }
            } else {
                header("Location: profile.php?error=fileerror");
            }
        } else {
            header("Location: profile.php?error=notallowed");
        }
    }
    protected function signupNewUser()
    {
        $conn = $this->Connection();
        // Fetch signup form info
        $userName = mysqli_real_escape_string($conn, $_POST['uid']);
        $email = mysqli_real_escape_string($conn, $_POST['mail']);
        $password = mysqli_real_escape_string($conn, $_POST['pwd']);
        $passwordRepeat = mysqli_real_escape_string($conn, $_POST['pwd-repeat']);
        $fName = mysqli_real_escape_string($conn, $_POST['fname']);
        $lName = mysqli_real_escape_string($conn, $_POST['lname']);
        $campus = mysqli_real_escape_string($conn, $_POST['campus']);
        $course = mysqli_real_escape_string($conn, $_POST['course']);
        //Create random string for email verification
        $str = rand();
        $vCode = hash("sha256", $str);
        //prepare email setting for email verification
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "studentforumsae@gmail.com";
        $mail->Password = "123sae123";
        $mail->IsHTML(true);
        $mail->AddAddress($email, "Admin");
        $mail->SetFrom("No-Reply@SAE-Student-Forums.com");
        $mail->Subject = "SAE Student Forum";
        $content = "<b><h1>Activate your SAE Student Forum account</h1><br><a href='http://localhost/Login/controller/verify.cont.php?uid=" . "$userName" . "&email=" . "$email" . "&vcode=" . "$vCode" . "'>Click here to activate your account</a><br><h1>This sender does not support replies</h1></b>";
        $mail->MsgHTML($content);
        // Form error check / Validate via PHP empty function
        if (empty($userName) || empty($email) || empty($password) || empty($passwordRepeat) || empty($fName) || empty($lName) || empty($campus) || empty($course)) {
            // Send user back to signup page if signup fails, also sneds back partial form fill to save re-typing all fields
            header("Location: signup.php?error=emptyfields");
            // Legal character and email check
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
            header("Location: signup.php?error=invalidmailuid");
            // Email validation
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: signup.php?error=invalidmail");

            //To limit the userbase to only SAE students, we check for a valid string that only sae students have in their student email
            // } else if (!preg_match("/@saeinstitute/", $email)) {
            //     header("Location: signup.php?error=invalidmail");
            //The above else if statement has been disabled to allow those testing to register with any valid email address



            // Username validation Regex 
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
            header("Location: signup.php?error=invaliduid");
        } else if (!preg_match("/^[a-zA-Z]*$/", $fName)) {
            header("Location: signup.php?error=invalidfname");
        } else if (!preg_match("/^[a-zA-Z]*$/", $lName)) {
            header("Location: signup.php?error=invalidlname");
        } else if (!preg_match("/^[a-zA-Z\s]*$/", $campus)) {
            header("Location: signup.php?error=invalidcampus");
            // Password confirmation check
        } else if (strlen($_POST["pwd"]) <= '8') {
            header("Location: signup.php?error=password8");
        } elseif (!preg_match("#[0-9]+#", $password)) {
            header("Location: signup.php?error=passwordnum");
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            header("Location: signup.php?error=passwordcap");
        } elseif (!preg_match("#[a-z]+#", $password)) {
            header("Location: signup.php?error=passwordlow");
        } else if ($password !== $passwordRepeat) {
            header("Location: signup.php?error=passwordcheck");
        }
        // Check for conflicting Usernames in Database
        else {
            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: signup.php?error=sqlerror");
            } else {
                // if returned matching usernames = > 0 then no matching username exists so continue
                mysqli_stmt_bind_param($stmt, "s", $userName);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    header("Location: signup.php?error=usertaken&mail=" . $userName);

                    // Check for conflicting Emails in Database
                } else {
                    $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: signup.php?error=sqlerror");
                    } else {
                        // if returned matching emails = > 0 then no matching emails exists so continue
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $resultCheck = mysqli_stmt_num_rows($stmt);
                        if ($resultCheck > 0) {
                            header("Location: signup.php?error=emailtaken&mail=" . $email);
                        } else {
                            //if verification email failed to send then error and stop
                            if (!$mail->Send()) {
                                echo "Error while sending Email.";
                                var_dump($mail);
                            } else {
                                // add new user info to DB
                                $sql = "INSERT INTO users (uidUsers,emailUsers,pwdUsers,imgUsers,bioUsers,firstUsers,lastUsers,campusUsers,courseUsers,faceUsers,linkedUsers,twitUsers,instaUsers,verifiedUsers,vcodeUsers,coverUsers)
                            VALUES (?,?,?,'profiledefault.png','Add a bio',?,?,?,?,'NA','NA','NA','NA','FALSE',?,'coverdefault.png')";
                                $stmt = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("Location: signup.php?error=sqlerror");
                                } else {
                                    //Send account activation email
                                    // Hash password for security
                                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                                    mysqli_stmt_bind_param($stmt, "ssssssss", $userName, $email, $hashedPwd, $fName, $lName, $campus, $course, $vCode);
                                    mysqli_stmt_execute($stmt);
                                    header("Location: signup.php?signup=success");
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
    }
    protected function userForgotPassword()
    {
        $conn = $this->Connection();
        $email = $_POST['email'];
        $sql = "SELECT * FROM users where emailUsers='$email'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $vCode = $row['vcodeUsers'];
        if ($resultCheck > 0) {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Host = "smtp.gmail.com";
            $mail->Username = "studentforumsae@gmail.com";
            $mail->Password = "123sae123";
            $mail->IsHTML(true);
            $mail->AddAddress($email, "Admin");
            $mail->SetFrom("No-Reply@SAE-Student-Forums.com");
            $mail->Subject = "SAE Student Forum";
            $content = "<b><h1>Password Reset<br><a href='http://localhost/Login/pwreset.php?mail=" . "$email" . "&vcode=" . "$vCode" . "'>Click here to reset your password</a></h1></b>";
            $mail->MsgHTML($content);
            ob_start();
            if (!$mail->Send()) {
                echo "Error while sending Email.";
            } else {
                ob_get_clean();
                header("Location: forgotpw.php?pwreset=success");
            }
        } else {
            header("Location: forgotpw.php?pwreseterror");
        }
    }
    protected function updateUserPassword()
    {
        $conn = $this->Connection();
        $vCode = $_POST['vcode'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordrepeat'];
        if (strlen($password) <= '8') {
            header("Location: pwreset.php?mail=" . $mail . "&vcode=" . $vCode . "&error=password8");
        } elseif (!preg_match("#[0-9]+#", $password)) {
            header("Location: pwreset.php?mail=" . $mail . "&vcode=" . $vCode . "&error=passwordnum");
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            header("Location: pwreset.php?mail=" . $mail . "&vcode=" . $vCode . "&error=passwordcap");
        } elseif (!preg_match("#[a-z]+#", $password)) {
            header("Location: pwreset.php?mail=" . $mail . "&vcode=" . $vCode . "&error=passwordlow");
        } else if ($password !== $passwordRepeat) {
            header("Location: pwreset.php?mail=" . $mail . "&vcode=" . $vCode . "&error=passwordcheck");
        } else {

            $sql = "UPDATE users SET pwdUsers = ?, vcodeUsers = ? WHERE vcodeUsers = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?error=sqlerror");
            } else {
                $str = rand();
                $vCodeReplace = hash("sha256", $str);
                //Send account activation email
                // Hash password for security
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "sss", $hashedPwd, $vCodeReplace, $vCode);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location:index.php?pwresetsuccess");
            }
        }
    }
    protected function userLogIn()
    {
        $conn = $this->Connection();
        $mailUid = mysqli_real_escape_string($conn, $_POST['mailuid']);
        $password = mysqli_real_escape_string($conn, $_POST['pwd']);
        // check for empty fields
        if (empty($mailUid) || empty($password)) {
            header("Location: index.php?error=emptyfield");
            exit();
        } else {
            // check username and email credentials from DB to allow either username or email for login
            $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $mailUid, $mailUid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($password, $row['pwdUsers']);
                    if ($pwdCheck == false) {
                        header("Location: index.php?error=wrongpwd");
                        exit();
                        // session issues - SOLVED $_SESSION was lower case
                    } else if ($pwdCheck == true) {
                        session_start();
                        $_SESSION['userId'] = $row['idUsers'];
                        $_SESSION['userUid'] = $row['uidUsers'];
                        $_SESSION['userImg'] = $row['imgUsers'];
                        $_SESSION['userCover'] = $row['coverUsers'];
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
                        header("Location: index.php");
                        exit();
                    } else {
                        header("Location: index.php?error=wrongpwd");
                        exit();
                    }
                } else {
                    header("Location: index.php?error=nouser");
                    exit();
                }
            }
        }
    }
    protected function userLogOut()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?logout");
    }
}