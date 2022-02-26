<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$router = new App\Router();
$router->dispatcher($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
?>