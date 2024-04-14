<?php

declare(strict_types=1);

namespace TestApp\Entity;

use TestApp\Api\UserInterface;

class UserEntity
{

    private string $login = '';
    private string $name = '';
    private string $password = '';
    private string $email = '';

    public function __construct()
    {
    }

    public function setLogin(string $login): void
    {
        if (is_string($login)) {
            $this->login = $login;
        }
    }

    public function setEmail(string $email): void
    {
        if (is_string($email)) {
            $this->email = $email;
        }
    }

    public function setName(string $name): void
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    public function setPassword(string $password): void
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getLogin(): string
    {
        return $this->login;
    }
    public function getUserData(): array
    {
        return [
            "login" => $this->getLogin(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "password" => $this->getPassword(),
        ];
    }
}
