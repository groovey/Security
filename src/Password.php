<?php

namespace Groovey\Security;

use Pimple\Container;

class Password
{
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function hash($password)
    {
        $options = ['cost' => 12];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function verify($password, $hash)
    {
        if (password_verify($password, $hash)) {
            return true;
        }

        return false;
    }
}
