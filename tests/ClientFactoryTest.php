<?php

namespace Tests;

use EasyHttp\GuzzleLayer\Factories\ClientFactory;
use GuzzleHttp\Client;

class ClientFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function itCreatesAnInstanceOfGuzzleClient(): void
    {
        $client = ClientFactory::build();

        $this->assertInstanceOf(Client::class, $client);
    }
}
