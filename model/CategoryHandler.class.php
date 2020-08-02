<?php
include_once "Category.class.php";

class CategoryHandler extends Category
{

    public function Get_category_Handler()
    {
        $CategoryHandler = $this->Get_category();
        return $CategoryHandler;
    }
    public function Category_topic_count_Handler($campusName, $courseName, $categoryName)
    {
        $CategoryHandler = $this->Category_topic_count($campusName, $courseName, $categoryName);
        return $CategoryHandler;
    }
}