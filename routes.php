<?php
// return [
//     // '/workopia/public/' => 'controllers/home.php',
//     '/' => 'controllers/home.php',
//     '/listings' => 'controllers/listings/index.php',
//     '/listings/create' => 'controllers/listings/create.php',
//     '/404' => 'controllers/error/404.php'
// ];

// $router->get('/','controllers/home.php');
$router->get('/','HomeController@index');
// $router->get('/listings','controllers/listings/index.php');
$router->get('/listings','ListingController@index');
// $router->get('/listings/create','controllers/listings/create.php');
$router->get('/listings/create','ListingController@create');
// $router->get('/listing','controllers/listings/show.php');
$router->get('/listing/{id}','ListingController@show');

$router->post('/listings','ListingController@store');

