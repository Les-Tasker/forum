<?php

require_once 'model/TopicHandler.class.php';
require_once 'model/CommentHandler.class.php';
require_once 'model/UserHandler.class.php';
require_once 'view/topic.view.php';
if (isset($_POST['comment-submit'])) {
    $NewComment = new CommentHandler;
    $NewComment->Set_topic_comment_Handler();
} else if (isset($_POST['topic-quote-submit'])) {
    $NewTopic = new TopicHandler;
    $NewTopic->Topic_quote_Handler();
} else if (isset($_POST['topic-edit-submit'])) {
    $NewTopic = new TopicHandler;
    $NewTopic->Topic_edit_Handler();
} else if (isset($_POST['topic-delete-submit'])) {
    $NewTopic = new TopicHandler;
    $NewTopic->Topic_delete_Handler();
} else if (isset($_POST['comment-quote-submit'])) {
    $NewComment = new CommentHandler;
    $NewComment->Comment_quote_Handler();
} else if (isset($_POST['comment-edit-submit'])) {
    $NewComment = new CommentHandler;
    $NewComment->Comment_edit_Handler();
} else if (isset($_POST['comment-delete-submit'])) {
    $NewComment = new CommentHandler;
    $NewComment->Comment_delete_Handler();
} else if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    if (isset($_GET['id']) && isset($_GET['campus']) && isset($_GET['course']) && isset($_GET['category'])) {
        $NewTopic = new TopicHandler;
        $NewComment = new CommentHandler;
        $Topic = $NewTopic->Get_topic_by_id_Handler($_GET['id']);
        $Comment = $NewComment->Get_comment_by_id_Handler($_GET['id']);
        displayTopic($Topic, $Comment);
    } else if (isset($_GET['aux'])) {
        $NewTopic = new TopicHandler;
        $aux = $NewTopic->Get_aux_topic_Handler($_GET['aux']);
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