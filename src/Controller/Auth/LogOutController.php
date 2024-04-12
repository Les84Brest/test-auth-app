<?php

declare(strict_types=1);

namespace TestApp\Controller\Auth;

use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;

class LogOutController extends AbstractAuthController
{
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {

        $logoutData = $request->getRequestJSON();
        if (isset($logoutData['logOut']) && $logoutData['logOut'] == true) {
            $this->sessionManager->setLogined(false);
            $this->sessionManager->resetOldData();
            $this->sessionManager->resetLoginErrors();

            $logoutStatus = ['status' => true];
        } else {
            $logoutStatus = ['status' => false];
        }

        $response->setResponseData(json_encode($logoutStatus));
        return $response;
    }
}
