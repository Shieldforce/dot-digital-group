<?php

namespace Src\Database;

interface TypeDatabaseInterface
{
    public function connect();
    public function create();
    public function update();
    public function delete();
    public function read();
}