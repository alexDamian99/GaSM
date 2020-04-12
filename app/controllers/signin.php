<?php
session_start();

class SignIn extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('LoginModel');
        $this->view('login/signin', []);
    }

    public function index()
    {
        if (isset($_POST['submit'])) {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $logedin = $this->model->getLogin($_POST['username'], $_POST['password']);

                if ($logedin == True) {
                    $_SESSION['username'] = $_POST['username'];
                    header('Location: index');
                } else {
                    print_r($this->model->getErrors());
                }
            }
        }
    }
}
