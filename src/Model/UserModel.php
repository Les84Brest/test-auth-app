<?php

declare(strict_types=1);

namespace TestApp\Model;

use TestApp\Api\UserInterface;
use TestApp\Entity\UserEntity;
use TestApp\Helper\AuthHelper;
use TestApp\Helper\DatabaseHelper;

class UserModel implements UserInterface
{
    private DatabaseHelper $helper;

    public function __construct()
    {
        $this->helper = DatabaseHelper::getInstance();
    }

    public function getUser(string $login): UserEntity | bool
    {

        $db = $this->helper::getDatabase();
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
        $db = $this->helper::getDatabase();
        $users = $db['users'];
        $userLogin = $user->getLogin();
        $userData = $user->getUserData();
        $userData = array_filter($userData, function ($key) {
            if ($key === 'login') {
                return false;
            }

            return true;
        }, ARRAY_FILTER_USE_KEY);
        $users[$userLogin] = $userData;
        $db['users'] = $users;

        $this->helper::writeDatabase($db);

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

    public function ifUserExists(string $login): bool
    {
        $db = $this->helper::getDatabase();
        return array_key_exists($login, $db['users']);
    }

    public function checkIfEmailWasAlreadyUsed(string $email): bool
    {
        $db = $this->helper::getDatabase();
        $accountWithEmail = array_filter($db['users'], function ($user) use ($email) {
            return $user['email'] === $email;
        });

        return sizeof($accountWithEmail) > 0 ? true : false;
    }
}
