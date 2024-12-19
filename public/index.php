<?php

require '../vendor/autoload.php';

use Src\Core\Boot;
use Src\Core\Security\BlockManyAccessSecurity;
use Src\Core\Security\Ip;
use Src\Database\Redis;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable("../");
$dotenv->load();

date_default_timezone_set(env("TIMEZONE", "America/Sao_Paulo"));

$start = new Boot(
    new BlockManyAccessSecurity(
        new Ip(
            $_SERVER['REMOTE_ADDR'],
            new Redis(
                env("REDIS_SCHEMA"),
                env("REDIS_HOST"),
                env("REDIS_PORT")
            )
        )
    )
);

