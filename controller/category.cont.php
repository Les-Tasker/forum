<?php

require_once "view/category.view.php";

//Checks for user logged in and account is verified
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    //Check URL has valid parameters
    if ($_GET['campus'] && $_GET['course']) {
        //if logged in and valid parameters load model classes
        require_once 'model/CourseHandler.class.php';
        require_once 'model/CampusHandler.class.php';
        require_once 'model/CategoryHandler.class.php';
        $course = new CourseHandler;
        $courseList = $Course->getCoursesHandler();
        $campus = new CampusHandler;
        $campusList = $Campus->getCampusHandler();
        //create array to store object values
        $campusArray = [];
        $courseArray = [];
        //loop objects and add values to array
        foreach ($campusList as $item) {
            array_push($campusArray, $item['campus']);
        }
        foreach ($courseList as $item) {
            array_push($courseArray, $item['course']);
        }

        if (in_array($_GET['campus'], $campusArray) && in_array($_GET['course'], $courseArray)) {
            //if true, display corresponding forum section
            $newCategory = new CategoryHandler;
            $category = $newCategory->getCategoryHandler();
            displayCategory($category);
        } else {
        }
    } else {
    }
} else {
    //if user is not logged in or user is logged in but not verified
    //run loggedOut function which prompts user to login / check verification email
    require_once "view/loggedout.view.php";
    loggedOut();
}