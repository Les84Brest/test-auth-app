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

    public function validate(string $data, array $validationRules): bool | array
    {
        $validationErrors = [];

        return [];
    }
}
