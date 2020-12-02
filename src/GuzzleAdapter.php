<?php

namespace Pleets\HttpClient;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use Pleets\HttpClient\GuzzleResponse;
use Pleets\HttpClient\Contracts\HttpClientAdapter;
use Pleets\HttpClient\Contracts\HttpClientRequest;
use Pleets\HttpClient\Contracts\HttpClientResponse;
use Pleets\HttpClient\Exceptions\HttpClientException;

class GuzzleAdapter implements HttpClientAdapter
{
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function request(HttpClientRequest $request): HttpClientResponse
    {
        try {
            $response = $this->client->request($request->getMethod(), $request->getUri(), $request->options());
        } catch (RequestException $exception) {
            if (! $exception->hasResponse()) {
                throw HttpClientException::fromThrowable($exception);
            }

            $response = $exception->getResponse();
        } catch (TransferException $exception) {
            throw HttpClientException::fromThrowable($exception);
        }

        return new GuzzleResponse($response);
    }
}
