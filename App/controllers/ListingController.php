<?php
namespace App\Controllers;
// PSR-4(auto roader)＝Controllerをequireしなくてもよい
use Framework\Database;

class ListingController {
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     *  all listingsshow
     *
     * @return void
     */
    public function index(){
       $listings = $this->db->query('SELECT * FROM listings')->fetchAll();
        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

    /**
     * show the create listing form
     *
     * @return void
     */
    public function create () {
        loadView('listings/create');
    }

    /**
     * show a single listing
     *
     * @return void
     */
    // public function show () {
    public function show ($params) {
        // $id = $_GET['id'] ?? '';
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // Check if listing exisits
        if (!$listing) {
            ErrorController::notFound('Listing not found.');
            return;
        }
        loadView('listings/show', [
            'listing' => $listing
        ]);
    }
}