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
        if (isset($_POST['submit_edit_profile'])) {
            $name = $_POST['input_name'];
            if (isset($name)) {
                $success = FALSE;
                if (isset($_COOKIE["username"])) {
                    $success = $this->model->changeName($_COOKIE["username"], $name);
                }
                
                if ($success){
                    unset($_SESSION["error"]);
                    $_SESSION["success"] = $this->model->getSuccess()[0];
                }
                else{
                    $_SESSION["error"] = $this->model->getErrors()[0];
                }
            }

            $email = $_POST['input_email'];
            if (isset($email)) {
                $success = FALSE;
                if (isset($_COOKIE["username"])) {
                    $success = $this->model->changeEmail($_COOKIE["username"], $email);
                }
                
                if ($success){
                    unset($_SESSION["error"]);
                    $_SESSION["success"] = $this->model->getSuccess()[0];
                }
                else{
                    $_SESSION["error"] = $this->model->getErrors()[0];
                }
            }
        }
    }
}
