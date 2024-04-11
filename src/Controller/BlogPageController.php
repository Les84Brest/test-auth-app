<?php

declare(strict_types=1);

namespace TestApp\Controller;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;

class BlogPageController implements ActionInterface
{
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->template('page/blog');
        return $response;
    }
}
