<?php

namespace Adult\Aggregator;

use Adult\Provider\ServiceFactory as ServiceFactory;
use GuzzleHttp\Promise;

class SearchReactor
{
    protected $factory;

    public function __construct(ServiceFactory $factory)
    {
        $this->setFactory($factory);
    }

    public function setFactory(ServiceFactory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    public function getFactory()
    {
        return $this->factory;
    }

    public function search($term, $params = [])
    {
        $promises = [];
        $services = $this->getServices();

        foreach ($services as $service) {
            $endpoint   = $service->getSearchEndpoint($term, $params);
            $promises[] = $service->requestAsync($endpoint);
        }

        return $this->handleAsyncResponses($promises, $services);
    }

    public function handleAsyncResponses($promises, $services)
    {
        return \GuzzleHttp\Promise\all($promises)->then(function (array $responses) use ($services){
            $results = [];
            foreach ($responses as $index => $response) {
                $results[] = $services[$index]->handleSearchResponse($response);
            }
            return $results;
        })->wait();
    }

    public function getServices()
    {
        $services = [];
        $factory  = $this->getFactory();
        $types    = $factory->getSupportedServices();
        foreach ($types as $type) {
            $services[] = $factory->factory($type);
        }
        return $services;

    }

}
