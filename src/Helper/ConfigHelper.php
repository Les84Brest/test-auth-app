<?php

declare(strict_types=1);

namespace TestApp\Helper;

class ConfigHelper
{

    private  $appConfig;

    public function __construct()
    {

        $this->appConfig = require __DIR__ . '/../config.php';
    }

    public  function getPasswordSalt(): string
    {
        return $this->appConfig['passwordSalt'];
    }

    public function getDbPath()
    {
        return $this->appConfig['dbPath'];
    }
}
