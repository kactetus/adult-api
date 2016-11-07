<?php

namespace Porn\Provider;

use Porn\Search\ResultFactory as ResultFactory;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Psr7\Response as Response;

abstract class AbstractService
{
    const URI = '';

    protected $client;
    protected $factory;

    public function __construct(Client $client, ResultFactory $factory)
    {
        $this->setClient($client);
        $this->setResultFactory($factory);
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

    public function setResultFactory(ResultFactory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    public function getResultFactory()
    {
        return $this->factory;
    }

    public function request($url)
    {
        return $this->getClient()->get($url);
    }

    public function requestAsync($url)
    {
        return $this->getClient()->requestAsync('GET', $url);
    }

    protected function getEndpoint($url, $params = [])
    {
        $self = get_called_class();
        return $self::URI . $url . '?' . http_build_query($params);
    }

    public function decodeResponse(Response $response)
    {
        $json = (string)$response->getBody();
        return json_decode($json, true);
    }

    protected function getTransformedResultData($type, $data = [])
    {
        $results = [];
        $factory = $this->getResultFactory();
        foreach ($data as $record) {
            $results[] = $factory->factory($type, $record);
        }
        return $results;
    }
}
