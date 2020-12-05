<?php

namespace EasyHttp\GuzzleLayer;

use EasyHttp\GuzzleLayer\Factories\ClientFactory;;
use EasyHttp\LayerContracts\AbstractClient;
use EasyHttp\LayerContracts\Contracts\HttpClientAdapter;
use EasyHttp\LayerContracts\Contracts\HttpClientRequest;

class GuzzleClient extends AbstractClient
{
    protected function buildRequest(string $method, string $uri): HttpClientRequest
    {
        return new GuzzleRequest($method, $uri);
    }

    protected function buildAdapter(): HttpClientAdapter
    {
        return new GuzzleAdapter(ClientFactory::build($this->handler));
    }
}
