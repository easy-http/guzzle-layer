<p align="center"><img src="https://blog.pleets.org/img/articles/easy-http-logo.png" height="150"></p>

<p align="center">
<a href="https://travis-ci.org/easy-http/guzzle-layer"><img src="https://travis-ci.org/easy-http/guzzle-layer.svg?branch=master" alt="Build Status"></a>
<a href="https://scrutinizer-ci.com/g/easy-http/guzzle-layer"><img src="https://img.shields.io/scrutinizer/g/easy-http/guzzle-layer.svg" alt="Code Quality"></a>
<a href="https://sonarcloud.io/dashboard?id=easy-http_guzzle-layer"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_guzzle-layer&metric=security_rating" alt="Bugs"></a>
<a href="https://scrutinizer-ci.com/g/easy-http/guzzle-layer/?branch=master"><img src="https://scrutinizer-ci.com/g/easy-http/guzzle-layer/badges/coverage.png?b=master" alt="Code Coverage"></a>
</p>

# Guzzle Layer

This is an HTTP layer for Guzzle Client. For more layers see [Easy Http](https://github.com/easy-http).

This library supports the following versions of Guzzle Http Client.

- Guzzle v7.0

# Installation

Use following command to install this library:

```bash
composer require easy-http/guzzle-layer
```

# Usage

## Simple requests

You can execute a simple request through the Standard class. 

```php
use EasyHttp\GuzzleLayer\GuzzleClient;

$client = new GuzzleClient();
$response = $client->request('GET', 'https://api.ratesapi.io/api/2020-07-24/?base=USD');

$response->getStatusCode(); // 200
$response->response();      // JSON
```

## Prepared requests

A prepared request is a more flexible way to generate requests through any client.

```php
use EasyHttp\GuzzleLayer\GuzzleClient;

$client = new GuzzleClient();

$client->prepareRequest('POST', 'https://jsonplaceholder.typicode.com/posts');
$client->setJson([
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1,
]);
$response = $client->execute();

$response->getStatusCode(); // 201
$response->response();      // JSON
```

## HTTP Authentication

Actually this library supports basic authentication natively.

```php
use EasyHttp\GuzzleLayer\GuzzleClient;

$client = new GuzzleClient();

$client->prepareRequest('POST', 'https://api.sandbox.paypal.com/v1/oauth2/token');
$user = 'AeA1QIZXiflr1_-r0U2UbWTziOWX1GRQer5jkUq4ZfWT5qwb6qQRPq7jDtv57TL4POEEezGLdutcxnkJ';
$pass = 'ECYYrrSHdKfk_Q0EdvzdGkzj58a66kKaUQ5dZAEv4HvvtDId2_DpSuYDB088BZxGuMji7G4OFUnPog6p';
$client->setBasicAuth($user, $pass);
$client->setQuery(['grant_type' => 'client_credentials']);
$response = $client->execute();

$response->getStatusCode(); // 200
$response->response();      // JSON
```