<?php

class LoginModel
{
    private $conn;
    private $errors = [];

    public function __construct()
    {
        require_once 'Database.php';
        $this->conn = Database::getInstance()->getConn();
    }

    public function getLogin($username, $password)
    {
        $getStmt = $this->conn->prepare('SELECT id FROM users where username=? and password=?');
        $getStmt->bind_param('ss', $username, $password);

        $getStmt->execute();
        $res = $getStmt->get_result()->num_rows; // no of rows returned
        $getStmt->close();

        if ($res == 0) {
            array_push($this->errors, "Wrong username/password combination");
            return False;
        } else
            return True;
    }

    public function getIdComp($username)
    {
        $getStmt = $this->conn->prepare('SELECT id_comp FROM users where username=?');
        $getStmt->bind_param('s', $username);

        $getStmt->execute();
        $id_comp = mysqli_fetch_assoc($getStmt->get_result())['id_comp'];
        $getStmt->close();

        return $id_comp;
    }

    public function getRegister($username, $password, $name, $email, $id_comp)
    {
        // check if username or email does not already exist in db
        $getStmt = $this->conn->prepare('SELECT * FROM users where username=? or email=? LIMIT 1');
        $getStmt->bind_param('ss', $username, $email);

        $getStmt->execute();
        $res = $getStmt->get_result();
        $getStmt->close();

        if ($res->num_rows != 0) { // username or email already exists 
            $user = mysqli_fetch_assoc($res);
            if ($user['username'] == $username) {
                array_push($this->errors, "Username already exists");
            }

            if ($user['email'] == $email) {
                array_push($this->errors, "Email already exists");
            }
            return False;
        } else {
            // register new user
            if ($id_comp == NULL) {
                $insStmt = $this->conn->prepare('INSERT INTO users (username, password, name, email) VALUES(?,?,?,?)');
                $insStmt->bind_param('ssss', $username, $password, $name, $email);
            } else {
                $insStmt = $this->conn->prepare('INSERT INTO users (username, password, name, email, id_comp) VALUES(?,?,?,?,?)');
                $insStmt->bind_param('ssssi', $username, $password, $name, $email, $id_comp);
            }

            $insStmt->execute();
            $insStmt->close();

            return True;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
