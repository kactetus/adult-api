<?php

namespace Porn\Search;

class Tube8Result implements ResultInterface
{
    protected $data;

    public function __construct($data)
    {
        $this->setData($data);
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getUrl()
    {
        return $this->data['video']['url'];
    }

    public function getTags()
    {
        return $this->data['tags'];
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getThumb()
    {
        return $this->data['video']['default_thumb'];
    }

    public function getThumbs()
    {
        return current($this->data['thumbs']);
    }

    public function getDuration()
    {
        return $this->data['video']['duration'];
    }
}
