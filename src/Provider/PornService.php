<?php

namespace Porn\Provider;

class PornService extends AbstractService
{
    const URI = 'http://api.porn.com/';

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
            'cats'   => '',
            'page'   => 1,
            'tags'   => [],
            'thumbs' => 'large',
        ];

        $endpoint = $this->getEndpoint('videos/find.json', array_merge($defaults, $params));
        $response = $this->request($endpoint);
        $result = $this->decodeResponse($response);
        return $result['result'];
    }

    public function getVideoById($id, $thumbsize = 'medium')
    {
        $endpoint = $this->getEndpoint('video_by_id', [
            'video_id'  => $id,
            'thumbsize' => $thumbsize,
        ]);

        $response = $this->request($endpoint);
        $result = $this->decodeResponse($response);
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
        $result = $this->decodeResponse($response);
        return $result['result'];
    }

    public function getCategoriesList()
    {
        $endpoint = $this->getEndpoint('categories/find.json');
        $response = $this->request($endpoint);
        $result = $this->decodeResponse($response);
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
