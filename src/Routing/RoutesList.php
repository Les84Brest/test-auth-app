<?

declare(strict_types=1);

namespace TestApp\Routing;

use TestApp\Api\RouterInterface;
use TestApp\Controller\AboutPageController;
use TestApp\Controller\Auth\LoginController;
use TestApp\Controller\Auth\RegistrationController;
use TestApp\Controller\BlogPageController;
use TestApp\Controller\HomePageController;
use TestApp\Controller\LoginPageController;
use TestApp\Controller\PageNotFoundController;

class RoutesList
{
    public function configure(RouterInterface $router): void
    {
        // GET routes
        $router->get('/', HomePageController::class);
        $router->get('/login', LoginPageController::class);
        $router->get('/about', AboutPageController::class);
        $router->get('/blog', BlogPageController::class);

        //POST routes
        $router->post('/siteregistration', RegistrationController::class);
        $router->post('/sitelogin', LoginController::class);

        //404
        $router->pageNotFound(PageNotFoundController::class);
    }
}
