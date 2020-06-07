<?php
session_start();

class Statistics extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $_SESSION['previous'] = 'statistics';
        
        $this->model = $this->model('StatisticsModel');
        $types = $this->model->getExportTypes();
        $this->view('statistics/statistics', $types);
    }

    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['admin'])) {
            $types = [];
            if(isset($_POST['exportHTML']) && $_POST['exportHTML'] == 'on') {
                $types[] = "html";
            }
            if(isset($_POST['exportPDF']) && $_POST['exportPDF'] == 'on') {
                $types[] = "pdf";
            }
            if(isset($_POST['exportCSV']) && $_POST['exportCSV'] == 'on') {
                $types[] = "csv";
            }
            $this->model->updateTypes($types);
        }
    }
}
