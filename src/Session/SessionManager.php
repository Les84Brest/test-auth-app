<?php

declare(strict_types=1);

namespace TestApp\Session;

class SessionManager
{
    protected static $_instance;
    const LOGIN_ERRORS = 'loginErrors';
    const IS_LOGINED = 'isLogined';
    const USER_NAME = 'userName';
    const OLD_DATA = 'oldData';

    private function __construct()
    {
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


    public static function setLoginErrors(array $loginErrors): void
    {
        $_SESSION[self::LOGIN_ERRORS] = $loginErrors;
    }

    public static function resetLoginErrors(): void
    {
        unset($_SESSION[self::LOGIN_ERRORS]);
    }

    public static function setLogined(bool $loginStatus): void
    {
        $_SESSION[self::IS_LOGINED] = $loginStatus;

        if ($loginStatus) {
            self::resetLoginErrors();
        } else {
            unset($_SESSION[self::USER_NAME]);
        }
    }

    public static function setUserName(string $name): void
    {
        $_SESSION[self::USER_NAME] = $name;
    }

    public static function setOldData(array $oldData): void
    {
        $_SESSION[self::OLD_DATA] = $oldData;
    }

    public static function resetOldData(): void
    {
        unset($_SESSION[self::OLD_DATA]);
    }
}
