<?php
session_start();

class Edit_profile extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('ProfileModel');
        $this->view('profile/edit_profile', []);
    }

    public function index()
    {
        
    }
}
