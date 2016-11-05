<?php
namespace Service;

use Service\AbstractService as AbstractService;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Psr7\Response as Response;

class Pornhub extends AbstractService
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

$service = new Pornhub(new Client);
print_r(
    // $service->search([
    //     'search' => 'cuckold'
    // ]),
    $service->getStarList()
);

// searchVideos
// getVideoById
// getVideoEmbedCode
// getDeletedVideos
// isVideoActive
// getCategoriesList
// getTagsList
// getStarList
// getStarDetailedList
// Global error messages
// 1001:No such method.
// 1002:No such data provider.
// 1003:No input parameters specified.
// Video methods error messages
// 2001:No videos found.
// 2002:No video with this ID.
// Additional methods error messages
// 3001:No categories found.
// 3002:No tags found.
// 3003:No stars found.
