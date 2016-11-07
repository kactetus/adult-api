<?php

namespace Adult\Search;

interface ResultInterface
{
    public function getTags();

    public function getUrl();

    public function getTitle();

    public function getThumb();

    public function getThumbs();

    public function getDuration();
}
