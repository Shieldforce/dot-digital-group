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

    public function connect() : TypeDatabaseInterface
    {
        //
    }

    public function create(...$data) : TypeDatabaseInterface
    {
        //
    }

    public function update(...$data) : TypeDatabaseInterface
    {
        //
    }

    public function delete(...$data) : TypeDatabaseInterface
    {
        //
    }

    public function read(...$data)
    {
        //
    }
}