<?php

namespace Tests\Mocks;

use Psr\Http\Message\RequestInterface;

class HttpInfo extends BaseMock
{
    public function __invoke(RequestInterface $request)
    {
        return $this->response(
            200,
            [
                'method' => $request->getMethod(),
                'body' => $request->getBody()->getContents(),
                'uri' =>
                    $request->getUri()->getScheme() . '://' .
                    $request->getUri()->getHost() .
                    $request->getUri()->getPath(),
                'uriFragment' => [
                    'schema' => $request->getUri()->getScheme(),
                    'port' => $request->getUri()->getPort(),
                    'host' => $request->getUri()->getHost(),
                    'path' => $request->getUri()->getPath(),
                    'query' => $request->getUri()->getQuery(),
                ],
                'headers' => $this->parseHeaders($request->getHeaders()),
            ]
        );
    }

    protected function parseHeaders(array $headers): array
    {
        $_headers = [];

        foreach ($headers as $key => $value) {
            $_headers[$key] = array_shift($value);
        }

        return $_headers;
    }
}
