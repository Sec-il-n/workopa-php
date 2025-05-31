<?php
require '../helpers.php';
// require '../views/home.view.php';
// require basePath('views/home.view.php');
// loadView('home');

$routes = [
    // '/workopia/public/' => 'controllers/home.php',
    '/' => 'controllers/home.php',
    '/listings' => 'controllers/listings/index.php',
    '/listings/create' => 'controllers/listings/create/create.php',
    '404' => 'controllers/error/404.php'
];


$uri = $_SERVER['REQUEST_URI'];
// inspectAndDie($uri);
inspect($uri);
inspect($routes[$uri]);
if (array_key_exists($uri, $routes)) {
    require(basePath($routes[$uri]));
} else {
    require(basePath($routes['404']));
}


?>