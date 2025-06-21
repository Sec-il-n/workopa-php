<?php
require '../helpers.php';
// require basePath('Framework/Router.php');
// require basePath('Framework/Database.php');
spl_autoload_register(function($class){
    $path = basepath('Framework/' . $class . '.php');
    if(file_exists($path)){
        require $path;
    }
});

// Instantiating router
$router = new Router();

// Get routes
require basePath('routes.php');

// Get current URI and HttpMethod
// $uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// inspectAndDie($uri);
$method = $_SERVER['REQUEST_METHOD'];
// inspect($uri);
// inspect($method);

// route the request
$router->route($uri,$method);
?>