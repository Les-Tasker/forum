<?php
require_once "header.php";
// check if a user is logged in by checking if a session has been started
// if session has been started and userVerified == TRUE, run code
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    require_once 'model/CourseHandler.class.php';
    require_once 'model/CampusHandler.class.php';
    require_once "view/course.view.php";
    //Check if Campus parameter is set in URL
    if ($_GET['campus']) {
        $course = new CourseHandler;
        $courseList = $course->getCoursesHandler();
        $campus = new CampusHandler;
        $campusList = $campus->getCampusHandler();
        //create array to store object values
        $list = [];
        //loop object and add values to array
        foreach ($campusList as $item) {
            array_push($list, $item['campus']);
        }
        //check if the URL Campus parameter is in the array of values created
        if (in_array($_GET['campus'], $list)) {
            //if true, display corresponding forum section
            displayCourse($courseList);
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
require_once "footer.php";