<?php

namespace Tests;

use EasyHttp\GuzzleLayer\GuzzleAdapter;
use EasyHttp\GuzzleLayer\GuzzleRequest;
use EasyHttp\LayerContracts\Common\SecurityContext;
use EasyHttp\LayerContracts\Exceptions\HttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Tests\Mocks\CertificateApi;

class GuzzleAdapterCertificateAuthenticationTest extends TestCase
{
    /**
     * @test
     */
    public function itCanHandleSSLAuthentication()
    {
        $handler = HandlerStack::create(new CertificateApi());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://example/api/authenticate');
        $security = new SecurityContext();
        $security->setCertificate('tests/stubs/cert.pem');
        $security->setPrivateKey('tests/stubs/privateKey.pem');
        $request->setSecurityContext($security);

        $request->setJson(
            [
                'bar' => 'baz',
            ]
        );

        $adapter = new GuzzleAdapter($client);

        $response = $adapter->request($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['foo' => 'bar'], $response->parseJson());
    }

    /**
     * @test
     */
    public function itThrowsTheHttpClientExceptionWhenCertificateIsMissing()
    {
        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessageMatches('/alert certificate required/');

        $handler = HandlerStack::create(new CertificateApi());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://example/api/authenticate');
        $adapter = new GuzzleAdapter($client);
        $adapter->request($request);
    }

    /**
     * @test
     */
    public function itThrowsTheHttpClientExceptionWhenPrivateKeyIsMissing()
    {
        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessageMatches('/unable to set private key file/');

        $handler = HandlerStack::create(new CertificateApi());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://example/api/authenticate');
        $security = new SecurityContext();
        $security->setCertificate('tests/stubs/cert.pem');
        $request->setSecurityContext($security);

        $adapter = new GuzzleAdapter($client);
        $adapter->request($request);
    }
}
