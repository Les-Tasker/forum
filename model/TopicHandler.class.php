<?php
include_once "Topic.class.php";

class TopicHandler extends Topic
{


    public function setNewTopicHandler()
    {
        $TopicHandler = $this->setNewTopic();
        return $TopicHandler;
    }
    public function campusTopicCountHandler($campusName)
    {
        $TopicHandler = $this->campusTopicCount($campusName);
        return $TopicHandler;
    }
    public function getTopicListHandler($courseName, $campusName, $categoryName)
    {
        $TopicHandler = $this->getTopicList($courseName, $campusName, $categoryName);
        return $TopicHandler;
    }
    public function getTopicByIdHandler($id)
    {
        $TopicHandler = $this->getTopicById($id);
        return $TopicHandler;
    }
    public function getAuxTopicHandler($aux)
    {
        $TopicHandler = $this->getAuxTopic($aux);
        return $TopicHandler;
    }
    public function topicQuoteHandler()
    {
        $TopicHandler = $this->topicQuote();
        return $TopicHandler;
    }
    public function topicQuoteProcessHandler($id)
    {
        $TopicHandler = $this->topicQuoteProcess($id);
        return $TopicHandler;
    }
    public function topicEditHandler()
    {
        $TopicHandler = $this->topicEdit();
        return $TopicHandler;
    }
    public function topicDeleteHandler()
    {
        $TopicHandler = $this->topicDelete();
        return $TopicHandler;
    }
    public function searchResultHandler($search)
    {
        $TopicHandler = $this->searchResult($search);
        return $TopicHandler;
    }
}