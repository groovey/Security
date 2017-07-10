<?php

use Silex\Application;
use Groovey\Support\Providers\TraceServiceProvider;
use Groovey\Security\Providers\SecurityServiceProvider;

class CryptographyTest extends PHPUnit_Framework_TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new TraceServiceProvider());
        $app->register(new SecurityServiceProvider());

        $this->app = $app;
    }

    public function testEncrpyt()
    {
        $app  = $this->app;
        $data = $app['cryptography']->encrypt('Hello World', 'pass123');

        $this->assertEquals('RSjm/vkBNHlDLeTQ4Qtc2g==', $data);
    }

    public function testDecrypt()
    {
        $app  = $this->app;
        $data = $app['cryptography']->decrypt('RSjm/vkBNHlDLeTQ4Qtc2g==', 'pass123');

        $this->assertEquals('Hello World', $data);
    }
}
