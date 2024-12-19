<?php

namespace Src\Database;

class Mysql implements TypeDatabaseInterface
{
    public function __construct(
        string $username = null,
        string $password = null,
        string $database = null,
        string $host = null,
        string $port = null,
    )
    {
    }

    public static function connect()
    {
        //
    }

    public static function create()
    {
        // TODO: Implement create() method.
    }

    public static function update()
    {
        // TODO: Implement update() method.
    }

    public static function delete()
    {
        // TODO: Implement delete() method.
    }

    public static function read()
    {
        // TODO: Implement read() method.
    }
}