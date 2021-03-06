<?php

class LoginModel
{
    private $conn;
    private $errors = [];

    public function __construct()
    {
        require_once('Database.php');
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

    public function getUserId($username)
    {
        $query = "Select id from users where username = ?";
        $getStmt = $this->conn->prepare($query);
        $getStmt->bind_param("s", $username);
        $getStmt->execute();
        $id = mysqli_fetch_assoc($getStmt->get_result())['id'];
        $getStmt->close();
        return $id;
    }

    public function getRegister($username, $password, $name, $email, $id_comp)
    {
        // check if username or email does not already exist in db
        if (!$this->checkUsername($username)) {
            array_push($this->errors, "Username already exists");
        } else if (!$this->checkEmail($email)) {
            array_push($this->errors, "Email already exists");
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

    public function checkUsername($username)
    {
        $getStmt = $this->conn->prepare('SELECT * FROM users where username=? LIMIT 1');
        $getStmt->bind_param('s', $username);

        $getStmt->execute();
        $res = $getStmt->get_result();
        $getStmt->close();

        if ($res->num_rows != 0) {
            return False;
        }

        return true;
    }

    public function checkEmail($email)
    {
        $getStmt = $this->conn->prepare('SELECT * FROM users where email=? LIMIT 1');
        $getStmt->bind_param('s', $email);

        $getStmt->execute();
        $res = $getStmt->get_result();
        $getStmt->close();

        if ($res->num_rows != 0) {
            return False;
        }

        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function insertToken($email, $token)
    {
        $this->cleanUpTokens(); // remove expired tokens

        $insStmt = $this->conn->prepare('INSERT INTO tokens VALUES(?, ?, now() + INTERVAL 1 HOUR)');
        $insStmt->bind_param('ss', $email, $token);
        $insStmt->execute();
        $insStmt->close();
    }

    public function checkToken($email, $token)
    {
        $getStmt = $this->conn->prepare('SELECT * FROM tokens where token=? and email=? LIMIT 1');
        $getStmt->bind_param('ss', $token, $email);

        $getStmt->execute();
        $res = $getStmt->get_result();
        $getStmt->close();

        if ($res->num_rows != 0) {
            return true;
        }

        return false;
    }

    public function cleanUpTokens()
    {
        $delStmt = $this->conn->prepare('DELETE FROM tokens WHERE expire_date < NOW()');
        $delStmt->execute();
        $delStmt->close();
    }

    public function updatePassword($email, $password)
    {
        $updateStmt = $this->conn->prepare('UPDATE users SET password=? WHERE email=?');
        $updateStmt->bind_param('ss', $password, $email);
        $updateStmt->execute();
        $updateStmt->close();
    }
}