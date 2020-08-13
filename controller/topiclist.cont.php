<?php

require_once "model/Topic.class.php";
if (isset($_POST['topic-submit'])) {
    $NewTopic = new TopicHandler;
    $NewTopic->setNewTopicHandler();
}
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    if ($_GET['category'] && $_GET['campus'] && $_GET['course']) {
        require_once 'model/Course.class.php';
        require_once 'model/Campus.class.php';
        require_once 'model/Category.class.php';
        require_once "view/topiclist.view.php";
        $course = new CourseHandler;
        $courseList = $course->getCoursesHandler();
        $campus = new CampusHandler;
        $campusList = $campus->getCampusHandler();
        $category = new CategoryHandler;
        $categoryList = $category->getCategoryHandler();
        //create array to store object values
        $campusArray = [];
        $courseArray = [];
        $categoryArray = [];
        //loop objects and add values to array
        foreach ($campusList as $item) {
            array_push($campusArray, $item['campus']);
        }
        foreach ($courseList as $item) {
            array_push($courseArray, $item['course']);
        }
        foreach ($categoryList as $item) {
            array_push($categoryArray, $item['category']);
        }
        if (in_array($_GET['campus'], $campusArray) && in_array($_GET['course'], $courseArray) && in_array($_GET['category'], $categoryArray)) {
            $newTopic = new TopicHandler;
            $topic = $newTopic->getTopicListHandler($_GET['course'], $_GET['campus'], $_GET['category']);
            displayTopicList($topic);
        } else {
            // if false, user has attempted to manipulate URL or followed a bad link
            // redirect to error 404 page
            header("Location: 404.php");
        }
    }
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}