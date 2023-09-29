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

        $this
            ->setHeaders($request, $options)
            ->setJson($request, $options)
            ->setQuery($request, $options)
            ->setUrlEncodedData($request, $options)
            ->setSecurityContext($request, $options)
            ->setBasicAuth($request, $options);

        return $options;
    }

    private function setHeaders(HttpClientRequest $request, &$options): self
    {
        $headers = [];

        if ($request->hasHeaders()) {
            $headers = $request->getHeaders();
        }

        if ($request->hasServerCookies()) {
            $headers['Set-Cookie'] = $request->getServerCookies();
        }

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        return $this;
    }

    private function setJson(HttpClientRequest $request, &$options): self
    {
        if ($request->hasJson()) {
            $options['json'] = $request->getJson();
        }

        return $this;
    }

    private function setQuery(HttpClientRequest $request, &$options): self
    {
        if ($request->hasQuery()) {
            $options['query'] = $request->getQuery();
        }

        return $this;
    }

    private function setSecurityContext(HttpClientRequest $request, &$options): self
    {
        if ($request->hasSecurityContext() && $request->getSecurityContext()->hasCertificate()) {
            $options['cert'] = $request->getSecurityContext()->getCertificate();
        }

        if ($request->hasSecurityContext() && $request->getSecurityContext()->hasPrivateKey()) {
            $options['ssl_key'] = $request->getSecurityContext()->getPrivateKey();
        }

        return $this;
    }

    private function setBasicAuth(HttpClientRequest $request, &$options): self
    {
        if (count($request->getBasicAuth())) {
            $options['auth'] = $request->getBasicAuth();
        }

        return $this;
    }

    private function setUrlEncodedData(HttpClientRequest $request, array &$options): self
    {
        if ($request->hasUrlEncodedData()) {
            $options['form_params'] = $request->getUrlEncodedData();
        }

        return $this;
    }
}
