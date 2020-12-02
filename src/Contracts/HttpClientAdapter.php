<?php

namespace EasyHttp\GuzzleLayer\Contracts;

interface HttpClientAdapter
{
    public function request(HttpClientRequest $request): HttpClientResponse;
}
