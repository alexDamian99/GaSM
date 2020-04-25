<?php
session_start();

class Edit_profile extends Controller
{
    private $model;

    public function __construct()
    {
        // $this->model = $this->model('StatisticsModel');
        $this->view('profile/edit_profile', []);
    }

    public function index()
    {
        
    }
}
