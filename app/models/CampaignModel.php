<?php

class CampaignModel {
    private $conn;
    //TODO: treat error and succes messages and send them to the user;
    
    public function __construct(){
        $CONFIG = [
            'servername' => "localhost",
            'username' => "root",
            'password' => '',
            'db' => 'proiect_tw'
        ];
        
        $this->conn = new mysqli($CONFIG["servername"], $CONFIG["username"], $CONFIG["password"], $CONFIG["db"]);

        if ($this->conn->connect_error) {
            die("Connection to the database failed: " . $this->conn->connect_error);
        } else { 
            // echo "Successfully connected to DB";
        }

    }

    public function insertCampaign($title, $description, $location, $date, $image = 'default.jpg'){
        
        $query = "insert into campaigns(title, description, event_date, image_name, location) values (?, ?, ?, ?, ?)";    
        $banner_image_uploaded = true;
        
        if($image != 'default.jpg'){
            $banner_image_uploaded = false;
            $place_to_upload = "../public/assets/images/uploads/" . basename($_FILES["banner"]["name"]);
            $imageType = strtolower(pathinfo($place_to_upload, PATHINFO_EXTENSION));
            $up = true;
            if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"){
                echo "Only jpg, png, and jpeg are allowed";
                $up = false;
            }
            if ($_FILES["banner"]["size"] > 10000000) {
                // echo "File too large";
                $up = false;
            }
            if($up){
                if(move_uploaded_file($_FILES["banner"]["tmp_name"], $place_to_upload)){
                    // echo "Uploaded banner image";
                    $banner_image_uploaded = true;
                }
            }
        }
        if($banner_image_uploaded == false){
            echo "Failed to upload image...";
        }else{
            //uploading the rest of content to the database
            $insert_stmt = $this->conn->prepare($query);
            $insert_stmt->bind_param("sssss", $title, $description, $date, $image, $location);
            if($insert_stmt->execute()){
                // echo "Campaign created succesfully";
            }else{
                echo "Failed to create campaign: " . $insert_stmt->error;
            }
            $insert_stmt->close();
        }
    }

    public function getAllCampaigns(){
        $query = "select * from campaigns order by event_date";
        $get_stmt = $this->conn->prepare($query);
        if(!$get_stmt->execute()){
            echo "Error" . $get_stmt->error;
            return;
        }

        return $get_stmt->get_result();
    }

    public function getCampaignById($id){
        $query = "select * from campaigns where id = ?";
        $get_stmt = $this->conn->prepare($query);
        $get_stmt->bind_param("i", $id);
        if(!$get_stmt->execute()){
            echo "Error" . $get_stmt->error;
            return;
        }
        return $get_stmt->get_result()->fetch_array();
    }


}