<?php

declare(strict_types=1);

namespace TestApp\Controller;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;

class AboutPageController extends AbstractPageController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->template('page/about');
        $response->setLayout();
        $response->addLayoutVars([
            "title" => "О нас",
            "isLogined" => $this->sessionManager::getLogined(),
            "userName" => $this->sessionManager::getUserName()
        ]);
        return $response;
    }
}
