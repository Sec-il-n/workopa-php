<?php
require '../helpers.php';
require __DIR__ . '/../vendor/autoload.php';
use Framework\Router;//new Framework\Router()と同義

// require basePath('Framework/Router.php');
// require basePath('Framework/Database.php');
// spl_autoload_register(function($class){
//     $path = basepath('Framework/' . $class . '.php');
//     if(file_exists($path)){
//         require $path;
//     }
// });

// Instantiating router
$router = new Router();

// Get routes
require basePath('routes.php');

// Get current URI and HttpMethod
// $uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $method = $_SERVER['REQUEST_METHOD'];
//←（？）のち、削除編集の際hiddenファイルとマッチさせる必要がある場合に役立つ（Router.phpに移動）


// route the request
// $router->route($uri,$method);
$router->route($uri);
?>