<?php
session_start();

class Campaigns extends Controller{
    private $model;
    public function __construct(){
        $this->model = $this->model("CampaignModel");
    }

    public function index($params = ''){
        $view = 'campaigns/campaigns';
        if(isset($_GET['pg']) && !empty($_GET['pg'])){
            $campaigns = $this->model->getNCampaigns(($_GET['pg'] - 1) * 9);
        }
        else {
            $campaigns = $this->model->getNCampaigns(0);
        }
        
        $this->view($view, [$campaigns, $this->model->countCampaigns(), false]);
    }

    public function id($params = ''){
        if(empty($params)){
            $view = '404';
            $this->view($view);
        }else{
            $view = 'campaigns/campaign';
            
            $campaign_info = $this->model->getCampaignById($params[0]);
            $username = $this->model->getUserById($campaign_info['user_id']);
            if(empty($campaign_info)){//if the id is wrong
                $this->view('404');
            }else{
                $this->view($view, ["campaign" => $campaign_info, "user" => $username]);
            }
            
        }
    }

    public function add($params = ''){
        if(isset($_SESSION['id']) || isset($_SESSION['username'])){
            $view = 'campaigns/add_campaign';
            $this->view($view);
        }
        else {
            header("Location: " . getenv('path_to_public') . "/signin"); //redirect to signin
        }
    }

    public function insert() {
        $response = ["status" => false, "errors" => []];
        if(isset($_POST['title']) && isset($_POST['description'])){
            if(preg_match("/[A-Za-z0-9-_ ]{1,255}$/", $_POST['title'])){
                if(isset($_FILES['banner']) && $_FILES['banner']['size'] != 0){
                    $this->model->insertCampaign($_POST['title'], $_POST['description'], $_POST['location'], $_POST['date'], $_FILES["banner"]["name"]);
                }
                else{
                    $this->model->insertCampaign($_POST['title'], $_POST['description'], $_POST['location'], $_POST['date']);
                }

                if(sizeof($this->model->getErrors()) === 0) {
                    $response["status"] = true;
                }
                else {
                    $response["errors"] = $this->model->getErrors();
                }
            }
            else{
                $response["errors"] = "Invalid title or location";
            }
        }
        else {
            $response["errors"] = "Missing required fields";
        }
        echo json_encode($response);
    }
    
    public function search($params='') {
        $view = 'campaigns/campaigns';
        if(isset($_GET['k']) && !empty($_GET['k'])) {
            $found_campaigns = $this->model->searchCampaigns($_GET['k']);
            $size = sizeof($found_campaigns);
            if(isset($_GET['pg']) && !empty($_GET['pg'])) {
                $found_campaigns = array_slice($found_campaigns, ($_GET['pg'] - 1) * 9, 9);
            }else {
                $found_campaigns = array_slice($found_campaigns, 0, 9);
            }
        }
        $this->view($view, [$found_campaigns, $size, true]);
    }

}