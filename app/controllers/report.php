<?php
session_start();

class Report extends Controller
{
    private $model;
    private $username, $reyclePoints, $activeReports, $likedReports, $dislikedReports, $likes, $dislikes, $verified;

    public function __construct()
    {
        parent::__construct();
        $_SESSION['previous'] = 'report';
        $this->model = $this->model('ReportModel');
    }

    public function index()
    {
        $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        $this->reyclePoints = $this->model->getRecyclePoints();
        $this->activeReports = $this->model->getActiveReports();
        $this->likedReports = $this->model->getLikedReports($this->username);
        $this->dislikedReports = $this->model->getDislikedReports($this->username);
        $this->likes = $this->model->getTotalLikes();
        $this->dislikes = $this->model->getTotalDislikes();
        $this->verified = 0;
        if ($this->username !== '') {
            $this->verified = $this->model->getVerified($this->username);
        }

        $this->view('report/report', [
            'recycle_points' => $this->reyclePoints,
            'active_reports' => $this->activeReports,
            'liked_reports' => $this->likedReports, 'disliked_reports' => $this->dislikedReports,
            'likes' => $this->likes, 'dislikes' => $this->dislikes, 'verified' => $this->verified
        ]);
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

    public function deleteReport($params)
    {
        $report_id = $params[0];
        $this->model->deleteReport($report_id);

        $this->index();
    }

    public function addNewRecyclePoint($params)
    {
        $type = $params[0];
        $location = $params[1];

        $this->model->addRecyclePoint($type, $location);

        $this->index();
    }

    public function addNewReport($params)
    {
        $type = $params[0];
        $location = $params[1];

        if ($type == 'garbage-full')
            $type = 1;
        else if ($type == 'garbage-not-sorted')
            $type = 2;
        date_default_timezone_set('Europe/Bucharest');
        $date = date('Y-m-d H:i:s');
        $user = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';

        $this->model->doReport($type, $location, $date, $user);

        $this->index();
    }
}