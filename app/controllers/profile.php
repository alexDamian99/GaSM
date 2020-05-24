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
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $image = $this->model->getPhoto($username);
            $activeReports = $this->model->getActiveReportsFor($_SESSION["username"]);
            $activeCampaigns = $this->model->getActiveCampaignsFor($_SESSION["username"]);
            $_SESSION["profile_photo"] = "https://proiect-tw-gasm.s3.eu-central-1.amazonaws.com/" . $image;
            $this->view('profile/profile', [$activeReports, $activeCampaigns]);
        } else {
            header("Location: " . getenv('path_to_public') . "/signin"); //redirect to signin
        }
    }
}
