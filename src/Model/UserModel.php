<?php

declare(strict_types=1);

namespace TestApp\Model;

use TestApp\Api\UserInterface;
use TestApp\Entity\UserEntity;
use TestApp\Helper\AuthHelper;

class UserModel implements UserInterface
{

    public function getUser(string $login): UserEntity | bool
    {
        $helper = new AuthHelper();
        $dbPath = $helper->getDbPath();
        $db = json_decode(file_get_contents($dbPath), true);
        $dbUser = array_filter($db['users'], function ($userLogin) use ($login) {
            return $userLogin == $login;
        }, ARRAY_FILTER_USE_KEY);

        if (isset($dbUser[$login])) {
            $userEntity = new UserEntity;
            $dbUser = $dbUser[$login];
            $userEntity->setLogin($login);
            $userEntity->setPassword($dbUser['password']);
            $userEntity->setName($dbUser['name']);
            $userEntity->setEmail($dbUser['email']);

            return $userEntity;
        }

        return false;
    }

    public function createUser(UserEntity $user): bool
    {
        return true;
    }
    public function deleteUser(string $login): bool
    {
        return true;
    }
    public function updateUser(UserEntity $user): bool
    {
        return true;
    }

    public function userExists(string $login): bool
    {
        return true;
    }
}
