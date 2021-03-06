<?php

namespace Tests;

use EasyHttp\LayerContracts\Exceptions\HttpClientException;
use EasyHttp\LayerContracts\Exceptions\ImpossibleToParseJsonException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use EasyHttp\GuzzleLayer\GuzzleClient;
use Tests\Mocks\PayPalApi;
use Tests\Mocks\RatesApi;
use Tests\Mocks\Responses\PayPalApiResponse;
use Tests\Mocks\Responses\RatesApiResponse;
use Tests\Mocks\Responses\SearchTweetsResponse;
use Tests\Mocks\TwitterApi;

class GuzzleClientTest extends TestCase
{
    protected $uri = 'https://api.ratesapi.io/api/2020-07-24/?base=USD';
    
    /**
     * @test
     */
    public function itCanSendAHttpRequestAndGetTheResponse()
    {
        $client = new GuzzleClient();
        $client->withHandler(new RatesApi());

        $response = $client->call('POST', $this->uri);

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

        $client = new GuzzleClient();
        $client->withHandler(
            new MockHandler(
                [
                    new RequestException(
                        'Error Communicating with Server',
                        new \GuzzleHttp\Psr7\Request('GET', 'test')
                    ),
                ]
            )
        );

        $client->call('POST', $this->uri);
    }

    /**
     * @test
     */
    public function itThrowsTheNotParsedExceptionOnInvalidJsonString()
    {
        $this->expectException(ImpossibleToParseJsonException::class);

        $mock = new RatesApi();
        $mock->withResponse(200, 'some string');

        $client = new GuzzleClient();
        $client->withHandler($mock);

        $client->call('POST', $this->uri)->parseJson();
    }

    /**
     * @test
     */
    public function itCanSetHeadersOnRequests()
    {
        $client = new GuzzleClient();
        $client->withHandler(new TwitterApi());

        $client->prepareRequest(
            'GET',
            'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=darioriverat&count=7'
        );
        $token = 'tGzv3JOkF0XG5Qx2TlKWIA';
        $client->getRequest()->setHeader('Authorization', 'Bearer ' . $token);
        $response = $client->execute();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(SearchTweetsResponse::tweets(), $response->parseJson());
    }

    /**
     * @test
     */
    public function itCanHandleBasicAuthentication()
    {
        $client = new GuzzleClient();
        $client->withHandler(new PayPalApi());

        $client->prepareRequest('POST', 'https://api.sandbox.paypal.com/v1/oauth2/token');
        $user = 'AeA1QIZXiflr1_-r0U2UbWTziOWX1GRQer5jkUq4ZfWT5qwb6qQRPq7jDtv57TL4POEEezGLdutcxnkJ';
        $pass = 'ECYYrrSHdKfk_Q0EdvzdGkzj58a66kKaUQ5dZAEv4HvvtDId2_DpSuYDB088BZxGuMji7G4OFUnPog6p';
        $client->getRequest()->setBasicAuth($user, $pass);
        $client->getRequest()->setQuery(['grant_type' => 'client_credentials']);
        $response = $client->execute();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(PayPalApiResponse::token(), $response->parseJson());
    }
}
