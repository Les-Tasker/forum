<?php
include_once "Message.class.php";

class MessageHandler extends Message
{


    public function Send_message_from_profile_Handler()
    {
        $MessageHandler = $this->Send_message_from_profile();
        return $MessageHandler;
    }
    public function Reply_inbox_Handler()
    {
        $MessageHandler = $this->Reply_inbox();
        return $MessageHandler;
    }
    public function Get_messages_Handler($conID)
    {
        $MessageHandler = $this->Get_messages($conID);
        return $MessageHandler;
    }
    public function Set_msg_status_Handler($conID, $user)
    {
        $MessageHandler = $this->Set_msg_status($conID, $user);
        return $MessageHandler;
    }
    public function Get_inbox_Handler($userID)
    {
        $MessageHandler = $this->Get_inbox($userID);
        return $MessageHandler;
    }
    public function Get_new_message_notification_Handler($conID, $toid)
    {
        $MessageHandler = $this->Get_new_message_notification($conID, $toid);
        return $MessageHandler;
    }
}