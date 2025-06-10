<?php 
class Database{
    public $conn;

    /**
     * Constructor for Datbase Class
     * 
     * @param array $config
     */
    public function __construct($config){
        $sdn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
    
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this-> conn = new PDO($sdn, $config['username'], $config['password']);
            echo 'connected';
        } catch (PDOException $e){
            throw new Exception("database connection faild: {$e->getMessage()}");
        }
        
    }
}
