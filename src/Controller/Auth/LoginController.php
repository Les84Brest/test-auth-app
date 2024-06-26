<?php

declare(strict_types=1);

namespace TestApp\Controller\Auth;

use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;
use TestApp\Helper\ConfigHelper;
use TestApp\Helper\Validator;
use TestApp\Model\UserModel;

class LoginController extends AbstractAuthController
{
    const LOGIN_FIELD_NAME = 'login';
    const PASSWORD_FIELDNAME = 'password';


    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {

        $loginErrors = [];
        $loginData = $request->getParams();
        $userLogin = $loginData[self::LOGIN_FIELD_NAME];
        $userPassword = $loginData[self::PASSWORD_FIELDNAME];

        //initial data validation
        $validator = new Validator;
        $loginValidationStatus = $validator->validate($userLogin, [
            Validator::NOT_EMPTY => true,
            Validator::MIN_LENGTH => 6,
            // Validator::CONTAINS_SPACES_ONLY => true,
            Validator::CONTAINS_SPACES => true,
        ]);

        if (!$loginValidationStatus['isValid']) {
            $loginErrors[self::LOGIN_FIELD_NAME] = $loginValidationStatus['errorMessage'];
        }

        $passValidationStatus = $validator->validate($userPassword, [
            Validator::NOT_EMPTY => true,
            Validator::MIN_LENGTH => 6,
            Validator::IS_PASSWORD => true,
        ]);

        if (!$passValidationStatus['isValid']) {
            $loginErrors[self::PASSWORD_FIELDNAME] = $passValidationStatus['errorMessage'];
        }

        if (sizeof($loginErrors)) {
            // in case when we have errors on initial data validaton 
            // terminate login process with errors
            $this->sessionManager::setLogined(false);
            $this->sessionManager::setLoginErrors($loginErrors);
            $this->sessionManager::setOldData($loginData);
            $response->setResponseData(json_encode(['isLogined' => false]));

            return $response;
        }

        // login process
        $user = $this->userModel->getUser(trim($userLogin));
        if ($user) {

            $helper = new ConfigHelper();
            $hashedPassword = md5($helper->getPasswordSalt() . trim($userPassword));

            if ($hashedPassword == $user->getPassword()) {
                $this->sessionManager::setLogined(true);
                $this->sessionManager::setUserName($user->getName());

                $response->setResponseData(json_encode(['isLogined' => true]));
            } else {
                $loginErrors[self::PASSWORD_FIELDNAME] = "Введен неверный пароль";
                $this->sessionManager::setLogined(false);
                $response->setResponseData(json_encode(['isLogined' => false]));
            }
        } else {
            $loginErrors[self::LOGIN_FIELD_NAME] = sprintf("Пользователь с логином %s не найден", $userLogin);
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
}
