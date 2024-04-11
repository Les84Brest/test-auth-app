<?php

declare(strict_types=1);

namespace TestApp\Api;

interface RouterInterface
{
    public function get(string $path, string $callback): void;
    public function post(string $path, string $callback): void;
    public function dispatch(RequestInterface $request): ActionInterface;
    public function pageNotFound(string $callback): void;
}
