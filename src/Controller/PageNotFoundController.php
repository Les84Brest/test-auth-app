<?php

declare(strict_types=1);

namespace TestApp\Controller;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;

class PageNotFoundController implements ActionInterface
{
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true);

        $response->template('page/not-found');
        return $response;
    }
}
