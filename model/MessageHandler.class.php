<?php
include_once "Message.class.php";

class MessageHandler extends Message
{


    public function sendMessageFromProfileHandler()
    {
        $messageHandler = $this->sendMessageFromProfile();
        return $messageHandler;
    }
    public function replyInboxHandler()
    {
        $messageHandler = $this->replyInbox();
        return $messageHandler;
    }
    public function getMessagesHandler($conId)
    {
        $messageHandler = $this->getMessages($conId);
        return $messageHandler;
    }
    public function setMsgStatusHandler($conId, $user)
    {
        $messageHandler = $this->setMsgStatus($conId, $user);
        return $messageHandler;
    }
    public function getInboxHandler($userId)
    {
        $messageHandler = $this->getInbox($userId);
        return $messageHandler;
    }
    public function getNewMessageNotificationHandler($conId, $toid)
    {
        $messageHandler = $this->getNewMessageNotification($conId, $toid);
        return $messageHandler;
    }
    public function getRecentMessageHandler($id)
    {
        $messageHandler = $this->getRecentMessage($id);
        return $messageHandler;
    }
}