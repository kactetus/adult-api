<?php

namespace Porn\Provider;

class YoupornService extends AbstractService
{
    const URI = 'http://www.youporn.com/api/webmasters/';
    const TYPE = 'youporn';

    /**
     * Searchs the server for videos.
     *
     * @param  array $params An array of criteria to search by
     *
     * @return array An array of results
     */
    public function search($terms, $params = [])
    {
        $endpoint = $this->getSearchEndpoint($terms, $params);
        $response = $this->request($endpoint);
        return $this->handleSearchResponse($response);
    }

    public function handleSearchResponse($response)
    {
        $data = $this->decodeResponse($response);
        return $this->getTransformedResultData(self::TYPE, $data['video']);
    }

    public function getSearchEndpoint($terms, $params = [])
    {
        $defaults = [
            'search'    => $terms,
            'category'  => '',
            'page'      => 1,
            'stars'     => 5,
            'tags'      => [],
            'thumbsize' => 'large',
        ];

        return $this->getEndpoint('search', array_merge($defaults, $params));
    }

    public function getVideoById($id, $thumbsize = 'medium')
    {
        $endpoint = $this->getEndpoint('video_by_id', [
            'video_id'  => $id,
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
