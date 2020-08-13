<?php
include_once "Category.class.php";

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