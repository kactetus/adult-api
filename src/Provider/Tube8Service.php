<?php

namespace Porn\Provider;

class Tube8Service extends AbstractService
{
    const URI = 'http://api.tube8.com/api.php';
    const TYPE = 'tube8';

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
        return $this->getTransformedResultData(self::TYPE, $data['videos']);
    }

    public function getSearchEndpoint($terms, $params = [])
    {
        $defaults = [
            'search'    => $terms,
            'category'  => '',
            'page'      => 1,
            'thumbsize' => 'large',
            'output'    => 'json',
            'action'    => 'searchVideos',
        ];

        return $this->getEndpoint(null, array_merge($defaults, $params));
    }

    public function getVideoById($id, $thumbsize = 'medium')
    {
        $endpoint = $this->getEndpoint(null, [
            'action'    => 'getVideoById',
            'output'    => 'json',
            'thumbsize' => $thumbsize,
            'video_id'  => $id,
        ]);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getTagsList()
    {
        $endpoint = $this->getEndpoint(null, [
            'action' => 'gettaglist',
            'output' => 'json',
        ]);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getCategoriesList()
    {
        $endpoint = $this->getEndpoint(null, [
            'action' => 'getcategorieslist',
            'output' => 'json',
        ]);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }
}
