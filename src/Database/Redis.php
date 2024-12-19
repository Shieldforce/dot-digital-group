<?php

namespace Src\Database;

use Predis\Client;
use Src\Exception\RedisConnectionException;

class Redis implements TypeDatabaseInterface
{
    private $client;

    public function __construct(
        public ?string $scheme,
        public ?string $host,
        public ?string $port,
        public ?string $password = null,
    )
    {
    }

    public function connect(): TypeDatabaseInterface
    {
        $this->client = new Client([
            'scheme' => $this->scheme,
            'host'   => $this->host,
            'port'   => $this->port,
        ]);

        if ($this->client->ping() === 'PONG') {
            RedisConnectionException::error('Redis connection failed');
        }

        return $this;
    }

    public function create(...$data): TypeDatabaseInterface
    {
        $key = $data[0] ??
               RedisConnectionException::error('Key not found');

        $value = $data[1] ??
                 RedisConnectionException::error('Value not found');

        $time = $data[2] ?? 3600;

        $this->client->set($key, $value);
        $this->client->expire($key, $time);

        return $this;
    }

    public function update(...$data): TypeDatabaseInterface
    {
        // ---
        return $this;
    }

    public function delete(...$data): TypeDatabaseInterface
    {
        $key = $data[0] ??
               RedisConnectionException::error('Key not found');

        $this->client->del($key);

        return $this;
    }

    public function read(...$data)
    {
        $key = $data[0] ??
               RedisConnectionException::error('Key not found');

        return $this->client->get($key);
    }
}