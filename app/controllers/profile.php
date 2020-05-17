<?php
session_start();

class Profile extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $_SESSION['previous'] = 'profile';
        $this->model = $this->model('ProfileModel');
        $activeReports = [];
        $activeCampaigns = [];
        if (isset($_COOKIE["username"])){
            $activeReports = $this->model->getActiveReportsFor($_COOKIE["username"]);
            $activeCampaigns = $this->model->getActiveCampaignsFor($_COOKIE["username"]);
        }
        $this->view('profile/profile', [$activeReports, $activeCampaigns]);
    }

    public function index()
    {

        if (isset($_COOKIE["username"])){
            $username = $_SESSION['username'];
            $image = $this->model->getPhoto($username);
            
            $_SESSION["profile_photo"] = "https://proiect-tw-gasm.s3.eu-central-1.amazonaws.com/" . $image;
        }
    }
}
