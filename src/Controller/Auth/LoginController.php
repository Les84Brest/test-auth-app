<?php

declare(strict_types=1);

namespace TestApp\Controller\Auth;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;
use TestApp\Entity\UserEntity;
use TestApp\Helper\AuthHelper;
use TestApp\Helper\Validator;
use TestApp\Model\UserModel;
use TestApp\Routing\ApiResponse;
use TestApp\Session\SessionManager;

class LoginController implements ActionInterface
{
    const LOGIN_FIELD_NAME = 'login';
    const PASSWORD_FIELDNAME = 'password';

    private $userModel;
    private $sessionManager;

    public function __construct()
    {
        $this->registerUserModel();
        $this->sessionManager = SessionManager::getInstance();
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {

        $loginErrors = [];


        $loginData = $request->getParams();
        $userLogin = $loginData[self::LOGIN_FIELD_NAME];
        $userPassword = $loginData[self::PASSWORD_FIELDNAME];

        $user = $this->userModel->getUser($userLogin);
        if ($user) {

            $helper = new AuthHelper();
            $hashedPassword = md5($userPassword . $helper->getPasswordSalt());

            if ($hashedPassword == $user->getPassword()) {
                $this->sessionManager::setLogined(true);
                $this->sessionManager::setUserName($user->getName());

                $response->setResponseData(json_encode(['isLogined' => true]));
            } else {
                $loginErrors[self::PASSWORD_FIELDNAME] = "Not correct password";
                $responseData = ['isLogined' => false];
                $response->setResponseData(json_encode(['isLogined' => false]));
            }
        } else {
            $loginErrors[self::LOGIN_FIELD_NAME] = "User with " . $userLogin . " login not found";
            $this->sessionManager::setLogined(false);
            $response->setResponseData(json_encode(['isLogined' => false]));
        }

        if (count($loginErrors)) {
            $this->sessionManager::setLoginErrors($loginErrors);
            $this->sessionManager::setLogined(false);
            $this->sessionManager::setOldData($loginData);
        }

        return $response;
    }

    private function registerUserModel(): void
    {
        $this->userModel = new UserModel();
    }
}
