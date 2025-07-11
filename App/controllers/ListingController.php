<?php
namespace App\Controllers;
// PSR-4(auto roader)＝Controllerをequireしなくてもよい
use Framework\Database;
use Framework\Validation;


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
        // inspectAndDie(Validation::email('44@ttt.com'));

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

    /**
     * Store data in database
     * 
     * @return void
     */
    public function store () {
        $allowedFields = [
            'title', 'description', 
            'salary', 'requirements', 'benefits', 
            'company', 'address', 'city', 
            'state', 'phone', 'email'
        ];

        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

        $newListingData['user_id'] = 1;

        $newListingData = array_map('sanitize', $newListingData);
        inspectAndDie($newListingData);
    }
}