<?php
session_start();

class Admin extends Controller {

    private $model;

    public function index($params = '') {
        if(isset($_SESSION['admin']) && !empty($_SESSION['admin']) && $_SESSION['admin'] === true) {
            $types = $this->model('StatisticsModel')->getExportTypes();
            $userCount = $this->model('ProfileModel')->countUsers();
            $campaignCount = $this->model('CampaignModel')->countCampaigns();
            $reportCount = $this->model('ReportModel')->countReports();
            $companyUsers = $this->model('ProfileModel')->getCompanyUsers();
            $this->view('admin/dashboard', 
                ["types" => $types, 
                "reportCount" => $reportCount, 
                "userCount" => $userCount, 
                "campaignCount" => $campaignCount,
                "companyUsers" => $companyUsers]);
        } else {
            header("Location: " . getenv('path_to_public') . "/admin/login"); //redirect to login
        }
    }

    public function login($params = '') {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            if(getenv("ADMINUSER") === $_POST['username'] && getenv("ADMINPASS") === $_POST['password']) {
                $_SESSION['admin'] = true;
                header("Location: " . getenv('path_to_public') . "/admin");
            } else {
                $this->view('admin/login', ['failed' => true]);
            }
        }
        else {
            $this->view('admin/login');
        }
    }

    public function campaigns($params = '') {
        $this->model = $this->model("CampaignModel");
        if(isset($_SESSION['admin']) && $_SESSION['admin']) {
            $campaignCount = $this->model->countCampaigns();
            if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $code = $this->model->deleteCampaign($params[0]);
                $page = 1;
            } else {
                $page = 1;
                if(isset($params[0])) {
                    $paramPage = intval($params[0]);
                    if($paramPage > 0 && $paramPage <= ceil($campaignCount / 10) ) {
                        $page = $paramPage;
                    }
                }
            }
            $campaigns = $this->model->getNCampaigns( ($page - 1)  * 10, 10);
            $this->view('admin/listing', ["type" => "Campaigns",
                                            "headers" => ["Id", "Title", "Location", "Date", "Image", "Author", "Campaign Page", "Delete"],
                                            "elements" => $campaigns, 
                                            "page" => $page, 
                                            "pageCount" => $campaignCount]);
        } else {
            header("Location: " . getenv('path_to_public') . "/admin/login"); //redirect to login
        }
    }

    public function users($params = '') {
        $this->model = $this->model("ProfileModel");
        if(isset($_SESSION['admin']) && $_SESSION['admin']) {
            $userCount = $this->model->countUsers();
            if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $this->model->deleteUser($params[0]);
                $page = 1;
            } else {
                $page = 1;
                if(isset($params[0])) {
                    $paramPage = intval($params[0]);
                    if($paramPage > 0 && $paramPage <= ceil($userCount / 10) ) {
                        $page = $paramPage;
                    }
                }
            }
            $users = $this->model->getNUsers( ($page - 1)  * 10, 10);
            $this->view('admin/listing', ["type" => "Users",
                                            "headers" => ["Id", "Username", "Name", "Email", "Id Comp", "Photo", "Delete"],
                                            "elements" => $users, 
                                            "page" => $page, 
                                            "pageCount" => $userCount]);
        } else {
            header("Location: " . getenv('path_to_public') . "/admin/login"); //redirect to login
        }
    }

    public function reports($params = '') {
        $this->model = $this->model("ReportModel");
        if(isset($_SESSION['admin']) && $_SESSION['admin']) {
            $reportCount = $this->model->countReports();
            if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $this->model->deleteReport($params[0]);
                $page = 1;
            } else {
                $page = 1;
                if(isset($params[0])) {
                    $paramPage = intval($params[0]);
                    if($paramPage > 0 && $paramPage <= ceil($reportCount / 10) ) {
                        $page = $paramPage;
                    }
                }
            }
            $reports = $this->model->getNReports( ($page - 1)  * 10, 10);
            $this->view('admin/listing', ["type" => "Reports",
                                            "headers" => ["Id", "Type", "Location", "Date", "User", "Likes", "Dislikes", "Delete"],
                                            "elements" => $reports,
                                            "page" => $page, 
                                            "pageCount" => $reportCount]);
        } else {
            header("Location: " . getenv('path_to_public') . "/admin/login"); //redirect to login
        }
    }

    public function logout($params = '') {
        if(isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header('Location:' . getenv("path_to_public"));
    }
}
