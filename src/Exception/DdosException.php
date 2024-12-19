<?php

namespace Src\Exception;

use Exception;

class DdosException
{
    public static function error(string $msg)
    {
        throw new Exception($msg);
    }
}