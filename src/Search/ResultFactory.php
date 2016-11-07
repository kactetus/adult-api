<?php

namespace Porn\Search;

use Porn\Result\PornhubResult as PornhubResult;
// use Porn\Result\YoupornResult as YoupornResult;
// use Porn\Result\XtubeResult as XtubeResult;
// use Porn\Result\PornResult as PornResult;
// use Porn\Result\RedtubeResult as RedtubeResult;
// use Porn\Result\SpankwireResult as SpankwireResult;
// use Porn\Result\Tube8Result as Tube8Result;

class ResultFactory
{

    const MSG_UKNOWN_Result = 'The Result [%s] is not found';

    protected $map = [
        'pornhub'   => 'Porn\Search\PornhubResult',
        'youporn'   => 'Porn\Search\YoupornResult',
        'porn'      => 'Porn\Search\PornResult',
        'redtube'   => 'Porn\Search\RedtubeResult',
        // 'spankwire' => 'Porn\Search\SpankwireResult',
        'tube8'     => 'Porn\Search\Tube8Result',
        'xtube'     => 'Porn\Search\XtubeResult',
    ];

    public function factory($name, $data = [])
    {
        $class = $this->getResultClass($name);
        return new $class($data);
    }

    protected function getResultClass($name)
    {
        if (! array_key_exists($name, $this->map)) {
            throw new UnknownResultException(sprintf(self::MSG_UKNOWN_Result, $name));
        }
        return $this->map[$name];
    }

    public function getSupportedResults()
    {
        return array_keys($this->map);
    }
}
