<?php

namespace Porn\Provider;

class PornService extends AbstractService
{
    const URI = 'http://api.porn.com/';
    const TYPE = 'porn';

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
        return $this->getTransformedResultData(self::TYPE, $data['result']);
    }

    public function getSearchEndpoint($terms, $params = [])
    {
        $defaults = [
            'search' => $terms,
            'cats'   => '',
            'page'   => 1,
            'tags'   => [],
            'thumbs' => 'large',
        ];

         return $this->getEndpoint('videos/find.json', array_merge($defaults, $params));
    }

    public function getVideoById($id, $thumbsize = 'medium')
    {
        $endpoint = $this->getEndpoint('video_by_id', [
            'video_id'  => $id,
            'thumbsize' => $thumbsize,
        ]);

        $response = $this->request($endpoint);
        $result   = $this->decodeResponse($response);
        return $result['result'];
    }

    public function getStarList($params = [])
    {
        $defaults = [
            'name'  => '',
            'sex'   => '',
            'order' => 'views'
        ];

        $endpoint = $this->getEndpoint('actors/find.json', array_merge($defaults, $params));
        $response = $this->request($endpoint);
        $result   = $this->decodeResponse($response);
        return $result['result'];
    }

    public function getCategoriesList()
    {
        $endpoint = $this->getEndpoint('categories/find.json');
        $response = $this->request($endpoint);
        $result   = $this->decodeResponse($response);
        return $result['result'];
    }

    public function getChannelsList($params = [])
    {
        $defaults = ['name' => ''];
        $endpoint = $this->getEndpoint('channels/find.json', array_merge($defaults, $params));
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }
}
