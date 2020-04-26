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
        $getStmt = $this->conn->prepare('SELECT id FROM users where email=?');
        $getStmt->bind_param('s', $email);
        $getStmt->execute();
        $res = $getStmt->get_result(); 
        $getStmt->close();
        if ($res->num_rows != 0) {
            array_push($this->errors, "Email already in use!");
            return False;
        }
        
        $getStmt = $this->conn->prepare('UPDATE users set email=? where username=?');
        $getStmt->bind_param('ss', $email, $username);

        $getStmt->execute();
        $getStmt->close();
        array_push($this->success, "Email changed!");
        return TRUE;
    }

    public function changeName($username, $name)
    {
        $getStmt = $this->conn->prepare('UPDATE users set name=? where username=?');
        $getStmt->bind_param('ss', $name, $username);

        $getStmt->execute();
        $getStmt->close();
        array_push($this->success, "Name changed!");
        return True;
    }

    public function changeAddress($username, $address)
    {
        $getStmt = $this->conn->prepare('UPDATE users set address=? where username=?');
        $getStmt->bind_param('ss', $address, $username);

        $getStmt->execute();
        $getStmt->close();
        array_push($this->success, "Adress changed!");
        return True;
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
