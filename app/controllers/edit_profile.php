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

        if (isset($_SESSION["username"])){
            $username = $_SESSION['username'];
            $image = $this->model->getPhoto($username);
            $_SESSION["profile_photo"] = "https://proiect-tw-gasm.s3.eu-central-1.amazonaws.com/" . $image;

            if (isset($_POST['submit_edit_profile'])) {
                $success = TRUE; 
    
                if (!empty($_POST['input_name'])) {
                    $name = $_POST['input_name'];
                    if (isset($_SESSION["username"])) {
                        $success &= $this->model->changeName($_SESSION["username"], $name);
                    }
                }
                
                if (!empty($_POST['input_email'])) {
                    $email = $_POST['input_email'];
                    if (isset($_SESSION["username"])) {
                        $success &= $this->model->changeEmail($_SESSION["username"], $email);
                    }
                }
    
                if (!empty($_POST['input_address'])) {
                    $address = $_POST['input_address'];
                    if (isset($_SESSION["username"])) {
                        $success &= $this->model->changeAddress($_SESSION["username"], $address);
                    }
                }
    
                if(!empty($_FILES['input_file']['tmp_name']) && is_uploaded_file($_FILES['input_file']['tmp_name']))
                {
                    if (isset($_SESSION["username"])) {
                        $success &= $this->model->changePhoto($_SESSION["username"]);
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
        else {
            header("Location: " . getenv('path_to_public') . "/signin"); //redirect to signin
        }
        
        
    }

    public function verify() {
        print_r($_POST);
        if(isset($_POST['username']) && !empty($_POST['username'])) {
            $this->model->verifyUser($_POST['username']);
            echo "ok";
        }
        else {
            echo "not ok";
        }
    }
}
