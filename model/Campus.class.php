<?php
include_once "DBConn.class.php";
class Campus extends DBConn
{


    protected function getCampus()
    {
        $conn = $this->Connection();
        $sql = "SELECT * FROM campus;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        // if amount of entries in table is greater than 0, loop through entries and echo out
        if ($resultCheck > 0) {
            return $result;
        }
    }
    protected function campusTopicCount($campusName)
    {
        // A Topic SELECT query in Course class as it is more relevant
        // It queries amount of topics in the Course category of the forum
        $conn = $this->Connection();
        $sql = "SELECT * FROM topics WHERE campus = '$campusName'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        return $resultCheck;
    }
}