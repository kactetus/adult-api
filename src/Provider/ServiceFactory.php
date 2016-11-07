<?php

namespace Adult\Provider;

use GuzzleHttp\Client as Client;
use Adult\Provider\PornhubService as PornhubService;
use Adult\Provider\YoupornService as YoupornService;
use Adult\Provider\XtubeService as XtubeService;
use Adult\Provider\PornService as PornService;
use Adult\Provider\RedtubeService as RedtubeService;
use Adult\Provider\SpankwireService as SpankwireService;
use Adult\Provider\Tube8Service as Tube8Service;
use Adult\Search\ResultFactory as ResultFactory;

class ServiceFactory
{
    const MSG_UKNOWN_SERVICE = 'The service [%s] is not found';

    protected $map = [
        'pornhub'   => 'Adult\Provider\PornhubService',
        'youporn'   => 'Adult\Provider\YoupornService',
        // 'xtube'     => 'Adult\Provider\XtubeService',
        'porn'      => 'Adult\Provider\PornService',
        'redtube'   => 'Adult\Provider\RedtubeService',
        // 'spankwire' => 'Adult\Provider\SpankwireService',
        'tube8'     => 'Adult\Provider\Tube8Service',
    ];

    public function factory($name)
    {
        $client = new Client;
        $resultFactory = new ResultFactory;
        $class = $this->getServiceClass($name);
        return new $class($client, $resultFactory);
    }

    protected function getServiceClass($name)
    {
        if (! array_key_exists($name, $this->map)) {
            throw new UnknownServiceException(sprintf(self::MSG_UKNOWN_SERVICE, $name));
        }
        return $this->map[$name];
    }

    public function getSupportedServices()
    {
        return array_keys($this->map);
    }
}
