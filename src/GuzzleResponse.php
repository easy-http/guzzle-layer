<?php

namespace EasyHttp\GuzzleLayer;

use EasyHttp\LayerContracts\Contracts\HttpClientResponse;
use EasyHttp\LayerContracts\Exceptions\ImpossibleToParseJsonException;
use Psr\Http\Message\ResponseInterface;

class GuzzleResponse implements HttpClientResponse
{
    protected ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    public function getBody(): string
    {
        return $this->toString();
    }

    public function parseJson(): array
    {
        $response = $this->toString();
        $data     = json_decode($response, true);

        if (! $data) {
            throw new ImpossibleToParseJsonException(
                'Service response could not be parsed to JSON, Response: ' .
                $response . ', Reason: ' . json_last_error()
            );
        }

        return $data;
    }

    private function toString(): string
    {
        $stream = $this->response->getBody();
        $stream->rewind();

        return $stream->getContents();
    }
}
