<?php

namespace Src\Exception;

use Exception;

class RedisConnectionException
{
    public static function error(string $msg)
    {
        throw new Exception($msg);
    }
}