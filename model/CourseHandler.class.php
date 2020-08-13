<?php
include_once "Course.class.php";

class CourseHandler extends Course
{

    public function getCoursesHandler()
    {
        $courseHandler = $this->getCourses();
        return $courseHandler;
    }
    public function courseTopicCountHandler($campusName, $courseName)
    {
        $courseHandler = $this->courseTopicCount($campusName, $courseName);
        return $courseHandler;
    }
}