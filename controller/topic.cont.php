<?php

require_once 'model/Topic.class.php';
require_once 'model/Comment.class.php';
require_once 'model/User.class.php';
require_once 'view/topic.view.php';
if (isset($_POST['comment-submit'])) {
    $newComment = new CommentHandler;
    $newComment->setTopicCommentHandler();
} else if (isset($_POST['topic-quote-submit'])) {
    $newTopic = new TopicHandler;
    $newTopic->topicQuoteHandler();
} else if (isset($_POST['topic-edit-submit'])) {
    $newTopic = new TopicHandler;
    $newTopic->topicEditHandler();
} else if (isset($_POST['topic-delete-submit'])) {
    $newTopic = new TopicHandler;
    $newTopic->topicDeleteHandler();
} else if (isset($_POST['comment-quote-submit'])) {
    $newComment = new CommentHandler;
    $newComment->commentQuoteHandler();
} else if (isset($_POST['comment-edit-submit'])) {
    $newComment = new CommentHandler;
    $newComment->commentEditHandler();
} else if (isset($_POST['comment-delete-submit'])) {
    $newComment = new CommentHandler;
    $newComment->commentDeleteHandler();
} else if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    if (isset($_GET['id']) && isset($_GET['campus']) && isset($_GET['course']) && isset($_GET['category'])) {
        $newTopic = new TopicHandler;
        $newComment = new CommentHandler;
        $topic = $newTopic->getTopicByIdHandler($_GET['id']);
        $comment = $newComment->getCommentByIdHandler($_GET['id']);
        displayTopic($topic, $comment);
    } else if (isset($_GET['aux'])) {
        $newTopic = new TopicHandler;
        $aux = $newTopic->GetAuxTopicHandler($_GET['aux']);
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