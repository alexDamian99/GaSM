<?php
session_start();

class Profile extends Controller
{
    private $model;

    public function __construct()
    {
        // $this->model = $this->model('StatisticsModel');
        $this->view('profile/profile', []);
    }

    public function index()
    {
        
    }
}
