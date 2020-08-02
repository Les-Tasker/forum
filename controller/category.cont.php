<?php

require_once "view/category.view.php";


if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    if ($_GET['campus'] && $_GET['course']) {
        require_once 'model/CourseHandler.class.php';
        require_once 'model/CampusHandler.class.php';
        require_once 'model/CategoryHandler.class.php';
        $Course = new CourseHandler;
        $CourseList = $Course->Get_courses_Handler();
        $Campus = new CampusHandler;
        $CampusList = $Campus->Get_campus_Handler();
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
            $category = $NewCategory->Get_category_Handler();
            displayCategory($category);
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