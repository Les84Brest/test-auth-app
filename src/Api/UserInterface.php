<?php

declare(strict_types=1);

namespace TestApp\Api;

use TestApp\Entity\UserEntity;

interface UserInterface
{
    public function getUser(string $login): UserEntity | bool;
    public function createUser(UserEntity $user): bool;
    public function deleteUser(string $login): bool;
    public function updateUser(UserEntity $user): bool;
    public function ifUserExists(string $login): bool;
}
