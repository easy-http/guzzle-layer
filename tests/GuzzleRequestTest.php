<?php

namespace Tests;

use EasyHttp\GuzzleLayer\GuzzleAdapter;
use EasyHttp\GuzzleLayer\GuzzleRequest;
use EasyHttp\LayerContracts\Contracts\HttpClientAdapter;
use EasyHttp\LayerContracts\Contracts\HttpClientRequest;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class GuzzleRequestTest extends RequestTest
{
    protected function createRequest(string $method, string $uri): HttpClientRequest
    {
        return new GuzzleRequest($method, $uri, []);
    }

    protected function buildAdapter(): HttpClientAdapter
    {
        $handler = HandlerStack::create($this->mock);
        $client  = new Client(['handler' => $handler]);

        return new GuzzleAdapter($client);
    }
}