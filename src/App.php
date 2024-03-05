<?php

namespace MetinBaris\InventoryBundle;

use Doctrine\DBAL\DriverManager;

class App
{
    const CONSTANT_EXPECTED_ENV_VARIABLES = ['INVENTORY_MAIL', 'MAILER_DSN', 'DATABASE_URL'];

    public static function init()
    {
        self::checkEnvironmentVariables();
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

        $connection->getNativeConnection();
    }

    private static function checkEnvironmentVariables()
    {
        foreach (self::CONSTANT_EXPECTED_ENV_VARIABLES as $var) {
            if (!isset($_ENV[$var])) {
                throw new \Exception("Your .env file is missing: \"$var\" please assign a value");
            }
        }
    }
}
