<?php

function dd(string|object|array $data)
{
    echo "<pre style='padding:20px;background: black; color: white;'>";
    var_dump($data);
    echo "</pre>";
    die();
}

function env(string $var, string $default = null)
{
    return $_ENV[$var] ?? $default ?? null;
}