<?php
session_start();

class Statistics_data extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('StatisticsModel');
        $this->view('statistics/statistics_data', [$this->model->getStatisticsData()]);
    }

    public function index()
    {
        
    }
}
