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
        $updateStmt = $this->conn->prepare('UPDATE users set address=? where username=?');
        $updateStmt->bind_param('ss', $address, $username);

        $updateStmt->execute();
        $updateStmt->close();
        array_push($this->success, "Adress changed!");
        return True;
    }

    public function changePhoto($username)
    {
        $file_name = $_FILES['input_file']['name'];
        $target_dir = "assets/images/upload/";
        $target_file = $target_dir . basename($_FILES["input_file"]["name"]);
      
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png");
      
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            $_SESSION['debug'] = $imageFileType;
            # TODO aici recunoaste, dar la linia 85 face poc? nu inteleg de ce nu ar merge prepare-ul.
            // Insert record
            $insertStmt = $this->conn->prepare('INSERT into users (photo) values (?) where username=?');
            $insertStmt->bind_param('ss', $file_name, $username);
            
            $insertStmt->execute();
            $insertStmt->close();
        
           // Upload file
           move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$file_name);
      
        }
        return True;
    }

    public function getPhoto($username)
    {
        $getStmt = $this->conn->prepare('SELECT photo from users where username=?');
        $getStmt->bind_param('s', $username);

        $getStmt->execute();
        $res = $getStmt->get_result(); 
        $getStmt->close();

        if ($res->num_rows == 0) {
            array_push($this->errors, "No profile photo");
            return False;
        }
        $row = mysqli_fetch_array($res);
        $image = $row[0];
        return $image;
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
