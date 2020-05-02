<?php

class Campaigns extends Controller{
    private $model;
    public function __construct(){
        $this->model = $this->model("CampaignModel");
    }
    public function index($params = '') {
        $view = 'campaigns/campaigns';
        $this->view($view, $this->model->getAllCampaigns());
    }
    public function id($params = ''){
        if(empty($params)){
            $view = '404';
            $this->view($view);
        }else{
            $view = 'campaigns/campaign';
            
            $campaign_info = $this->model->getCampaignById($params[0]);
            if(empty($campaign_info)){//if the id is wrong
                $this->view('404');
            }else{
                $this->view($view, $campaign_info);
            }
            
        }
    }
    public function add($params = ''){
        if(isset($_POST['submit'])){
            
            if(isset($_POST['title']) && isset($_POST['description'])){
                if(preg_match("/[A-Za-z0-9-_ ]{1,255}$/", $_POST['title'])){
                    if(isset($_FILES['banner']) && $_FILES['banner']['size'] != 0){
                        $this->model->insertCampaign($_POST['title'], $_POST['description'], $_POST['location'], $_POST['date'], $_FILES["banner"]["name"]);
                    }
                    else{
                        $this->model->insertCampaign($_POST['title'], $_POST['description'], $_POST['location'], $_POST['date']);
                    }
                }
                else{
                    // echo "invalid title or location";
                }
            }
            else{
                // echo "Missing required fields";
            }


        }
        $view = 'campaigns/add_campaign';
        $this->view($view);
    }
}