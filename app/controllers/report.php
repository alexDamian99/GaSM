<?php
session_start();

class Report extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $_SESSION['previous'] = 'report';
        $this->model = $this->model('ReportModel');
    }

    public function index()
    {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        $reyclePoints = $this->model->getRecyclePoints();
        $activeReports = $this->model->getActiveReports();
        $likedReports = $this->model->getLikedReports($username);
        $dislikedReports = $this->model->getDislikedReports($username);
        $likes = $this->model->getTotalLikes();
        $dislikes = $this->model->getTotalDislikes();
        $verified = $this->model->getVerified($username);

        $this->view('report/report', [
            'recycle_points' => $reyclePoints,
            'active_reports' => $activeReports,
            'liked_reports' => $likedReports, 'disliked_reports' => $dislikedReports,
            'likes' => $likes, 'dislikes' => $dislikes, 'verified' => $verified
        ]);

        if (isset($_POST['submit-report'])) {
            // create report
            $type = $_POST['type-report'];
            if ($type == 'garbage-full')
                $type = 1;
            else if ($type == 'garbage-not-sorted')
                $type = 2;
            $location = $_POST['location-report'];
            date_default_timezone_set('Europe/Bucharest');
            $date = date('Y-m-d H:i:s');
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';
            $this->model->doReport($type, $location, $date, $user);

            $this->redirect('report');
        }

        if (isset($_POST['submit-recycle'])) {
            // add a new recycle point
            $type = $_POST['type-recycle'];
            $location = $_POST['location-recycle'];

            $this->model->addRecyclePoint($type, $location);

            $this->redirect('report');
        }

        if (isset($_POST['done'])) {
            // mark a report as done (delete)
            $id = $_POST['report_id'];
            $this->model->deleteReport($id);

            $this->redirect('report');
        }
    }

    public function newAction($params)
    {
        $report_id = $params[0];
        $action = $params[1];

        // only logged in users can vote
        if (isset($_SESSION['username'])) {
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';
            $this->model->newAction($report_id, $action, $username);
        }

        $likes = $this->model->getLikes($report_id);
        $dislikes = $this->model->getDislikes($report_id);

        echo $likes . " " . $dislikes;
    }
}