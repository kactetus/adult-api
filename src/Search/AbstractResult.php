<?php

namespace Adult\Search;

abstract class AbstractResult implements \JsonSerializable
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

    abstract public function getUrl();

    abstract public function getTags();

    abstract public function getTitle();

    abstract public function getThumb();

    abstract public function getThumbs();

    abstract public function getDuration();

    public function jsonSerialize()
    {
        return [
            'url'      => $this->getUrl(),
            'thumb'    => $this->getThumb(),
            'thumbs'   => $this->getThumbs(),
            'duration' => $this->getDuration(),
            'title'    => $this->getTitle(),
            'tags'     => $this->getTags(),
        ];
    }
}
