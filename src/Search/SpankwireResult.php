<?php

namespace Adult\Search;

class SpankwireResult extends AbstractResult
{
    public function __construct($data)
    {
        $this->setData($data['video']);
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
