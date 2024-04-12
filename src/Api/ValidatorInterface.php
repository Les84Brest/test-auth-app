<?php

declare(strict_types=1);

namespace TestApp\Api;

interface ValidatorInterface
{
    public function validate(string $data, array $validationRules): array;
}
