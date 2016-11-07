<?php

namespace Adult\Search;

class PornhubResult extends AbstractResult
{
    public function getUrl()
    {
        return $this->data['url'];
    }

    public function getTags()
    {
        $tags = [];
        foreach ($this->data['tags'] as $tag) {
            $tags[] = $tag['tag_name'];
        }
        return $tags;
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
        list($minutes, $seconds) = explode(':', $this->data['duration']);
        return ($minutes * 60) + $seconds;
    }
}
