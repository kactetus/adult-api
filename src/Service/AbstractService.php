<?php

namespace Service;

use GuzzleHttp\Client as Client;
use GuzzleHttp\Psr7\Response as Response;

abstract class AbstractService
{
    const URI = '';
    
    protected $client;

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }

    protected function request($url)
    {
        return $this->getClient()->get($url);
    }

    protected function getEndpoint($url, $params = [])
    {
        $self = get_called_class();
        return $self::URI . $url . '?' . http_build_query($params);
    }

    protected function decodeResponse(Response $response)
    {
        $json = (string)$response->getBody();
        return json_decode($json, true);
    }
}
