<?php

namespace Groovey\Security;

use Pimple\Container;

// More functions:
// http://php.net/manual/en/refs.crypto.php
class Security
{
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function password($password)
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
