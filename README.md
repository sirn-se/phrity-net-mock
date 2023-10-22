[![Build Status](https://github.com/sirn-se/phrity-net-mock/actions/workflows/acceptance.yml/badge.svg)](https://github.com/sirn-se/phrity-net-mock/actions)
[![Coverage Status](https://coveralls.io/repos/github/sirn-se/phrity-net-mock/badge.svg?branch=main)](https://coveralls.io/github/sirn-se/phrity-net-mock?branch=main)

# Introduction

Writing tests that use streams is problematic.
This library provides a mocking layer for [phrity/net-stream](https://phrity.sirn.se/net-stream/),
allowing developers to verify and mock stream interactions.

## Installation

Install with [Composer](https://getcomposer.org/);
```
composer require phrity/net-mock
```

# Usage

The classes in this library are fully compatible with those of the net-stream library.
By default, calling the mock classes will propagate into the real implementation classes.

```php
use Phrity\Net\StreamFactory as RealStreamFactory;
use Phrity\Net\Mock\StreamFactory as MockStreamFactory;

// Your code should allow setting stream classes
$my_stream_user = new StreamUsingClass();
$my_stream_user->setStreamfactory($mock ? new MockStreamFactory() : new RealStreamFactory());
$my_stream_user->run();
```

## Log interactions

By adding a [PSR-3](https://www.php-fig.org/psr/psr-3/) compatible logger, all calls will be logged.
The library includes a simple EchoLogger, but any compatible logger is usable.

```php
use Phrity\Net\Mock\EchoLogger;
use Phrity\Net\Mock\Mock;
use Phrity\Net\Mock\StreamFactory;

Mock::setLogger(new EchoLogger());

$my_stream_user = new StreamUsingClass();
$my_stream_user->setStreamfactory(new StreamFactory());
$my_stream_user->run();
```

## Mock interactions

By registring a callback handler, all calls will pass through the callback instead.

```php
use Phrity\Net\Mock\Mock;
use Phrity\Net\Mock\StreamFactory;

Mock::setCallback(function (int $counter, string $method, array $params, callable $default) {
    // Assert call and parameters
    // The returned value will be passed back to calling code.
    // If you want to return the result of original code, use the $default callable
    return $default();
});

$my_stream_user = new StreamUsingClass();
$my_stream_user->setStreamfactory(new StreamFactory());
$my_stream_user->run();
```

## Versions

| Version | PHP | |
| --- | --- | --- |
| `1.3` | `^7.4\|^8.0` | [phrity/net-stream v1.3](https://phrity.sirn.se/net-stream/1.3.0) |
| `1.2` | `^7.4\|^8.0` | [phrity/net-stream v1.2](https://phrity.sirn.se/net-stream/1.2.0) |
| `1.1` | `^7.4\|^8.0` | [phrity/net-stream v1.1](https://phrity.sirn.se/net-stream/1.1.0) |
| `1.0` | `^7.4\|^8.0` | [phrity/net-stream v1.0](https://phrity.sirn.se/net-stream/1.0.0) |
