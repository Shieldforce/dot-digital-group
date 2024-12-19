<?php

namespace Src\Database;

use Predis\Client;
use Src\Exception\RedisConnectionException;

class Redis implements TypeDatabaseInterface
{
    public function __construct(
        public ?string $scheme,
        public ?string $host,
        public ?string $port,
        public ?string $password = null,
    )
    {
    }

    public function connect()
    {
        $client = new Client([
            'scheme' => $this->scheme,
            'host'   => $this->host,
            'port'   => $this->password,
        ]);

        if ($client->ping() === 'PONG') {
            RedisConnectionException::error('Redis connection failed');
        }

        return $client;
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function read()
    {
        // TODO: Implement read() method.
    }
}