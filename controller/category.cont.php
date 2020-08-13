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
        $Course = new CourseHandler;
        $CourseList = $Course->getCoursesHandler();
        $Campus = new CampusHandler;
        $CampusList = $Campus->getCampusHandler();
        //create array to store object values
        $CampusArray = [];
        $CourseArray = [];
        //loop objects and add values to array
        foreach ($CampusList as $item) {
            array_push($CampusArray, $item['campus']);
        }
        foreach ($CourseList as $item) {
            array_push($CourseArray, $item['course']);
        }

        if (in_array($_GET['campus'], $CampusArray) && in_array($_GET['course'], $CourseArray)) {
            //if true, display corresponding forum section
            $NewCategory = new CategoryHandler;
            $category = $NewCategory->getCategoryHandler();
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