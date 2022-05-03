<?php

namespace Tests\Mocks;

use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class BaseMock
{
    protected function response($code, $body, $headers = [], $reason = null): PromiseInterface
    {
        $headers = array_replace(
            [
                'Server' => 'Apache/2.4.41 (Ubuntu)',
                'Cache-Control' => 'no-cache, private'
            ],
            $headers
        );

        return new FulfilledPromise(
            new Response($code, $headers, utf8_decode($body), '1.1', !is_null($reason) ? utf8_decode($reason) : null)
        );
    }

    protected function jsonResponse($code, $body, $headers = [], $reason = null): PromiseInterface
    {
        if (is_array($body)) {
            $body = json_encode($body);
        }

        $headers = array_replace(
            ['Content-Type' => 'application/json'],
            $headers
        );

        return $this->response($code, $body, $headers, $reason);
    }
}
