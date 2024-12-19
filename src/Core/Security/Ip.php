<?php

namespace Src\Core\Security;

use Src\Database\TypeDatabaseInterface;
use Src\Exception\IpNotFoundException;

class Ip
{
    public function __construct(
        public string $ip,
        protected TypeDatabaseInterface $database
    )
    {
        if (empty($this->ip)) {
            IpNotFoundException::error('Ip not found!');
        }

        $this->verify($this->ip);
    }

    public function verify(string $ip)
    {
        $connect = $this->database->connect();
    }
}