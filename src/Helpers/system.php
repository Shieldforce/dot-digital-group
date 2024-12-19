<?php

function dd(string|object|array $data)
{
    echo "<pre style='padding:20px;background: black; color: white;'>";
    var_dump($data);
    echo "</pre>";
}