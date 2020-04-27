<?php
require_once 'Database.php';

class ProfileModel
{
    private $conn;
    private $errors = [];
    private $success = [];

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConn();
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
        $target_file = $target_dir . $_FILES["input_file"]["name"];
      
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png");
      
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            // Insert record
            $insertStmt = $this->conn->prepare('UPDATE users set photo=? where username=?');
            $insertStmt->bind_param('ss', $file_name, $username);

            $insertStmt->execute();
            $insertStmt->close();

            // Upload file
            move_uploaded_file($_FILES['input_file']['tmp_name'], $target_file);
            array_push($this->success, "Profile photo changed!");

        }
        return True;
    }

    public function getActiveReportsFor($username)
    {
        $activeReports = [];
        $stmt = $this->conn->prepare('SELECT * FROM reports where username=?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                array_push(
                    $activeReports,
                    ['id' => $row['id'], 'type' => $row['type'], 'location' => $row['location'], 'date' => $row['date'], 'user' => $row['user']]
                );
            }
        }
        $stmt->close();
        return $activeReports;
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
