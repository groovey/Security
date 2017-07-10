<?php

namespace Groovey\Security\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Groovey\Security\Security;

class SecurityServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['security'] = function ($app) {
            return new Security($app);
        };
    }

    public function boot(Application $app)
    {
    }
}
