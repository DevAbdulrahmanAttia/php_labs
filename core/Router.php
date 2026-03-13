<?php

namespace Core;

class Router
{
    private array $routes = [];

    public function register(string $route, array $handler): void
    {
        $this->routes[$route] = $handler;
    }

    public function dispatch(string $route): void
    {
        if (!isset($this->routes[$route])) {
            http_response_code(404);
            echo '<h2>404 — Page not found</h2>';
            return;
        }

        [$controllerClass, $method] = $this->routes[$route];
        $controller = new $controllerClass();
        $controller->$method();
    }
}
