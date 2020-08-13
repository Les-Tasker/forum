<?php
include_once "DBConn.class.php";

class Category extends DBConn
{

    protected function getCategory()
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM category;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            return $result;
        }
    }
    protected function categoryTopicCount($campusName, $courseName, $categoryName)
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE campus = '$campusName' AND course ='$courseName' AND category ='$categoryName' ";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo $resultCheck;
    }
}
class CategoryHandler extends Category
{

    public function getCategoryHandler()
    {
        $categoryHandler = $this->getCategory();
        return $categoryHandler;
    }
    public function categoryTopicCountHandler($campusName, $courseName, $categoryName)
    {
        $categoryHandler = $this->categoryTopicCount($campusName, $courseName, $categoryName);
        return $categoryHandler;
    }
}