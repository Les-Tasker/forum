<?php
include_once "User.class.php";
include_once 'PHPMailer-master/src/Exception.php';
include_once 'PHPMailer-master/src/PHPMailer.php';
include_once 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

//Create class User
class UserHandler extends User
{


    public function getUserInfoByIdHandler($id)
    {
        $UserHandler = $this->getUserInfoById($id);

        return $UserHandler;
    }

    public function getUserInfoByEmailHandler($email)
    {
        $UserHandler = $this->getUserInfoByEmail($email);
        return $UserHandler;
    }

    public function getUserInfoByUsernameHandler($uid)
    {
        $UserHandler = $this->getUserInfoByUsername($uid);
        return $UserHandler;
    }
    public function setUserBioHandler($text, $id)
    {
        $UserHandler = $this->setUserBio($text, $id);
        return $UserHandler;
    }
    public function displayUnreadMessageHandler($user)
    {
        $UserHandler = $this->displayUnreadMessage($user);
        return $UserHandler;
    }
    public function verifyNewUserHandler($email, $vcode)
    {
        $UserHandler = $this->verifyNewUser($email, $vcode);
        return $UserHandler;
    }

    public function setUserProfileImageHandler()
    {
        $UserHandler = $this->setUserProfileImage();
        return $UserHandler;
    }

    public function setUserCoverImageHandler()
    {
        $UserHandler = $this->setUserCoverImage();
        return $UserHandler;
    }
    public function signupNewUserHandler()
    {
        $UserHandler = $this->signupNewUser();
        return $UserHandler;
    }
    public function userForgotPasswordHandler()
    {
        $UserHandler = $this->userForgotPassword();
        return $UserHandler;
    }
    public function updateUserPasswordHandler()
    {
        $UserHandler = $this->updateUserPassword();
        return $UserHandler;
    }
    public function userLogInHandler()
    {
        $UserHandler = $this->userLogIn();
        return $UserHandler;
    }
    public function userLogOutHandler()
    {
        $UserHandler = $this->userLogOut();
        return $UserHandler;
    }
}