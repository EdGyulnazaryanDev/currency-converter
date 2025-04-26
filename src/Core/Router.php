<?php
namespace CurrencyService\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, array $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve(Request $request)
    {
        $path = $request->getPath();
        $method = $request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        $controller = new $callback[0]();
        $method = $callback[1];
        return $controller->$method($request);
    }
}