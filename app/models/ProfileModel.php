<?php
require_once('Database.php');
require('../vendor/autoload.php');

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

        $extension = $_FILES['input_file']['type'];
        $extension = explode("/", $extension)[1];
        $filename = uniqid("user_photo_", true) . ".$extension";
        
        
        $extensions_arr = array("jpg","jpeg","png");
      
        // Check extension
        if( in_array($extension, $extensions_arr) ){
            // Insert record
            $s3 = new Aws\S3\S3Client([
                'region'  => 'eu-central-1',
                'version' => 'latest',
                'credentials' => [
                    'key'    => getenv('AWS_ACCESS_KEY_ID'),
                    'secret' => getenv('AWS_SECRET_KEY'),
                ]
            ]);	
            $bucket = getenv('S3_BUCKET_NAME');
            $s3->upload($bucket, $filename, fopen($_FILES['input_file']['tmp_name'], 'rb'), 'public-read');

            $insertStmt = $this->conn->prepare('UPDATE users set photo=? where username=?');
            $insertStmt->bind_param('ss', $filename, $username);

            $insertStmt->execute();
            $insertStmt->close();
            
            // Upload file
            // move_uploaded_file($_FILES['input_file']['tmp_name'], $target_file);
            array_push($this->success, "Profile photo changed!");
            $_SESSION["profile_photo"] = "https://proiect-tw-gasm.s3.eu-central-1.amazonaws.com/" . $filename;
        }
        return True;
    }

    public function getActiveReportsFor($username)
    {
        $activeReports = [];
        $stmt = $this->conn->prepare('SELECT * FROM reports where user=?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $res = $stmt->get_result(); 
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push(
                    $activeReports,
                    ['id' => $row['id'], 'type' => $row['type'], 'location' => $row['location'], 'date' => $row['date'], 'user' => $row['user']]
                );
            }
        }
        $stmt->close();
        return $activeReports;
    }

    public function getActiveCampaignsFor($username)
    {
        $activeEvents = [];
        $stmt= $this->conn->prepare("Select * from users where username like ?");
        $stmt->bind_param("s", $_SESSION["username"]);
        $stmt->execute();
        $user_id = mysqli_fetch_assoc($stmt->get_result())['id'];

        $stmt = $this->conn->prepare('SELECT * FROM campaigns where user_id=?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $res = $stmt->get_result(); 
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push(
                    $activeEvents,
                    ['id' => $row['id'], 'title' => $row['title'], 'description' => $row['description'], 'location' => $row['location'], 'event_date' => $row['event_date'], 'image_name' => $row['image_name']]
                );
            }
        }
        $stmt->close();
        return $activeEvents;
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
    
    public function countUsers() {
        $query = "select count(*) from users";
        $get_stmt = $this->conn->prepare($query);
        $get_stmt->execute();
        $result = mysqli_fetch_array($get_stmt->get_result())[0];
        $get_stmt->close();
        return $result;
    }

    public function getNUsers($offset, $length=9) {
        $query = "select id, username, name, email, id_comp, photo 
                    from users order by id desc limit $offset, $length";
        $get_stmt = $this->conn->prepare($query);
        if(!$get_stmt->execute()){
            array_push($this->errors, $get_stmt->error);
            return;
        }
        $found_users = $get_stmt->get_result();
        $results = [];
        foreach ($found_users as $u) {
            $results[] = $u;
        }
        $get_stmt->close();
        return $results;
    }

    public function deleteUser($id) {
        $delete_stmt = $this->conn->prepare('delete from users where id = ?');
        $delete_stmt->bind_param("i", $id);
        if(!$delete_stmt->execute()) {
            array_push($this->errors, $delete_stmt->error);
            echo $delete_stmt->error;
            $delete_stmt->close();
            return false;
        }
        $delete_stmt->close();
        return true;
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
