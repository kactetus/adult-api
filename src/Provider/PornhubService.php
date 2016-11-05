<?php

namespace Porn\Provider;

class PornhubService extends AbstractService
{
    const URI = 'http://www.pornhub.com/webmasters/';

    /**
     * Searchs the server for videos.
     *
     * @param  array $params An array of criteria to search by
     *
     * @return array An array of results
     */
    public function search($params = [])
    {
        $defaults = [
            'search' => '',
            'category' => '',
            'page' => 1,
            'stars' => 5,
            'tags' => [],
            'thumbsize' => 'large',
        ];

        $endpoint = $this->getEndpoint('search', array_merge($defaults, $params));
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getVideoById($id, $thumbsize = 'medium')
    {
        $endpoint = $this->getEndpoint('video_by_id', [
            'id'        => $id,
            'thumbsize' => $thumbsize,
        ]);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getTagsList($params = [])
    {
        $defaults = ['list' => ''];
        $endpoint = $this->getEndpoint('tags', array_merge($defaults, $params));
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getStarList()
    {
        $endpoint = $this->getEndpoint('stars_detailed');
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getCategoriesList()
    {
        $endpoint = $this->getEndpoint('categories');
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }
}
