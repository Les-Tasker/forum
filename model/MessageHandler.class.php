<?php
include_once "Message.class.php";

class MessageHandler extends Message
{


    public function sendMessageFromProfileHandler()
    {
        $MessageHandler = $this->sendMessageFromProfile();
        return $MessageHandler;
    }
    public function replyInboxHandler()
    {
        $MessageHandler = $this->replyInbox();
        return $MessageHandler;
    }
    public function getMessagesHandler($conID)
    {
        $MessageHandler = $this->getMessages($conID);
        return $MessageHandler;
    }
    public function setMsgStatusHandler($conID, $user)
    {
        $MessageHandler = $this->setMsgStatus($conID, $user);
        return $MessageHandler;
    }
    public function getInboxHandler($userID)
    {
        $MessageHandler = $this->getInbox($userID);
        return $MessageHandler;
    }
    public function getNewMessageNotificationHandler($conID, $toid)
    {
        $MessageHandler = $this->getNewMessageNotification($conID, $toid);
        return $MessageHandler;
    }
    public function getRecentMessageHandler($id)
    {
        $MessageHandler = $this->getRecentMessage($id);
        return $MessageHandler;
    }
}