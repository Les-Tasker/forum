<?php
include_once "DBConn.class.php";

class Category extends DBConn
{

    protected function Get_category()
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM category;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            return $result;
        }
    }
    protected function Category_topic_count($campusName, $courseName, $categoryName)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE campus = '$campusName' AND course ='$courseName' AND category ='$categoryName' ";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo $resultCheck;
    }
}