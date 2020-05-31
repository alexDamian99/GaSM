<?php
require('../vendor/autoload.php');

class CampaignModel {
    private $conn;
    private $errors = [];
    public function __construct() {
        require_once('Database.php');
        $this->conn = Database::getInstance()->getConn();
    }

    public function insertCampaign($title, $description, $location, $date, $image = 'default.jpg') {
        $query = "insert into campaigns(user_id, title, description, event_date, image_name, location) values (?, ?, ?, ?, ?, ?)";    
        $banner_image_uploaded = true;
        $filename = 'default.jpg';
        if($image != 'default.jpg'){
        
            $banner_image_uploaded = false;
            $up = true;
            
            $extension = $_FILES['banner']['type'];
            $extension = explode("/", $extension)[1];
        
            if(!in_array($extension, ["jpg", "png", "jpeg", "gif"])) {
                array_push($this->errors, "Invalid image type. Please upload only jpg, jpeg, png, gif");
                $up = false;
            }
        
            if(getimagesize($_FILES['banner']['tmp_name']) === false) {
                array_push($this->errors, "Not an image");
                $up = false;
            }
        
            $filename = uniqid("image_", true) . ".$extension";
        
            if ($_FILES["banner"]["size"] > 10000000) {
                array_push($this->errors, "File too large");
                $up = false;
            }
            if($up){
                $s3 = new Aws\S3\S3Client([
                    'region'  => 'eu-central-1',
                    'version' => 'latest',
                    'credentials' => [
                        'key'    => getenv('AWS_ACCESS_KEY_ID'),
                        'secret' => getenv('AWS_SECRET_KEY'),
                    ]
                ]);	
                $bucket = getenv('S3_BUCKET_NAME');
                if(isset($bucket) && !empty($bucket)){
                    $upload = $s3->upload($bucket, $filename, fopen($_FILES['banner']['tmp_name'], 'rb'), 'public-read');
                    $banner_image_uploaded = true;
                }
                else {
                    array_push($this->errors, "Failed to load bucket");
                    $banner_image_uploaded = false;
                }
            }
        }
        if($banner_image_uploaded == false){
            array_push($this->errors, "Failed to upload banner image");
        }else{
            //uploading the rest of content to the database
            $insert_stmt = $this->conn->prepare($query);

            $stmt= $this->conn->prepare("Select * from users where username like ?");
            $stmt->bind_param("s", $_SESSION["username"]);
            $stmt->execute();
            $user_id = mysqli_fetch_assoc($stmt->get_result())['id'];

            $insert_stmt->bind_param("isssss", $user_id, $title, $description, $date, $filename, $location);
            if(!$insert_stmt->execute()){
                array_push($this->errors, "Failed to create campaign: " . $insert_stmt->error);
            }
            $insert_stmt->close();
        }
    }

    public function getNCampaigns($offset, $length=9) {
        $query = "select * from campaigns order by event_date desc limit $offset, $length";
        $get_stmt = $this->conn->prepare($query);
        if(!$get_stmt->execute()){
            array_push($this->errors, $get_stmt->error);
            return;
        }
        $found_campaigns = $get_stmt->get_result();
        $results = [];
        foreach ($found_campaigns as $c) {
            $results[] = $c;
        }
        return $results;
    }

    public function countCampaigns() {
        $query = "select count(*) from campaigns";
        $get_stmt = $this->conn->prepare($query);
        $get_stmt->execute();
        return mysqli_fetch_array($get_stmt->get_result())[0];
    }

    public function searchCampaigns($key) {
        $found_campaigns = [];
        $campaigns = $this->getNCampaigns(0, $this->countCampaigns());
        foreach ($campaigns as $campaign) {
            if(stripos($campaign['title'], $key) !== false || stripos($campaign['description'], $key) !== false) {
                $found_campaigns[] = $campaign;
            }
        }
        return $found_campaigns;
    }

    public function getCampaignById($id) {
        $query = "select * from campaigns where id = ?";
        $get_stmt = $this->conn->prepare($query);
        $get_stmt->bind_param("i", $id);
        if(!$get_stmt->execute()) {
            array_push($this->errors, $get_stmt->error);
            return;
        }
        return mysqli_fetch_assoc($get_stmt->get_result());
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getUserById($user_id) {
        $getStmt = $this->conn->prepare('SELECT * FROM users where id=?');
        $getStmt->bind_param('i', $user_id);
        $getStmt->execute();
        $user = mysqli_fetch_assoc($getStmt->get_result());
        return $user;
    }

}