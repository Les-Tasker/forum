<?php
include_once "Comment.class.php";

class CommentHandler extends Comment
{

    public function Get_topic_replies_Handler($topicid)
    {
        $CommentHandler = $this->Get_topic_replies($topicid);
        return $CommentHandler;
    }
    public function Get_comment_by_id_Handler($id)
    {
        $CommentHandler = $this->Get_comment_by_id($id);
        return $CommentHandler;
    }
    public function Set_topic_comment_Handler()
    {
        $CommentHandler = $this->Set_topic_comment();
        return $CommentHandler;
    }
    public function Comment_quote_Handler()
    {
        $CommentHandler = $this->Comment_quote();
        return $CommentHandler;
    }
    public function Comment_quote_process_Handler($id)
    {
        $CommentHandler = $this->Comment_quote_process($id);
        return $CommentHandler;
    }
    public function Comment_edit_Handler()
    {
        $CommentHandler = $this->Comment_edit();
        return $CommentHandler;
    }
    public function Comment_delete_Handler()
    {
        $CommentHandler = $this->Comment_delete();
        return $CommentHandler;
    }
}