<?php

declare(strict_types=1);

namespace TestApp\Helper;

use TestApp\Api\ValidatorInterface;

class Validator implements ValidatorInterface
{
    const NOT_EMPTY = 'NOT_EMPTY';
    const MIN_LENGTH = 'MIN_LENGTH';
    const IS_EMAIL = 'IS_EMAIL';
    const IS_PASSWORD = 'IS_PASSWORD';
    const HAS_SAME_VALUE = 'HAS_SAME_VALUE';
    const CONTAINS_SPACES_ONLY = 'CONTAINS_SPACES_ONLY';
    const CONTAINS_SPACES = 'CONTAINS_SPACES';

    /**
     * Returns validation status. In case when field is valid errorMessage field contains empty string
     *
     */
    public function validate(string $data, array $validationRules, mixed $dataToMatch = null): array
    {
        $validationErrors = [];
        $isValid = true;
        $data = trim($data);
        $dataToMatch = $dataToMatch ? trim($dataToMatch) :  $dataToMatch;

        foreach ($validationRules as $key => $value) {
            $isValid = match ($key) {
                self::NOT_EMPTY => $this->validateNotEmpty($data, $validationErrors),
                self::MIN_LENGTH => $this->validateMinLength($data, $value, $validationErrors),
                self::IS_EMAIL => $this->validateEmail($data, $validationErrors),
                self::IS_PASSWORD => $this->validatePassword($data, $validationErrors),
                self::HAS_SAME_VALUE => $this->validateHasSameValue($data, $dataToMatch, $validationErrors),
                self::CONTAINS_SPACES_ONLY => $this->validateContainsSpacesOnly($data,  $validationErrors),
                self::CONTAINS_SPACES => $this->validateContainsSpaces($data, $validationErrors)
            };
        }

        return ['isValid' => $isValid, 'errorMessage' => implode('. ', $validationErrors)];
    }

    private function validateNotEmpty(string $data, array &$validationErrors): bool
    {
        if (empty($data)) {
            $validationErrors[] = 'Пустые значения недопустимы';
            return false;
        }
        return true;
    }

    private function validateMinLength(string $data, int $length, array &$validationErrors): bool
    {
        if (strlen($data) < $length) {
            $validationErrors[] = sprintf('Значение должно быть длинее %d', $length);
            return false;
        }
        return true;
    }

    private function validateEmail(string $data, array &$validationErrors): bool
    {

        if (!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i", $data)) {
            $validationErrors[] = 'Введен некорректный email';
            return false;
        }
        return true;
    }

    private function validatePassword(string $data, array &$validationErrors): bool
    {
        if (!(preg_match("/^[a-zA-Z0-9]+$/i", $data) > 0)) {
            $validationErrors[] = 'В пароле допускаются только латинские буквы и цифры';
            return false;
        }
        return true;
    }

    private function validateHasSameValue(mixed $data, mixed $toMatch, array &$validationErrors): bool
    {
        if (!($data === $toMatch)) {
            $validationErrors[] = 'Значения не совпадают';
            return false;
        }
        return true;
    }
    private function validateContainsSpacesOnly(string $data, array &$validationErrors): bool
    {
        if (preg_match("/^\s+$/i", $data)) {
            $validationErrors[] = 'Некорректное значение';
            return false;
        }
        return true;
    }

    private function validateContainsSpaces($data, &$validationErrors): bool
    {
        if (preg_match("/\s+/i", $data)) {
            $validationErrors[] = 'Значение не должно содержать пробелов';
            return false;
        }
        return true;
    }
}
