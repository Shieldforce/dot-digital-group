<?php

namespace Src\Exception;

use Exception;

class IpNotFoundException
{
    public static function error(string $msg)
    {
        throw new Exception($msg);
    }
}