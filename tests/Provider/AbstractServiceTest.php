<?php

namespace Tests\Provider;

use Adult\Test\TestCase as TestCase;
use Adult\Provider\AbstractService as AbstractService;
use GuzzleHttp\Client as Client;

class AbstractServiceTest extends TestCase
{
    public function testSetClient()
    {
        $client = new Client;
        $sut = $this->getMockForAbstractClass(AbstractService::class, [$client]);
        $result = $sut->setClient($client);
        $this->assertEquals($sut, $result);
    }

    public function testGetClient()
    {
        $client = new Client;
        $sut = $this->getMockForAbstractClass(AbstractService::class, [$client]);
        $result = $sut->getClient($client);
        $this->assertEquals($client, $result);
    }

    public function testRequest()
    {
        $expected = 'expected';
        $url      = 'some url value';
        $client   = $this->getMockedClass('\GuzzleHttp\Client', ['get']);
        $sut      = $this->getMockedAbstractClass(AbstractService::class, ['getClient']);

        $client->expects($this->once())
            ->method('get')
            ->with($this->equalTo($url))
            ->will($this->returnValue($expected));

        $sut->expects($this->once())
            ->method('getClient')
            ->will($this->returnValue($client));

        $result = $this->getMethod(AbstractService::class, 'request')->invoke($sut, $url);
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider provideGetEndpoint
     */
    public function testGetEndpoint($expected, $url, $params = [])
    {
        $sut = $this->getMockForAbstractClass(AbstractService::class, [new Client]);
        $result = $this->getMethod(AbstractService::class, 'getEndpoint')->invoke($sut, $url, $params);
        $this->assertEquals($expected, $result);
    }

    public function provideGetEndpoint()
    {
        return [
            'simple test' => [
                'expected' => '?',
                'url'      => '',
                'params'   => [],
            ],

            'params test' => [
                'expected' => '?key=value',
                'url'      => '',
                'params'   => [
                    'key' => 'value',
                ],
            ],

            'params and url test' => [
                'expected' => 'some/path?key=value',
                'url'      => 'some/path',
                'params'   => [
                    'key' => 'value',
                ],
            ],

        ];
    }

    public function testDecodeResponse()
    {
        $expected = ['key' => 'value'];
        $body     = (object)['key' => 'value'];
        $response = $this->getMockedClass('\GuzzleHttp\Psr7\Response', ['getBody']);
        $sut      = $this->getMockForAbstractClass(AbstractService::class, [new Client]);

        $response->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue(json_encode($body)));

        $result = $this->getMethod(AbstractService::class, 'decodeResponse')->invoke($sut, $response);
        $this->assertEquals($expected, $result);
    }


}
