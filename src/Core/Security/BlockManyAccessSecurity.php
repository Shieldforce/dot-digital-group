<?php

namespace Src\Core\Security;

class BlockManyAccessSecurity
{
    public function __construct(public Ip $ip)
    {
    }
}