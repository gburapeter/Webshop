<?php



class DB {
    public PDO $conn;
    private static DB $instance;

    private function __construct() {
        require_once "../app/db_credentials.php";
        $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {

        if(!isset(self::$instance)) {
            self::$instance = new DB();
        }

        return self::$instance;
    }
}