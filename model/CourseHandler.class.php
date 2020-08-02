<?php
include_once "Course.class.php";

class CourseHandler extends Course
{

    public function Get_courses_Handler()
    {
        $CourseHandler = $this->Get_courses();
        return $CourseHandler;
    }
    public function Course_topic_count_Handler($campusName, $courseName)
    {
        $CourseHandler = $this->Course_topic_count($campusName, $courseName);
        return $CourseHandler;
    }
}