<?php

namespace EasyHttp\GuzzleLayer\Contracts;

interface HttpClientResponse
{
    public function getStatusCode(): int;
    public function getHeaders(): array;
    public function response(): array;
}
