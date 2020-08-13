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
        $userHandler = $this->getUserInfoById($id);

        return $userHandler;
    }

    public function getUserInfoByEmailHandler($email)
    {
        $userHandler = $this->getUserInfoByEmail($email);
        return $userHandler;
    }

    public function getUserInfoByUsernameHandler($uid)
    {
        $userHandler = $this->getUserInfoByUsername($uid);
        return $userHandler;
    }
    public function setUserBioHandler($text, $id)
    {
        $userHandler = $this->setUserBio($text, $id);
        return $userHandler;
    }
    public function displayUnreadMessageHandler($user)
    {
        $userHandler = $this->displayUnreadMessage($user);
        return $userHandler;
    }
    public function verifyNewUserHandler($email, $vcode)
    {
        $userHandler = $this->verifyNewUser($email, $vcode);
        return $userHandler;
    }

    public function setUserProfileImageHandler()
    {
        $userHandler = $this->setUserProfileImage();
        return $userHandler;
    }

    public function setUserCoverImageHandler()
    {
        $userHandler = $this->setUserCoverImage();
        return $userHandler;
    }
    public function signupNewUserHandler()
    {
        $userHandler = $this->signupNewUser();
        return $userHandler;
    }
    public function userForgotPasswordHandler()
    {
        $userHandler = $this->userForgotPassword();
        return $userHandler;
    }
    public function updateUserPasswordHandler()
    {
        $userHandler = $this->updateUserPassword();
        return $userHandler;
    }
    public function userLogInHandler()
    {
        $userHandler = $this->userLogIn();
        return $userHandler;
    }
    public function userLogOutHandler()
    {
        $userHandler = $this->userLogOut();
        return $userHandler;
    }
}