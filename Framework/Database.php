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
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            // ↑　home.view.php の「[]」を「->」に変更すると使える
        ];

        try {
            $this-> conn = new PDO($sdn, $config['username'], $config['password'], $options);
            echo 'connected';
        } catch (PDOException $e){
            throw new Exception("database connection faild: {$e->getMessage()}");
        }
        
    }

     /**
     * Query the database
     * 
     * @param string $query
     * 
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $params = []) {
        try {
            $sth = $this->conn->prepare($query);

            // Bind Params
            foreach ($params as $param => $value) {
                $sth->bindValue(':' . $param, $value);
            }
            $sth->execute();
            return $sth;

        } catch (PDOException $e) {
            throw new Exception("Query faild execute: {$e->getMessage()}");
        }
    }
}
