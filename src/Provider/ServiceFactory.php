<?php

namespace Porn\Provider;

use GuzzleHttp\Client as Client;
use Porn\Provider\PornhubService as PornhubService;
use Porn\Provider\YoupornService as YoupornService;
use Porn\Provider\XtubeService as XtubeService;
use Porn\Provider\PornService as PornService;
use Porn\Provider\RedtubeService as RedtubeService;
use Porn\Provider\SpankwireService as SpankwireService;
use Porn\Provider\Tube8Service as Tube8Service;
use Porn\Search\ResultFactory as ResultFactory;

class ServiceFactory
{
    const MSG_UKNOWN_SERVICE = 'The service [%s] is not found';

    protected $map = [
        'pornhub'   => 'Porn\Provider\PornhubService',
        'youporn'   => 'Porn\Provider\YoupornService',
        // 'xtube'     => 'Porn\Provider\XtubeService',
        'porn'      => 'Porn\Provider\PornService',
        'redtube'   => 'Porn\Provider\RedtubeService',
        // 'spankwire' => 'Porn\Provider\SpankwireService',
        'tube8'     => 'Porn\Provider\Tube8Service',
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
