<?php

namespace Tests;

use EasyHttp\LayerContracts\Exceptions\HttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use EasyHttp\GuzzleLayer\GuzzleAdapter;
use EasyHttp\GuzzleLayer\GuzzleRequest;
use Tests\Mocks\PayPalApi;
use Tests\Mocks\RatesApi;
use Tests\Mocks\Responses\PayPalApiResponse;
use Tests\Mocks\Responses\RatesApiResponse;

class GuzzleAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function itCanSendAHttpRequestAndGetTheResponse()
    {
        $handler = HandlerStack::create(new RatesApi());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://api.ratesapi.io/api/2020-07-24/?base=USD', []);
        $adapter = new GuzzleAdapter($client);

        $response = $adapter->request($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(RatesApiResponse::usd(), $response->parseJson());
    }

    /**
     * @test
     */
    public function itThrowsTheHttpClientExceptionOnServerErrors()
    {
        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('Error Communicating with Server');

        $handler = new MockHandler(
            [
                new RequestException('Error Communicating with Server', new \GuzzleHttp\Psr7\Request('GET', 'test')),
            ]
        );
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://api.ratesapi.io/api/2020-07-24/?base=USD', []);
        $adapter = new GuzzleAdapter($client);
        $adapter->request($request);
    }

    /**
     * @test
     */
    public function itCanHandleBasicAuthentication()
    {
        $handler = HandlerStack::create(new PayPalApi());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://api.sandbox.paypal.com/v1/oauth2/token', []);
        $user    = 'AeA1QIZXiflr1_-r0U2UbWTziOWX1GRQer5jkUq4ZfWT5qwb6qQRPq7jDtv57TL4POEEezGLdutcxnkJ';
        $pass    = 'ECYYrrSHdKfk_Q0EdvzdGkzj58a66kKaUQ5dZAEv4HvvtDId2_DpSuYDB088BZxGuMji7G4OFUnPog6p';
        $request->setBasicAuth($user, $pass);
        $request->setQuery(['grant_type' => 'client_credentials']);
        $adapter = new GuzzleAdapter($client);

        $response = $adapter->request($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(PayPalApiResponse::token(), $response->parseJson());
    }
}
