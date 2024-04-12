<?php

declare(strict_types=1);

namespace TestApp\Controller;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;
use TestApp\Helper\RenderHelper;
use TestApp\Session\SessionManager;

abstract class AbstractPageController implements ActionInterface
{
    protected SessionManager $sessionManager;
    protected RenderHelper $renderHelper;

    public function __construct()
    {
        $this->sessionManager = SessionManager::getInstance();
        $this->renderHelper = new RenderHelper();
    }

    abstract public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface;
}
