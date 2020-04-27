<?php
session_start();

class Report extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('ReportModel');
        $activeReports = $this->model->getActiveReports();
        $this->view('report/report', $activeReports);
    }

    public function index()
    {
        if (isset($_POST['submit'])) {
            // create report
            $type = $_POST['type'];
            if ($type == 'garbage-full')
                $type = 1;
            else if ($type == 'garbage-not-sorted')
                $type = 2;
            $location = $_POST['location'];
            date_default_timezone_set('Europe/Bucharest');
            $date = date('Y-m-d H:i:s');
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';
            $this->model->doReport($type, $location, $date, $user);

            $this->redirect('report');
        }

        if (isset($_POST['done'])) {
            // mark a report as done (delete)
            $id = $_POST['report_id'];
            $this->model->deleteReport($id);

            $this->redirect('report');
        }
    }
}
