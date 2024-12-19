<?php

namespace Src\Database;

interface TypeDatabaseInterface
{
    public function connect() : TypeDatabaseInterface;
    public function create(...$data) : TypeDatabaseInterface;
    public function update(...$data) : TypeDatabaseInterface;
    public function delete(...$data) : TypeDatabaseInterface;
    public function read(...$data);
}