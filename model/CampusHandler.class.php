<?php
include_once "Campus.class.php";
class CampusHandler extends Campus
{


    public function getCampusHandler()
    {
        $campusHandler = $this->getCampus();
        return $campusHandler;
    }
    public function campusTopicCountHandler($campusName)
    {
        $campusHandler = $this->campusTopicCount($campusName);
        return $campusHandler;
    }
}