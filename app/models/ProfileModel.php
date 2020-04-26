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

    public function changePhoto($username, $name)
    {
        $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
      
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
      
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
       
           // Insert record
           $query = "insert into images(name) values('".$name."')";
           mysqli_query($con,$query);
        
           // Upload file
           move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
      
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
