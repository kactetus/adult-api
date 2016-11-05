<?php

namespace Porn\Provider;

use GuzzleHttp\Client as Client;
use Porn\Provider\PornhubService as PornhubService;
use Porn\Provider\YoupornService as YoupornService;
use Porn\Provider\XtubeService as XtubeService;

class ServiceFactory
{
    const MSG_UKNOWN_SERVICE = 'The service [%s] is not found';

    protected $map = [
        'pornhub' => 'Porn\Provider\PornhubService',
        'youporn' => 'Porn\Provider\YoupornService',
        'xtube'   => 'Porn\Provider\XtubeService',
        'porn'    => 'Porn\Provider\PornService',
    ];

    public function factory($name)
    {
        $client = new Client;
        $class = $this->getServiceClass($name);
        return new $class($client);
    }

    protected function getServiceClass($name)
    {
        if (! array_key_exists($name, $this->map)) {
            throw new UnknownServiceException(sprintf(self::MSG_UKNOWN_SERVICE, $name));
        }
        return $this->map[$name];
    }
}
