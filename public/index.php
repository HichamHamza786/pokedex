<?php

require_once __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath($_SERVER['BASE_URI']);

$router->map('GET', '/', 'MainController#list', 'home');
$router->map('GET', '/details/[i:numero]', 'MainController#details', 'details');
$router->map('GET', '/types', 'MainController#types', 'types');
$router->map('GET', '/type/[i:type]', 'MainController#type', 'type');

$match = $router->match();

