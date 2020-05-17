<?php
session_start();

class Edit_profile extends Controller
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $_SESSION['previous'] = 'edit_profile';
        $this->model = $this->model('ProfileModel');
        $this->view('profile/edit_profile', []);
    }

    public function index()
    {
        
        $default_photo = 'default_photo.png';

        if (isset($_COOKIE["username"])){
            $username = $_SESSION['username'];
            $image = $this->model->getPhoto($username);
            $_SESSION["profile_photo"] = "https://proiect-tw-gasm.s3.eu-central-1.amazonaws.com/" . $image;
        }
        
        if (isset($_POST['submit_edit_profile'])) {
            $success = TRUE; 

            if (!empty($_POST['input_name'])) {
                $name = $_POST['input_name'];
                if (isset($_COOKIE["username"])) {
                    $success &= $this->model->changeName($_COOKIE["username"], $name);
                }
            }
            
            if (!empty($_POST['input_email'])) {
                $email = $_POST['input_email'];
                if (isset($_COOKIE["username"])) {
                    $success &= $this->model->changeEmail($_COOKIE["username"], $email);
                }
            }

            if (!empty($_POST['input_address'])) {
                $address = $_POST['input_address'];
                if (isset($_COOKIE["username"])) {
                    $success &= $this->model->changeAddress($_COOKIE["username"], $address);
                }
            }

            if(!empty($_FILES['input_file']['tmp_name']) && is_uploaded_file($_FILES['input_file']['tmp_name']))
            {
                if (isset($_COOKIE["username"])) {
                    $success &= $this->model->changePhoto($_COOKIE["username"]);
                }
            }

            if ($success){
                unset($_SESSION["error"]);
                $_SESSION["success"] = $this->model->getSuccess()[0];
            }
            else{
                $_SESSION["error"] = $this->model->getErrors()[0];
            }
            $this->redirect('edit_profile');
        }
    }
}
