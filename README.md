<p align="center"><img src="https://blog.pleets.org/img/articles/easy-http-logo-320.png"></p>

<p align="center">
<a href="https://travis-ci.com/easy-http/guzzle-layer"><img src="https://travis-ci.com/easy-http/guzzle-layer.svg?branch=master" alt="Build Status"></a>
<a href="https://scrutinizer-ci.com/g/easy-http/guzzle-layer"><img src="https://img.shields.io/scrutinizer/g/easy-http/guzzle-layer.svg" alt="Code Quality"></a>
<a href="https://scrutinizer-ci.com/g/easy-http/guzzle-layer/?branch=master"><img src="https://scrutinizer-ci.com/g/easy-http/guzzle-layer/badges/coverage.png?b=master" alt="Code Coverage"></a>
</p>
<p align="center">
  <a href="https://stand-with-ukraine.pp.ua" title="#StandWithUkraine"><img alt="#StandWithUkraine" src="https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg"></a>
</p>
<p align="center">
    <a href="#tada-php-support" title="PHP Versions Supported"><img alt="PHP Versions Supported" src="https://img.shields.io/badge/php-7.4%20to%208.2-777bb3.svg?logo=php&logoColor=white&labelColor=555555"></a>
</p>

# Guzzle Layer

This is an HTTP layer for Guzzle Client based on [Http layer contracts](https://github.com/easy-http/layer-contracts).
This contracts standardize the way you consume http clients like Guzzle, Symfony, and others. No matter what client you are using, the methods you have to execute to do the job are the same for all!!.
For more layers see [Easy Http](https://github.com/easy-http).

<a href="https://sonarcloud.io/dashboard?id=easy-http_guzzle-layer"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_guzzle-layer&metric=security_rating" alt="Bugs"></a>
<a href="https://sonarcloud.io/dashboard?id=easy-http_guzzle-layer"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_guzzle-layer&metric=bugs" alt="Bugs"></a>
<a href="https://sonarcloud.io/dashboard?id=easy-http_guzzle-layer"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_guzzle-layer&metric=code_smells" alt="Bugs"></a>

This library supports the following versions of Guzzle Http Client.

<a href="#tada-php-support" title="PHP Versions Supported"><img alt="PHP Versions Supported" src="https://img.shields.io/badge/guzzle-6.x-blue"></a>
<a href="#tada-php-support" title="PHP Versions Supported"><img alt="PHP Versions Supported" src="https://img.shields.io/badge/guzzle-7.x-blue"></a>

# Installation

Use following command to install this library:

```bash
composer require easy-http/guzzle-layer
```

# Usage

## Simple requests

You can execute a simple request as follows. 

```php
use EasyHttp\GuzzleLayer\GuzzleClient;

$client = new GuzzleClient();
$response = $client->call('GET', 'https://api.ratesapi.io/api/2020-07-24/?base=USD');

$response->getStatusCode(); // 200
$response->parseJson();     // array
```

## Prepared requests

A prepared request is a more flexible way to generate a request. You can use the `setQuery` method
to specify request query.

```php
use EasyHttp\GuzzleLayer\GuzzleClient;

$client = new GuzzleClient();

$client->prepareRequest('POST', 'https://api.ratesapi.io/api/2020-07-24/');
$client->getRequest()->setQuery(['base' => 'USD']);
$response = $client->execute();

$response->getStatusCode(); // 200
$response->parseJson();     // array
```

Also, you can use the `setJson` method to set a json string as the body.

```php
use EasyHttp\GuzzleLayer\GuzzleClient;

$client = new GuzzleClient();

$client->prepareRequest('POST', 'https://jsonplaceholder.typicode.com/posts');
$client->getRequest()->setJson([
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1,
]);
$response = $client->execute();

$response->getStatusCode(); // 201
$response->parseJson();     // array
```

## HTTP Authentication

Actually this library supports basic authentication natively.

```php
use EasyHttp\GuzzleLayer\GuzzleClient;

$client = new GuzzleClient();

$client->prepareRequest('POST', 'https://api.sandbox.example.com/v1/oauth2/token');
$user = 'username';
$pass = 'password';
$client->getRequest()->setBasicAuth($user, $pass);
$client->getRequest()->setQuery(['grant_type' => 'client_credentials']);
$response = $client->execute();

$response->getStatusCode(); // 200
$response->parseJson();     // array
```
