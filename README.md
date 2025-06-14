<p align="center"><img src="https://blog.pleets.org/img/articles/easy-http-logo-320.png"></p>

<p align="center">
<a href="https://github.com/easy-http/guzzle-layer/actions/workflows/tests.yml"><img src="https://github.com/easy-http/guzzle-layer/actions/workflows/tests.yml/badge.svg?branch=1.x" alt="Build Status"></a>
<a href="https://scrutinizer-ci.com/g/easy-http/guzzle-layer"><img src="https://img.shields.io/scrutinizer/g/easy-http/guzzle-layer.svg" alt="Code Quality"></a>
<a href="https://scrutinizer-ci.com/g/easy-http/guzzle-layer/?branch=master"><img src="https://scrutinizer-ci.com/g/easy-http/guzzle-layer/badges/coverage.png?b=master" alt="Code Coverage"></a>
</p>
<p align="center">
    <a href="#tada-php-support" title="PHP Versions Supported"><img alt="PHP Versions Supported" src="https://img.shields.io/badge/php-7.4%20to%208.3-777bb3.svg?logo=php&logoColor=white&labelColor=555555"></a>
</p>

<p align="center">
    :bookmark: Consistent interface for http clients
</p>

<p align="center">
    :rocket: Change easily from one client to another using http layer contracts
</p>

# Guzzle Layer

<a href="https://sonarcloud.io/component_measures?metric=security_rating&branch=1.x&id=easy-http_guzzle-layer"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_guzzle-layer&metric=security_rating&branch=1.x" alt="Bugs"></a>
<a href="https://sonarcloud.io/component_measures?metric=bugs&branch=1.x&id=easy-http_guzzle-layer"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_guzzle-layer&metric=bugs&branch=1.x" alt="Bugs"></a>
<a href="https://sonarcloud.io/component_measures?metric=code_smells&branch=1.x&id=easy-http_guzzle-layer"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_guzzle-layer&metric=code_smells&branch=1.x" alt="Bugs"></a>

This is an HTTP layer for Guzzle Client based on [HTTP layer contracts](https://github.com/easy-http/layer-contracts).
These contracts standardize the way you consume HTTP clients like Guzzle, Symfony, and others with a consistent interface. No matter what client you are using,
the methods you have to execute to do the job are the same for all!!.

:books: Check out the [Documentation](https://easy-http.com/docs) to learn how to use any layer that implements these contracts.

This library supports the following versions of Guzzle Http Client.

<a href="#tada-php-support" title="Guzzle Version Supported"><img alt="PHP Versions Supported" src="https://img.shields.io/badge/guzzle-6.x-blue"></a>
<a href="#tada-php-support" title="Guzzle Version Supported"><img alt="PHP Versions Supported" src="https://img.shields.io/badge/guzzle-7.x-blue"></a>

# Installation

Use following command to install this library:

```bash
composer require easy-http/guzzle-layer
```

# Usage

This layer as well as any other uses the [HTTP Layer Contracts](https://github.com/easy-http/layer-contracts).
You can check all behavior for the current version at [Easy Http Documentation](https://easy-http.com/docs).
