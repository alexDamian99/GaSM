<?php

class StatisticsModel
{
    private $conn;
    private $errors = [];

    public function __construct()
    {
        $CONFIG = [
            'servername' => "localhost",
            'username' => "root",
            'password' => '',
            'db' => 'gasm'
        ];

        $this->conn = new mysqli($CONFIG["servername"], $CONFIG["username"], $CONFIG["password"], $CONFIG["db"]);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
