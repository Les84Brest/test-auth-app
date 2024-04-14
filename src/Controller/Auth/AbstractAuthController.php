<?php

declare(strict_types=1);

namespace TestApp\Controller\Auth;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;
use TestApp\Helper\AuthHelper;
use TestApp\Model\UserModel;
use TestApp\Session\SessionManager;

abstract class AbstractAuthController implements ActionInterface
{

    protected SessionManager $sessionManager;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->sessionManager = SessionManager::getInstance();
        $this->registerUserModel();
    }

    abstract public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface;

    private function registerUserModel(): void
    {
        $this->userModel = new UserModel();
    }
}
