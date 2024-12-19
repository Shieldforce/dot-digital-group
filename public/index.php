<?php

require '../vendor/autoload.php';

use Src\Core\Boot;
use Src\Core\Security\BlockManyAccessSecurity;
use Src\Core\Security\Ip;
use Src\Database\Redis;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable("../");
$dotenv->load();

$start = new Boot(
    new BlockManyAccessSecurity(
        new Ip(
            $_SERVER['REMOTE_ADDR'],
            new Redis("tcp", getenv("REDIS_HOST"), getenv("REDIS_PORT"))
        )
    )
);


/*$redis->set('meu_cache', 'Este é um valor de teste');
$redis->expire('meu_cache', 3600); // Expira em 1 hora

$data = $redis->get('meu_cache');
echo $data;

$redis->del('meu_cache');*/

dd($start);

