<?php
session_start();

class Statistics extends Controller
{
    private $model;

    public function __construct()
    {
        // $this->model = $this->model('StatisticsModel');
        $this->view('statistics/statistics', []);
    }

    public function index()
    {
        
    }
}
