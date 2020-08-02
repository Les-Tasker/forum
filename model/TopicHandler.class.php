<?php
include_once "Topic.class.php";

class TopicHandler extends Topic
{


    public function Set_new_topic_Handler()
    {
        $TopicHandler = $this->Set_new_topic();
        return $TopicHandler;
    }
    public function Campus_topic_count_Handler($campusName)
    {
        $TopicHandler = $this->Campus_topic_count($campusName);
        return $TopicHandler;
    }
    public function Get_topic_list_Handler($courseName, $campusName, $categoryName)
    {
        $TopicHandler = $this->Get_topic_list($courseName, $campusName, $categoryName);
        return $TopicHandler;
    }
    public function Get_topic_by_id_Handler($id)
    {
        $TopicHandler = $this->Get_topic_by_id($id);
        return $TopicHandler;
    }
    public function Get_aux_topic_Handler($aux)
    {
        $TopicHandler = $this->Get_aux_topic($aux);
        return $TopicHandler;
    }
    public function Topic_quote_Handler()
    {
        $TopicHandler = $this->Topic_quote();
        return $TopicHandler;
    }
    public function Topic_quote_process_Handler($id)
    {
        $TopicHandler = $this->Topic_quote_process($id);
        return $TopicHandler;
    }
    public function Topic_edit_Handler()
    {
        $TopicHandler = $this->Topic_edit();
        return $TopicHandler;
    }
    public function Topic_delete_Handler()
    {
        $TopicHandler = $this->Topic_delete();
        return $TopicHandler;
    }
    public function Search_result_Handler($search)
    {
        $TopicHandler = $this->Search_result($search);
        return $TopicHandler;
    }
}