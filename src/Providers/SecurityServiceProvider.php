<?php

namespace Groovey\Security\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Groovey\Security\Password;
use Groovey\Security\Cryptography;

class SecurityServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['password'] = function ($app) {
            return new Password($app);
        };

        $app['cryptography'] = function ($app) {
            return new Cryptography($app);
        };
    }

    public function boot(Application $app)
    {
    }
}
