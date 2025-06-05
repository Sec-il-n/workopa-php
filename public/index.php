<?php
require '../helpers.php';

require basePath('Router.php');
$router = new Router();

require basePath('routes.php');
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
inspect($uri);
inspect($method);

$router->route($uri,$method);
?>