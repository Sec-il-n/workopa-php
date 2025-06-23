<?php
use Framework\Database;
$config = require basePath('config/db.php');
// var_dump($config);
$db = new Database($config);
$listings = $db->query('SELECT * FROM listings LIMIT 6')->fetchAll();
// inspect($listings);
loadView('home', [
    'listings' => $listings
    ]
);
