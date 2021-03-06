<?php

namespace Adult\Search;

class XtubeResult extends AbstractResult
{
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
            $thumbs[] = $thumb['src'];
        }
        return $thumbs;
    }

    public function getDuration()
    {
        return $this->data['duration'];
    }
}
