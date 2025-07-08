<?php
namespace App\Controllers;
// PSR-4(auto roader)＝Controllerをequireしなくてもよい
use Framework\Database;

class HomeController {
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }
    
    public function index(){
       $listings = $this->db->query('SELECT * FROM listings LIMIT 6')->fetchAll();
        loadView('home', [
            'listings' => $listings
        ]);
    }
}