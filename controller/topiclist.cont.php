<?php

require_once "model/TopicHandler.class.php";
if (isset($_POST['topic-submit'])) {
    $NewTopic = new TopicHandler;
    $NewTopic->Set_new_topic_Handler();
}
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    if ($_GET['category'] && $_GET['campus'] && $_GET['course']) {
        require_once 'model/CourseHandler.class.php';
        require_once 'model/CampusHandler.class.php';
        require_once 'model/CategoryHandler.class.php';
        require_once "view/topiclist.view.php";
        $Course = new CourseHandler;
        $CourseList = $Course->Get_courses_Handler();
        $Campus = new CampusHandler;
        $CampusList = $Campus->Get_campus_Handler();
        $Category = new CategoryHandler;
        $CategoryList = $Category->Get_category_Handler();
        //create array to store object values
        $CampusArray = [];
        $CourseArray = [];
        $CategoryArray = [];
        //loop objects and add values to array
        foreach ($CampusList as $item) {
            array_push($CampusArray, $item['campus']);
        }
        foreach ($CourseList as $item) {
            array_push($CourseArray, $item['course']);
        }
        foreach ($CategoryList as $item) {
            array_push($CategoryArray, $item['category']);
        }
        if (in_array($_GET['campus'], $CampusArray) && in_array($_GET['course'], $CourseArray) && in_array($_GET['category'], $CategoryArray)) {
            $NewTopic = new TopicHandler;
            $topic = $NewTopic->Get_topic_list_Handler($_GET['course'], $_GET['campus'], $_GET['category']);
            Display_topic_list($topic);
        } else {
            // if false, user has attempted to manipulate URL or followed a bad link
            // redirect to error 404 page
            header("Location: 404.php");
        }
        //if Campus parameter is not set, user has attempted to manipulate URL or followed a bad link
        // redirect to error 404 page
    } else {
        header("Location: 404.php");
    }
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}