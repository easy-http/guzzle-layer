<?php

namespace EasyHttp\GuzzleLayer;

use EasyHttp\LayerContracts\Contracts\HttpClientAdapter;
use EasyHttp\LayerContracts\Contracts\HttpClientRequest;
use EasyHttp\LayerContracts\Contracts\HttpClientResponse;
use EasyHttp\LayerContracts\Exceptions\HttpClientException;
use EasyHttp\LayerContracts\Exceptions\HttpConnectionException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
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
            $response = $this->client->request(
                $request->getMethod(),
                $request->getUri(),
                $this->buildOptions($request)
            );
        } catch (ConnectException $exception) {
            throw new HttpConnectionException($exception->getMessage(), (int) $exception->getCode(), $exception);
        } catch (RequestException $exception) {
            if (! $exception->hasResponse()) {
                throw new HttpClientException($exception->getMessage(), (int) $exception->getCode(), $exception);
            }

            $response = $exception->getResponse();
        } catch (TransferException $exception) {
            throw new HttpClientException($exception->getMessage(), (int) $exception->getCode(), $exception);
        }

        return new GuzzleResponse($response);
    }

    private function buildOptions(HttpClientRequest $request): array
    {
        $options = [
            'timeout' => $request->getTimeout(),
            'verify' => $request->isSSL()
        ];

        if ($request->hasHeaders()) {
            $options['headers'] = $request->getHeaders();
        }

        if ($request->hasJson()) {
            $options['json'] = $request->getJson();
        }

        if ($request->hasQuery()) {
            $options['query'] = $request->getQuery();
        }

        if ($request->hasSecurityContext() && $request->getSecurityContext()->hasCertificate()) {
            $options['cert'] = $request->getSecurityContext()->getCertificate();
        }

        if ($request->hasSecurityContext() && $request->getSecurityContext()->hasPrivateKey()) {
            $options['ssl_key'] = $request->getSecurityContext()->getPrivateKey();
        }

        if (count($request->getBasicAuth())) {
            $options['auth'] = $request->getBasicAuth();
        }

        return $options;
    }
}
