# JWT

Groovey Json Web Token

## Installation

    $ composer require groovey/jwt

## Usage

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Silex\Application;
use Groovey\JWT\Providers\JWTServiceProvider;

$app = new Application();
$app['debug'] = true;

$app->register(new JWTServiceProvider(), [
                'jwt.issuer'   => 'localhost',
                'jwt.audience' => 'localhost',
                'jwt.key'      => 'testkey',
            ]);

$payload = [
    'email'    => 'test1@gmail.com',
    'password' => 'test1',
];

$token   = $app['jwt']->encode($payload);
$payload = $app['jwt']->decode($token);

```