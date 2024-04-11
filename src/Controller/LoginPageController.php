<?php

declare(strict_types=1);

namespace TestApp\Controller;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;

class LoginPageController implements ActionInterface
{
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->template('page/login');
        return $response;
    }
}
