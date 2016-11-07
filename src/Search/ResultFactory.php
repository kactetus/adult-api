<?php

namespace Adult\Search;

class ResultFactory
{

    const MSG_UKNOWN_Result = 'The Result [%s] is not found';

    protected $map = [
        'pornhub'   => 'Adult\Search\PornhubResult',
        'youporn'   => 'Adult\Search\YoupornResult',
        'porn'      => 'Adult\Search\PornResult',
        'redtube'   => 'Adult\Search\RedtubeResult',
        // 'spankwire' => 'Adult\Search\SpankwireResult',
        'tube8'     => 'Adult\Search\Tube8Result',
        'xtube'     => 'Adult\Search\XtubeResult',
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
