<?php

class StatisticsModel
{
    private $conn;
    private $errors = [];

    public function __construct()
    {
        require_once 'Database.php';
        $this->conn = Database::getInstance()->getConn();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
