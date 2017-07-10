<?php

use Silex\Application;
use Groovey\Support\Providers\TraceServiceProvider;
use Groovey\Security\Providers\SecurityServiceProvider;

class PasswordTest extends PHPUnit_Framework_TestCase
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

    public function testFunctionExists()
    {
        $this->assertTrue(function_exists('password_hash'));
    }

    public function testStringLength()
    {
        $app      = $this->app;
        $password = $app['password']->hash('foo');
        $this->assertEquals(60, strlen($password));
    }

    public function testHash()
    {
        $app = $this->app;
        $hash = $app['password']->hash('foo');
        $this->assertEquals($hash, crypt('foo', $hash));
    }

    public function testPasswordVerify()
    {
        $app    = $this->app;
        $hash   = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
        $status = $app['password']->verify('rasmuslerdorf', $hash);

        $this->assertTrue($status);
    }

    public function testPasswordVerifyFoo()
    {
        $app    = $this->app;
        $hash   = '$2y$12$sK3RXkTw0Z8x.dxidhYXm.2CgemmawCs0xfO7Lk8HTQWSj4SkVST2';
        $status = $app['password']->verify('foo', $hash);
        $this->assertTrue($status);

        $hash   = '$2y$12$Jj6924uxZ1GJAt6vuMhYguCrHz1pBVdxG186yNtm8zR9wJWA3FGHm';
        $status = $app['password']->verify('foo', $hash);
        $this->assertTrue($status);

        $hash   = '$2y$12$kKgZBTVWfpN8UKF.wOIaJ.i8FAubGAYyU3DllcNPtTqCpkw4YW7Yq';
        $status = $app['password']->verify('foo', $hash);
        $this->assertTrue($status);
    }

    public function testPasswordInfo()
    {
        $hash  = '$2y$12$sK3RXkTw0Z8x.dxidhYXm.2CgemmawCs0xfO7Lk8HTQWSj4SkVST2';
        $info = password_get_info($hash);

        $this->assertArrayHasKey('algo', $info);
        $this->assertArrayHasKey('algoName', $info);
        $this->assertArrayHasKey('options', $info);
        $this->assertEquals('bcrypt', $info['algoName']);
        $this->assertEquals('12', $info['options']['cost']);
    }
}
