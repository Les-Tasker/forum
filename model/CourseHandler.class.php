<?php
include_once "Course.class.php";

class CourseHandler extends Course
{

    public function getCoursesHandler()
    {
        $CourseHandler = $this->getCourses();
        return $CourseHandler;
    }
    public function courseTopicCountHandler($campusName, $courseName)
    {
        $CourseHandler = $this->courseTopicCount($campusName, $courseName);
        return $CourseHandler;
    }
}