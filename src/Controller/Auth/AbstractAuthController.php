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

    protected $sessionManager;

    public function __construct()
    {
        $this->sessionManager = SessionManager::getInstance();
    }

    abstract public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface;
}
