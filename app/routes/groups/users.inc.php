<?php
return function(FastRoute\RouteCollector $r) {
    $r->addRoute('POST', '[/]', 'App\\Controllers\\UserController::add');
    $r->addRoute('GET', '[/]', 'App\\Controllers\\UserController::getAll');
    $r->addRoute('GET', '/{id:[1-9]\d*}', 'App\\Controllers\\UserController::get');
    $r->addRoute('DELETE', '/{id:[1-9]\d*}', 'App\\Controllers\\UserController::delete');
}
?>