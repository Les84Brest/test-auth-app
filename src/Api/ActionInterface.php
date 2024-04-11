<?php

declare(strict_types=1);

namespace TestApp\Api;

interface ActionInterface {
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface;
}
