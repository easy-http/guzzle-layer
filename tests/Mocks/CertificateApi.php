<?php

namespace Tests\Mocks;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Tests\Helpers\OpenSSLHelper;

class CertificateApi extends BaseMock
{
    public function __invoke(RequestInterface $request, array $options = []): PromiseInterface
    {
        if (!isset($options['cert'])) {
            throw new RequestException(
                $this->certificateRequiredMessage($request),
                $request,
            );
        }

        if (!file_exists($options['cert'])) {
            throw new InvalidArgumentException('SSL certificate not found: ' . $options['cert']);
        }

        if (!isset($options['ssl_key'])) {
            throw new RequestException(
                $this->unableToSetPrivateKeyMessage($request, $options['cert']),
                $request,
            );
        }

        if (!file_exists($options['ssl_key'])) {
            throw new InvalidArgumentException('SSL private key not found: ' . $options['ssl_key']);
        }

        if (!$this->match($options['cert'], $options['ssl_key'])) {
            throw new RequestException(
                $this->unableToSetPrivateKeyMessage($request, $options['cert']),
                $request,
            );
        }

        return $this->jsonResponse(
            200,
            [
                'foo' => 'bar'
            ]
        );
    }

    private function certificateRequiredMessage(RequestInterface $request): string
    {
        $url = $request->getUri()->getScheme() . '://' . $request->getUri()->getHost() . $request->getUri()->getPath();

        return 'cURL error 56: OpenSSL SSL_read: error:1409445C:SSL routines:ssl3_read_bytes:tlsv13 alert certificate required, errno 0 (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for ' . $url; // phpcs:ignore
    }

    private function unableToSetPrivateKeyMessage(RequestInterface $request, string $path): string
    {
        $url = $request->getUri()->getScheme() . '://' . $request->getUri()->getHost() . $request->getUri()->getPath();

        return "cURL error 58: unable to set private key file: '$path' type PEM (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for " . $url; // phpcs:ignore
    }

    private function match(string $certificate, string $privateKey): bool
    {
        return OpenSSLHelper::checkPrivateKeyAndCertificateMatching($privateKey, $certificate);
    }
}
