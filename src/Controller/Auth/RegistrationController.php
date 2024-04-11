<?php

declare(strict_types=1);

namespace TestApp\Controller\Auth;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;

class RegistrationController implements ActionInterface
{
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // $response->template('page/blog');

        return $response;
    }
}
