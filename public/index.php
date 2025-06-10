<?php
require '../helpers.php';
require basePath('Database.php');
$config = require basePath('config/db.php');
var_dump($config);
$db = new Database($config);

require basePath('Router.php');
$router = new Router();

require basePath('routes.php');
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
inspect($uri);
inspect($method);

$router->route($uri,$method);
?>