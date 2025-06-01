<?php
$routes = require basePath('routes.php');
inspect($routes[$uri]);
if (array_key_exists($uri, $routes)) {
    require(basePath($routes[$uri]));
} else {
    http_response_code(404);
    require(basePath($routes['404']));
}