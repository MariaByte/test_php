<?php
    class Database 
    {
        private $host = 'localhost';
        private $username = 'admin';
        private $password = 'admin';
        private $dbname = 'test_app';
        public $conn;
        private $err;
        private static $instance = null;

        public function __construct()
        {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            try{
                $this->conn = new PDO($dsn, $this->username, $this->password);
            } catch(PDOException $e){
                $this->err = $e->getMessage();
                echo $this->err;
            }
        }

        public static function getInstance()
        {
            if (self::$instance == null) {
                self::$instance = new Database();
            }
            return self::$instance;
        }
    }