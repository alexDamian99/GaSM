<?php
session_start();

class Home extends Controller{
    private $model;
    public function __construct(){
        parent::__construct();
        $_SESSION['previous'] = 'home';
        $this->model = $this->model("CampaignModel");
    }
    
    public function index($params = ''){
        $view = 'home/index';
        $this->view($view, $this->model->getNCampaigns(0, 3));
    }

    
}