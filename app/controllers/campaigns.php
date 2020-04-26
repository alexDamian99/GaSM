<?php

class Campaigns extends Controller{
    public function index($params = '') {
        $view = 'campaigns/campaigns';
        $this->view($view);
    }
    public function id($params = ''){
        if(empty($params)){
            $view = '404';
            $this->view($view);
        }else{
            $view = 'campaigns/campaign';
            //TODO: search a campaign by $params title
            
            $this->view($view);
        }
    }
    public function add($params = ''){
        
        if(isset($_POST['submit'])){
            
            if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['location']) && isset($_POST['date'])){
                if(preg_match("/[A-Za-z0-9-_ ]{1,255}$/", $_POST['title']) && preg_match("/[A-Za-z0-9-_ ]{1,255}$/", $_POST['location'])){
                    //require_once('db_connect.php'); TODO: WE CAN ADD A CONFIG FILE
                    //todo: add a model here
                    echo "do some stuff";

                    
                }
                else{
                    echo "invalid title or location";
                }
            }
            else{
                echo "Missing required fields";
            }


        }
        $view = 'campaigns/add_campaign';
        $this->view($view);
    }
}