<?php

declare(strict_types=1);

namespace TestApp;

use TestApp\Routing\ApiResponse;
use TestApp\Routing\Request;
use TestApp\Routing\Response;
use TestApp\Routing\Router;
use TestApp\Routing\RoutesList;

class App
{
    public function run(): void
    {
        $router = new Router();

        $routesList = new RoutesList();
        $routesList->configure($router);


        $request = new Request();

        $handler = $router->dispatch($request);

        $response = $request->getMethod() == Router::HTTP_GET
            ?  new Response(
                dirname(__DIR__) . '/templates'
            )
            : new ApiResponse;

        $response = $handler($request, $response);
        $response->render();
    }
}
