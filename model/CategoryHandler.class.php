<?php
include_once "Category.class.php";

class CategoryHandler extends Category
{

    public function getCategoryHandler()
    {
        $CategoryHandler = $this->getCategory();
        return $CategoryHandler;
    }
    public function categoryTopicCountHandler($campusName, $courseName, $categoryName)
    {
        $CategoryHandler = $this->categoryTopicCount($campusName, $courseName, $categoryName);
        return $CategoryHandler;
    }
}