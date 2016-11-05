<?php

namespace Porn\Provider;

class XtubeService extends AbstractService
{
    const URI = 'http://www.xtube.com/webmaster/api.php';

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
            'action' => 'getVideosBySearchParams',
        ];

        $endpoint = $this->getEndpoint(null, array_merge($defaults, $params));
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getVideoById($id, $thumbsize = 'medium')
    {
        $endpoint = $this->getEndpoint(null, [
            'action'    => 'getVideoById',
            'video_id'  => $id,
        ]);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getTagsList()
    {
        $endpoint = $this->getEndpoint(null, ['action' => 'getTagList']);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getCategoriesList()
    {
        $endpoint = $this->getEndpoint(null, ['action' => 'getCategoryList']);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }
}
