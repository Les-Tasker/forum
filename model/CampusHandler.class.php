<?php
include_once "Campus.class.php";
class CampusHandler extends Campus
{


    public function Get_campus_Handler()
    {
        $CampusHandler = $this->Get_campus();
        return $CampusHandler;
    }
    public function Campus_topic_count_Handler($campusName)
    {
        $CampusHandler = $this->Campus_topic_count($campusName);
        return $CampusHandler;
    }
}