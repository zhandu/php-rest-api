<?php
namespace App;

use FastRoute;

class Router {
    private $routes;
    private $dispatcher;

    public function __construct() {
        $this->routes = require __DIR__ . '/routes/routes.inc.php';
        $this->dispatcher = FastRoute\simpleDispatcher($this->routes);
    }

    public function dispatcher($httpMethod, $uri) {
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $routeInfo = $this->dispatcher->dispatch($httpMethod, rawurldecode($uri));

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                header("HTTP/1.1 404 Not Found");
                die();
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                header("HTTP/1.1 405 Method Not Allowed");
                die();
            case FastRoute\Dispatcher::FOUND:
                $handler = explode('::', $routeInfo[1]);
                $controller = new $handler[0];
                $method = $handler[1];
                $vars = $routeInfo[2];
                call_user_func_array([$controller, $method], $vars);
                break;
        }
    }
}
?>