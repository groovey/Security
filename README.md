# Security

Groovey Security Package

## Installation

    $ composer require groovey/security

## Usage

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Silex\Application;
use Groovey\JWT\Providers\JWTServiceProvider;

$app = new Application();
$app['debug'] = true;

$app->register(new SecurityServiceProvider());

$hash    = $app['password']->hash('foo');
$status  = $app['password']->verify('foo', $hash);

$data    = $app['cryptography']->encrypt('Hello World', 'pass123');
$message = $app['cryptography']->decrypt($data, 'pass123');
$hash    = $app['cryptography']->hash('Hello World');

```