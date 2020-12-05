<?php

namespace EasyHttp\GuzzleLayer;

use EasyHttp\LayerContracts\Contracts\HttpClientAdapter;
use EasyHttp\LayerContracts\Contracts\HttpClientRequest;
use EasyHttp\LayerContracts\Contracts\HttpClientResponse;
use EasyHttp\LayerContracts\Exceptions\HttpClientException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;

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
