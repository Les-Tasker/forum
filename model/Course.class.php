<?php
include_once "DBConn.class.php";

class Course extends DBConn
{

    protected function getCourses()
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM courses;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            return $result;
        } else {
        }
    }
    protected function courseTopicCount($campusName, $courseName)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE campus = '$campusName' AND course ='$courseName'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo $resultCheck;
    }
}
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