<?php

declare(strict_types=1);

namespace TestApp\Controller;

use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;
use TestApp\Helper\RenderHelper;
use TestApp\Session\SessionManager;

class LoginPageController extends AbstractPageController
{

    private RenderHelper $renderHelper;

    public function __construct()
    {
        parent::__construct();
        $this->renderHelper = new RenderHelper();
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // if user is logined there is no sence to display login page
        if ($this->sessionManager::getLogined()) {
            header('Location: /');
            exit();
        }
        $loginErrorMessages = $this->sessionManager::getLoginErrors();
        $oldData = $this->sessionManager::getOldData();

        $response->template('page/login', [
            'errorMessages' => $loginErrorMessages,
            'oldData' => $oldData,
            'renderHelper' => $this->renderHelper
        ]);
        $response->setLayout();
        $response->addLayoutVars([
            "title" => "Login page",
            "isLogined" => $this->sessionManager::getLogined(),
            "userName" =>$this->sessionManager::getUserName()
        ]);
        return $response;
    }
}
