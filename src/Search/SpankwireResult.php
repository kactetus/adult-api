<?php

namespace Adult\Search;

class SpankwireResult implements ResultInterface
{
    protected $data;

    public function __construct($data)
    {
        $this->setData($data['video']);
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getUrl()
    {
        return $this->data['url'];
    }

    public function getTags()
    {
        return [];
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getThumb()
    {
        return $this->data['default_thumb'];
    }

    public function getThumbs()
    {
        return [$this->getThumb()];
    }

    public function getDuration()
    {
        return $this->data['duration'];
    }
}
