<?php
include_once "Comment.class.php";

class CommentHandler extends Comment
{

    public function getTopicRepliesHandler($topicid)
    {
        $CommentHandler = $this->getTopicReplies($topicid);
        return $CommentHandler;
    }
    public function getCommentByIdHandler($id)
    {
        $CommentHandler = $this->getCommentById($id);
        return $CommentHandler;
    }
    public function setTopicCommentHandler()
    {
        $CommentHandler = $this->setTopicComment();
        return $CommentHandler;
    }
    public function commentQuoteHandler()
    {
        $CommentHandler = $this->commentQuote();
        return $CommentHandler;
    }
    public function commentQuoteProcessHandler($id)
    {
        $CommentHandler = $this->commentQuoteProcess($id);
        return $CommentHandler;
    }
    public function commentEditHandler()
    {
        $CommentHandler = $this->commentEdit();
        return $CommentHandler;
    }
    public function commentDeleteHandler()
    {
        $CommentHandler = $this->commentDelete();
        return $CommentHandler;
    }
}