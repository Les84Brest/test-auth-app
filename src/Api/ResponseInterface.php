<?php

declare(strict_types=1);

namespace TestApp\Api;

interface ResponseInterface
{
    public function template(string $name, array $vars = []): void;
    public function render(): void;
    public function setLayout(string $layout = 'layout'): void;
    public function addLayoutVars($vars): void;
}
