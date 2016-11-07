<?php

namespace Porn\Provider;

class RedtubeService extends AbstractService
{
    const URI = 'http://api.redtube.com/';
    const TYPE = 'redtube';

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
            'stars'     => '',
            'tags'      => [],
            'thumbsize' => 'large',
            'output'    => 'json',
            'data'      => 'redtube.Videos.searchVideos',
        ];

        return $this->getEndpoint(null, array_merge($defaults, $params));
    }

    public function getVideoById($id, $thumbsize = 'medium')
    {
        $endpoint = $this->getEndpoint(null, [
            'data'      => 'redtube.Videos.getVideoById',
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
            'data'   => 'redtube.Tags.getTagList',
            'output' => 'json',
        ]);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }

    public function getCategoriesList()
    {
        $endpoint = $this->getEndpoint(null, [
            'data'   => 'redtube.Categories.getCategoriesList',
            'output' => 'json',
        ]);
        $response = $this->request($endpoint);
        return $this->decodeResponse($response);
    }
}
