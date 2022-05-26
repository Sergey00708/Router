<?php

namespace Sergey\Router;

use Sergey\Framework\Interfaces\RouteInterface;


class Router implements RouteInterface
{

    public $routes = [];

    public function addRoute(string $path, $action)
    {
        $path = trim($path, '/');
        $this->routes[$path] = $action;
    }

    public function route(string $uri): callable
    {
        $uri = trim($uri, '/');
        $action = $this->routes[$uri];
        $controllerName = $action[0];
        return function () use ($controllerName, $action)
        {
            $controller_obj = new $controllerName();
            $method = $action[1];
            $controller_obj->$method();
        };
    }
}

