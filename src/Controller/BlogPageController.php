<?php

declare(strict_types=1);

namespace TestApp\Controller;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;

class BlogPageController extends AbstractPageController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->template('page/blog');
        $response->setLayout();
        $response->addLayoutVars([
            "title" => "Blog",
            "isLogined" => $this->sessionManager::getLogined(),
            "userName" => $this->sessionManager::getUserName()
        ]);
        return $response;
    }
}
