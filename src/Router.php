<?php
/**
 * Файл роутера
 * @version 1.0
 */

namespace Sergey\Router;

use Sergey\Framework\Interfaces\RouteInterface;

/**
 * Класс роутер, выполняет подключение страниц
 * @author Sergey00708
 * @package Router
 */
class Router implements RouteInterface
{
    /**
     * @var array
     */
    public $routes = [];

    /**
     * @param string $path
     * @param $action
     * @return void
     */
    public function addRoute(string $path, $action)
    {
        $path = trim($path, '/');
        $this->routes[$path] = $action;
    }

    /**
     * @param string $uri
     * @return callable
     */
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

