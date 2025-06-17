<?php
require '../helpers.php';
require basePath('Router.php');
require basePath('Database.php');
// $config = require basePath('config/db.php');
// var_dump($config);
// $db = new Database($config);

// Instantiating router
$router = new Router();

// Get routes
require basePath('routes.php');

// Get current URI and HttpMethod
// $uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// inspectAndDie($uri);
$method = $_SERVER['REQUEST_METHOD'];
inspect($uri);
inspect($method);

// route the request
$router->route($uri,$method);
?>