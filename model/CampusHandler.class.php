<?php
include_once "Campus.class.php";
class CampusHandler extends Campus
{


    public function getCampusHandler()
    {
        $CampusHandler = $this->getCampus();
        return $CampusHandler;
    }
    public function campusTopicCountHandler($campusName)
    {
        $CampusHandler = $this->campusTopicCount($campusName);
        return $CampusHandler;
    }
}