<?php

namespace Tests;

use EasyHttp\GuzzleLayer\GuzzleAdapter;
use EasyHttp\GuzzleLayer\GuzzleRequest;
use EasyHttp\LayerContracts\Common\SecurityContext;
use EasyHttp\LayerContracts\Exceptions\HttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Tests\Mocks\CertificateApi;

class GuzzleAdapterSSLVerificationTest extends TestCase
{
    /**
     * @test
     */
    public function itThrowsTheHttpClientExceptionForSSLValidationWithSelfSigningCertificates()
    {
        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessageMatches('/self signed certificate in certificate chain/');

        $handler = HandlerStack::create(new CertificateApi());
        $client  = new Client(['handler' => $handler]);

        $request = new GuzzleRequest('POST', 'https://example.com/api/authenticate');
        $security = new SecurityContext();
        $security->setCertificate('tests/stubs/cert.pem');
        $security->setPrivateKey('tests/stubs/privateKey.pem');
        $request->setSecurityContext($security);
        $request->ssl(true);

        $request->setJson(
            [
                'bar' => 'baz',
            ]
        );

        $adapter = new GuzzleAdapter($client);
        $adapter->request($request);
    }
}
