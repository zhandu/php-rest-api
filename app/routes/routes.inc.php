<?php
function getRouteGroupPath($groupName) {
    return __DIR__ . "/groups/$groupName.inc.php";
}

return function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '[/]', 'App\\Controllers\\HomeController::index');
    $r->addGroup('/users', require getRouteGroupPath('users'));
}
?>