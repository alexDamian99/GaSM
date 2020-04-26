<?php

class ProfileModel
{
    private $conn;
    private $errors = [];
    private $success = [];

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

    public function changeEmail($username, $email)
    {
        $getStmt = $this->conn->prepare('SELECT id FROM users where username=?');
        $getStmt->bind_param('s', $username);

        $getStmt->execute();
        $res = $getStmt->get_result(); // no of rows returned
        $getStmt->close();
        
        if ($res->num_rows != 0) {
            array_push($this->errors, "Email already in use!");
            return False;
        }
        
        $getStmt = $this->conn->prepare('UPDATE users(email) set email=? where username=?');
        $getStmt->bind_param('ss', $email, $username);

        $getStmt->execute();
        $getStmt->close();
        array_push($this->success, "Email changed!");
        return TRUE;
    }

    public function changeName($username, $name)
    {
        $getStmt = $this->conn->prepare('UPDATE users(name) set name=? where username=?');
        $getStmt->bind_param('ss', $name, $username);

        $getStmt->execute();
        $getStmt->close();
        array_push($this->success, "Name changed!");
    }

    public function getErrors()
    {
        return $this->errors;
    }
    public function getSuccess()
    {
        return $this->success;
    }
}
