<?php
include_once "User.class.php";
include_once 'PHPMailer-master/src/Exception.php';
include_once 'PHPMailer-master/src/PHPMailer.php';
include_once 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

//Create class User
class UserHandler extends User
{


    public function Get_user_info_by_id_Handler($id)
    {
        $UserHandler = $this->Get_user_info_by_id($id);
        return $UserHandler;
    }

    public function Get_user_info_by_email_Handler($email)
    {
        $UserHandler = $this->Get_user_info_by_email($email);
        return $UserHandler;
    }

    public function Get_user_info_by_username_Handler($uid)
    {
        $UserHandler = $this->Get_user_info_by_username($uid);
        return $UserHandler;
    }
    public function Set_user_bio_Handler($text, $id)
    {
        $UserHandler = $this->Set_user_bio($text, $id);
        return $UserHandler;
    }
    public function Display_unread_message_Handler($user)
    {
        $UserHandler = $this->Display_unread_message($user);
        return $UserHandler;
    }
    public function Verify_new_user_Handler($email, $vcode)
    {
        $UserHandler = $this->Verify_new_user($email, $vcode);
        return $UserHandler;
    }

    public function Set_user_profile_image_Handler()
    {
        $UserHandler = $this->Set_user_profile_image();
        return $UserHandler;
    }

    public function Set_user_cover_image_Handler()
    {
        $UserHandler = $this->Set_user_cover_image();
        return $UserHandler;
    }
    public function Signup_new_user_Handler()
    {
        $UserHandler = $this->Signup_new_user();
        return $UserHandler;
    }
    public function User_forgot_password_Handler()
    {
        $UserHandler = $this->User_forgot_password();
        return $UserHandler;
    }
    public function Update_user_password_Handler()
    {
        $UserHandler = $this->Update_user_password();
        return $UserHandler;
    }
    public function User_log_in_Handler()
    {
        $UserHandler = $this->User_log_in();
        return $UserHandler;
    }
    public function User_log_out_Handler()
    {
        $UserHandler = $this->User_log_out();
        return $UserHandler;
    }
}