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

    /**
     * Returns validation status. In case when field is valid errorMessage field contains empty string
     * 
     */
    public function validate(string $data, array $validationRules): array
    {
        $validationErrors = [];
        $isValid = true;


        foreach ($validationRules as $key => $value) {
            $isValid = match ($key) {
                self::NOT_EMPTY => $this->validateNotEmpty($data, $validationErrors),
                self::MIN_LENGTH => $this->validateMinLength($data, $value, $validationErrors),
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
}
