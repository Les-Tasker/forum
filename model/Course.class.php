<?php
include_once "DBConn.class.php";

class Course extends DBConn
{

    protected function Get_courses()
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
    protected function Course_topic_count($campusName, $courseName)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE campus = '$campusName' AND course ='$courseName'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo $resultCheck;
    }
}