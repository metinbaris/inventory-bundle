<?php

namespace MetinBaris\InventoryBundle;

use Doctrine\DBAL\DriverManager;

class App
{
    public static function init()
    {
        self::checkDBConnection();
    }

    private static function checkDBConnection()
    {
        $databaseUrl = $_ENV['DATABASE_URL'];
        if (!isset($databaseUrl)) {
            throw new \Exception("Please set db connection");
        }

        $connectionParams = ['url' => $databaseUrl];
        $connection = DriverManager::getConnection($connectionParams);
        $driver = $connection->getDriver();

        if (!$driver instanceof \Doctrine\DBAL\Driver\PDO\MySQL\Driver) {
            echo "Connection is not obtained by MySQL";
            die;
        }

        $connection->getWrappedConnection();
    }
}
