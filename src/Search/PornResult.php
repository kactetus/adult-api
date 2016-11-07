<?php

namespace Adult\Search;

class PornResult implements ResultInterface
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
        return $this->data['url'];
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
        return $this->data['thumb'];
    }

    public function getThumbs()
    {
        $thumbs = [];
        foreach ($this->data['thumbs'] as $thumb) {
            $thumbs[] = $thumb['url'];
        }
        return $thumbs;
    }

    public function getDuration()
    {
        return $this->data['duration'];
    }
}
