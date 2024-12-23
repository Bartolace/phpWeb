<?php

namespace Bartolace\Pdo\Infrastructure\Persistence;

class ConnectionCreator
{

    public static function createConnection() : \PDO
    {
        $dataBasePath = __DIR__ . '/../../../banco.sql';
        return new \PDO('sqlite:' . $dataBasePath);
    }
}