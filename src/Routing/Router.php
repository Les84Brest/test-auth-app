<?

declare(strict_types=1);

namespace TestApp\Routing;

use TestApp\Api\RouterInterface;
use TestApp\Api\ActionInterface;
use TestApp\Api\RequestInterface;

class Router implements RouterInterface
{
    const HTTP_GET = 'GET';
    const HTTP_POST = 'POST';
    private string $pageNotFound;

    public function __construct(private array $routes = [])
    {
    }
    /**
     * handling get path
     */
    public function get(string $path, string $callback): void
    {
        $this->routes[self::HTTP_GET][$path] = $callback;
    }

    /**
     * handling post path
     */
    public function post(string $path, string $callback): void
    {
        $this->routes[self::HTTP_POST][$path] = $callback;
    }


    public function dispatch(RequestInterface $request): ActionInterface
    {
        $path = $request->getPath();
        $method = $request->getMethod();

        $callback = $this->routes[$method][$path] ?? $this->pageNotFound;

        return new $callback();
    }

    public function pageNotFound(string $callback): void
    {
        $this->pageNotFound = $callback;
    }
}
