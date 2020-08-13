<?php
include_once "Topic.class.php";

class TopicHandler extends Topic
{


    public function setNewTopicHandler()
    {
        $topicHandler = $this->setNewTopic();
        return $topicHandler;
    }
    public function campusTopicCountHandler($campusName)
    {
        $topicHandler = $this->campusTopicCount($campusName);
        return $topicHandler;
    }
    public function getTopicListHandler($courseName, $campusName, $categoryName)
    {
        $topicHandler = $this->getTopicList($courseName, $campusName, $categoryName);
        return $topicHandler;
    }
    public function getTopicByIdHandler($id)
    {
        $topicHandler = $this->getTopicById($id);
        return $topicHandler;
    }
    public function getAuxTopicHandler($aux)
    {
        $topicHandler = $this->getAuxTopic($aux);
        return $topicHandler;
    }
    public function topicQuoteHandler()
    {
        $topicHandler = $this->topicQuote();
        return $topicHandler;
    }
    public function topicQuoteProcessHandler($id)
    {
        $topicHandler = $this->topicQuoteProcess($id);
        return $topicHandler;
    }
    public function topicEditHandler()
    {
        $topicHandler = $this->topicEdit();
        return $topicHandler;
    }
    public function topicDeleteHandler()
    {
        $topicHandler = $this->topicDelete();
        return $topicHandler;
    }
    public function searchResultHandler($search)
    {
        $topicHandler = $this->searchResult($search);
        return $topicHandler;
    }
}