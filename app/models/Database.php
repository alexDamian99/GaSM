<?php

class Database
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $CONFIG = [
            'servername' => "localhost",
            'username' => "root",
            'password' => '',
            'db' => 'gasm'
        ];
        
        $this->conn = new mysqli($CONFIG["servername"], $CONFIG["username"], $CONFIG["password"], $CONFIG["db"]);
        // $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

        // $server = $url["host"];
        // $username = $url["user"];
        // $password = $url["pass"];
        // $db = substr($url["path"], 1);

        // $this->conn = new mysqli($server, $username, $password, $db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConn()
    {
        return $this->conn;
    }
}


