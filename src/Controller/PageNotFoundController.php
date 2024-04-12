<?php

declare(strict_types=1);

namespace TestApp\Controller;

use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;
use TestApp\Api\ResponseInterface;

class PageNotFoundController extends AbstractPageController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true);

        $response->template('page/not-found');
        $response->setLayout();
        $response->addLayoutVars([
            "title" => "404",
            "isLogined" => $this->sessionManager::getLogined(),
            "userName" => $this->sessionManager::getUserName()
        ]);
        return $response;
    }
}
