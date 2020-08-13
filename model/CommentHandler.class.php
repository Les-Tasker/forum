<?php
include_once "Comment.class.php";

class CommentHandler extends Comment
{

    public function getTopicRepliesHandler($topicId)
    {
        $commentHandler = $this->getTopicReplies($topicId);
        return $commentHandler;
    }
    public function getCommentByIdHandler($id)
    {
        $commentHandler = $this->getCommentById($id);
        return $commentHandler;
    }
    public function setTopicCommentHandler()
    {
        $commentHandler = $this->setTopicComment();
        return $commentHandler;
    }
    public function commentQuoteHandler()
    {
        $commentHandler = $this->commentQuote();
        return $commentHandler;
    }
    public function commentQuoteProcessHandler($id)
    {
        $commentHandler = $this->commentQuoteProcess($id);
        return $commentHandler;
    }
    public function commentEditHandler()
    {
        $commentHandler = $this->commentEdit();
        return $commentHandler;
    }
    public function commentDeleteHandler()
    {
        $commentHandler = $this->commentDelete();
        return $commentHandler;
    }
}