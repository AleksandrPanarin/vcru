<?php

namespace App;

use App\System\Request;
use FastRoute\Dispatcher;

class Kernel
{
    private $routes;
    private $uri;
    private $httpMethod;

    public function __construct()
    {
        $this->routes = include_once ROOT_DIR . '/config/routes.php';
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];

        $uri = $_SERVER['REQUEST_URI'];
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $this->uri = rawurldecode($uri);
    }

    public function run(): void
    {
        $routeInfo = $this->routes->dispatch($this->httpMethod, $this->uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $vars = array_merge($vars, ['request' => new Request()]);
                if (is_callable([$handler['class'], $handler['method']])) {
                    echo call_user_func_array([new $handler['class'], $handler['method']], $vars);
                    break;
                }
                throw new \Exception(
                    'Can`t call class`s method: ' .
                    implode('::', [$handler['class'], $handler['method']])
                );
            default:
                header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
                break;
        }
    }
}