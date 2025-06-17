<?php
$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'];//cf. This is from user input!!
$params = [
    'id' => $id
];
// $listings = $db->query('SELECT * FROM listings WHERE id =' . $id)->fetch();//not FetchAll coz it's a 1 recode
$listings = $db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
loadView('listings/show');
?>




