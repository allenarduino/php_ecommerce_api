<?php 
    class Database {
        private $host = "localhost";
        private $database_name = "merllon_mall";
        private $username = "root";
        private $password = "";

        public $conn;

        public function connect(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected";
            }
            return $this->conn;
        }
    }  
?>