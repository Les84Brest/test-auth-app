<?php

declare(strict_types=1);

namespace TestApp\Controller\Auth;


use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;
use TestApp\Entity\UserEntity;
use TestApp\Helper\ConfigHelper;
use TestApp\Helper\Validator;

class RegistrationController extends AbstractAuthController
{
    const LOGIN_FIELD_NAME = 'registerLogin';
    const EMAIL_FIELD_NAME = 'registerEmail';
    const NAME_FIELD_NAME = 'registerName';
    const PASSWORD_FIELDNAME = 'registerPassword';
    const PASSWORD_REPEAT_FIELDNAME = 'registerPasswordRepeat';


    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {


        $registrationData = $request->getParams();
        // initial data validation
        $dataValidationStatus = $this->validateRegistrationData($registrationData);

        if (!$dataValidationStatus) {
            $this->sessionManager::setOldData($registrationData);
            $response->setResponseData(json_encode(['isLogined' => false]));
            return $response;
        } else {
            $this->sessionManager->resetLoginErrors();
        }

        // check if user exists in database and email is not used in another account
        // true - it's ok, false - login or email duplicates

        $validateExistingUsersStatus = $this->validateExistingUsersData($registrationData[self::LOGIN_FIELD_NAME], $registrationData[self::EMAIL_FIELD_NAME]);

        if (!$validateExistingUsersStatus) {
            $this->sessionManager::setOldData($registrationData);
            $response->setResponseData(json_encode(['isLogined' => false]));
            return $response;
        }

        // Creating a user instance and passing it to the database for saving

        $user = new UserEntity;
        extract($registrationData);
        $configHelper = new ConfigHelper;

        $hashedPassword = md5($configHelper->getPasswordSalt() . $registerPassword);

        $user->setLogin(trim($registerLogin));
        $user->setName(trim($registerName));
        $user->setEmail(trim($registerEmail));
        $user->setPassword(trim($hashedPassword));

        $this->userModel->createUser($user);
        $this->sessionManager::setLogined(true);
        $this->sessionManager::setUserName($user->getName());

        $response->setResponseData(json_encode(['isLogined' => true]));
        return $response;
    }

    private function validateRegistrationData(array $data): bool
    {
        $isValid = true;
        $validationErrors = [];

        $validator = new Validator;
        extract($data);

        //Login validation
        $loginValidationStatus = $validator->validate($registerLogin, [
            Validator::NOT_EMPTY => true,
            Validator::MIN_LENGTH => 6,
            Validator::CONTAINS_SPACES_ONLY => true,
            Validator::CONTAINS_SPACES => true,
        ]);
        if (!$loginValidationStatus['isValid']) {
            $isValid = false;
            $validationErrors[self::LOGIN_FIELD_NAME] = $loginValidationStatus['errorMessage'];
        }
        //Name validation

        $nameValidationStatus = $validator->validate($registerName, [
            Validator::NOT_EMPTY => true,
            Validator::MIN_LENGTH => 2,
            // Validator::CONTAINS_SPACES_ONLY => true
        ]);

        if (!$nameValidationStatus['isValid']) {
            $isValid = false;
            $validationErrors[self::NAME_FIELD_NAME] = $nameValidationStatus['errorMessage'];
        }

        //Email validation
        $emailValidationStatus = $validator->validate($registerEmail, [
            Validator::NOT_EMPTY => true,
            Validator::IS_EMAIL => true
        ]);
        if (!$emailValidationStatus['isValid']) {
            $isValid = false;
            $validationErrors[self::EMAIL_FIELD_NAME] = $emailValidationStatus['errorMessage'];
        }

        //Password validation
        $passwordValidationStatus = $validator->validate($registerPassword, [
            Validator::NOT_EMPTY => true,
            Validator::MIN_LENGTH => 6,
            Validator::IS_PASSWORD => true,
        ]);
        if (!$passwordValidationStatus['isValid']) {
            $isValid = false;
            $validationErrors[self::PASSWORD_FIELDNAME] = $passwordValidationStatus['errorMessage'];
        }

        //Password repeat validation
        $passwordRepeatValidationStatus = $validator->validate($registerPasswordRepeat, [
            Validator::NOT_EMPTY => true,
            Validator::HAS_SAME_VALUE => true
        ], $registerPassword);
        if (!$passwordRepeatValidationStatus['isValid']) {
            $isValid = false;
            $validationErrors[self::PASSWORD_REPEAT_FIELDNAME] = $passwordRepeatValidationStatus['errorMessage'];
        }


        if (!$isValid) {
            $this->sessionManager::setLoginErrors($validationErrors);
        }


        return $isValid;
    }
    /**
     * This method validates if user with such login already exists 
     * or maybe given email was used by another user
     */

    private function validateExistingUsersData(string $login, string $email): bool
    {
        $userExists = $this->userModel->ifUserExists($login);
        $emailWasUsed = $this->userModel->checkIfEmailWasAlreadyUsed($email);
        $dbErrors = [];

        if ($userExists) {
            $dbErrors[self::LOGIN_FIELD_NAME] = sprintf('Пользователь с логином %s уже существует', $login);
        }

        if ($emailWasUsed) {
            $dbErrors[self::EMAIL_FIELD_NAME] = "Введенный email уже используется.";
        }
        $validationResult =  !$userExists && !$emailWasUsed;
        if (!$validationResult) {
            $this->sessionManager->setLoginErrors($dbErrors);
        }

        return $validationResult;
    }
}
