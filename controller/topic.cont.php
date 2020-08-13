<?php

require_once 'model/TopicHandler.class.php';
require_once 'model/CommentHandler.class.php';
require_once 'model/UserHandler.class.php';
require_once 'view/topic.view.php';
if (isset($_POST['comment-submit'])) {
    $NewComment = new CommentHandler;
    $NewComment->setTopicCommentHandler();
} else if (isset($_POST['topic-quote-submit'])) {
    $NewTopic = new TopicHandler;
    $NewTopic->topicQuoteHandler();
} else if (isset($_POST['topic-edit-submit'])) {
    $NewTopic = new TopicHandler;
    $NewTopic->topicEditHandler();
} else if (isset($_POST['topic-delete-submit'])) {
    $NewTopic = new TopicHandler;
    $NewTopic->topicDeleteHandler();
} else if (isset($_POST['comment-quote-submit'])) {
    $NewComment = new CommentHandler;
    $NewComment->commentQuoteHandler();
} else if (isset($_POST['comment-edit-submit'])) {
    $NewComment = new CommentHandler;
    $NewComment->commentEditHandler();
} else if (isset($_POST['comment-delete-submit'])) {
    $NewComment = new CommentHandler;
    $NewComment->commentDeleteHandler();
} else if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    if (isset($_GET['id']) && isset($_GET['campus']) && isset($_GET['course']) && isset($_GET['category'])) {
        $NewTopic = new TopicHandler;
        $NewComment = new CommentHandler;
        $Topic = $NewTopic->getTopicByIdHandler($_GET['id']);
        $Comment = $NewComment->getCommentByIdHandler($_GET['id']);
        displayTopic($Topic, $Comment);
    } else if (isset($_GET['aux'])) {
        $NewTopic = new TopicHandler;
        $aux = $NewTopic->GetAuxTopicHandler($_GET['aux']);
        displayAux($aux);
        //Adds reply box to specific auxilary topics
        // if (isset($_GET['id'])) {
        //     if ($_GET['id'] == 1) {
        //         $comment = showComment($_GET['id']);
        //         displayReplyBox($comment);
        //     }
        // }
    }
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}