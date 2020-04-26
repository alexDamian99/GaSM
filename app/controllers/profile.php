<?php
session_start();

class Profile extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('ProfileModel');
        $this->view('profile/profile', []);
    }

    public function index()
    {
        $photos_dir = "assets/images/upload/";

        if (isset($_COOKIE["username"])){
            $username = $_SESSION['username'];
            $image = $this->model->getPhoto($username);
            $profile_photo = $photos_dir.$image;
            $_SESSION["profile_photo"] = $profile_photo;
        }
    }
}
