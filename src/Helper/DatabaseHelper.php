<?php

declare(strict_types=1);

namespace TestApp\Helper;


class DatabaseHelper
{
    protected static $_instance;
    protected static $config;

    private function __construct()
    {
        self::$config = new ConfigHelper;
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getDatabase(): array
    {
        $path = self::$config->getDbPath();
        $db = json_decode(file_get_contents($path), true);
        return $db;
    }
    public static function writeDatabase(array $data): void
    {
        $path = self::$config->getDbPath();
        $dbEntries = json_encode($data);
        file_put_contents($path, $dbEntries);
    }
}
