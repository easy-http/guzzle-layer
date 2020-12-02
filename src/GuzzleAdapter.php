<?php

namespace EasyHttp\GuzzleLayer;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use EasyHttp\GuzzleLayer\Contracts\HttpClientAdapter;
use EasyHttp\GuzzleLayer\Contracts\HttpClientRequest;
use EasyHttp\GuzzleLayer\Contracts\HttpClientResponse;
use EasyHttp\GuzzleLayer\Exceptions\HttpClientException;

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
