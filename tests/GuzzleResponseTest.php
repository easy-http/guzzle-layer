<?php

namespace Tests;

use EasyHttp\GuzzleLayer\GuzzleAdapter;
use EasyHttp\GuzzleLayer\GuzzleRequest;
use EasyHttp\LayerContracts\Exceptions\ImpossibleToParseJsonException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\HttpInfo;
use Tests\Mocks\RatesApi;

class GuzzleResponseTest extends TestCase
{
    /**
     * @test
     */
    public function itGetsTheBody()
    {
        $handler = HandlerStack::create(new RatesApi());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://http-info-api.com/some-end-point');
        $adapter = new GuzzleAdapter($client);

        $response = $adapter->request($request);

        $this->assertNotEmpty($response->getBody());
        $this->assertSame('Not found', $response->getBody());
    }

    /**
     * @test
     */
    public function itGetsHeaders()
    {
        $handler = HandlerStack::create(new RatesApi());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://http-info-api.com/some-end-point');
        $adapter = new GuzzleAdapter($client);

        $response = $adapter->request($request);

        $this->assertSame(
            [
                'Server' => 'Apache/2.4.41 (Ubuntu)',
                'Cache-Control' => 'no-cache, private',
                'Content-Type' => 'application/json'
            ],
            $response->getHeaders()
        );
    }

    /**
     * @test
     */
    public function itCanHandlesMultipleCookieHeaders()
    {
        $handler = HandlerStack::create(new HttpInfo());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://http-info-api.com/some-end-point');
        $request->setServerCookies(
            [
            'cookie1=value1',
            'cookie2=value2'
            ]
        );
        $adapter = new GuzzleAdapter($client);

        $response = $adapter->request($request)->parseJson();

        $this->assertSame(
            [
                'cookie1=value1',
                'cookie2=value2',
            ],
            $response['headers']['Set-Cookie']
        );
    }

    /**
     * @test
     */
    public function itThrowsTheNotParsedExceptionOnInvalidJsonString()
    {
        $this->expectException(ImpossibleToParseJsonException::class);

        $mock = new RatesApi();
        $mock->withResponse(200, 'some string');
        $handler = HandlerStack::create($mock);
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://api.ratesapi.io/api/2020-07-24/?base=USD');
        $adapter = new GuzzleAdapter($client);

        $adapter->request($request)->parseJson();
    }
}
