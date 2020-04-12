<?php

class LoginModel
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
        } else return True;
    }

    public function getRegister($username, $password, $name, $email, $id)
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
            //check password
            if ($this->checkPassword($password) == False) return False;

            // register new user
            if ($id == NULL) {
                $insStmt = $this->conn->prepare('INSERT INTO users (username, password, name, email) VALUES(?,?,?,?)');
                $insStmt->bind_param('ssss', $username, $password, $name, $email);
            } else {
                $insStmt = $this->conn->prepare('INSERT INTO users (username, password, name, email, id_comp) VALUES(?,?,?,?,?)');
                $insStmt->bind_param('ssssi', $username, $password, $name, $email, $id);
            }

            $insStmt->execute();
            $insStmt->close();

            return True;
        }
    }

    public function checkPassword($password)
    {
        $ret = True;

        if (strlen($password) < 6) {
            array_push($this->errors, "Password too short! Use at least 6 characters.");
            $ret = False;
        }

        if (!preg_match("#[0-9]+#", $password)) {
            array_push($this->errors, "Password must include at least one number!");
            $ret = False;
        }

        if (!preg_match("#[a-zA-Z]+#", $password)) {
            array_push($this->errors, "Password must include at least one letter!");
            $ret = False;
        }

        return $ret;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
