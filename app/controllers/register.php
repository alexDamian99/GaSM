<?php
session_start();

class Register extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('LoginModel');
        $this->view('login/register', []);
    }

    public function index()
    {
        if (isset($_POST['submit'])) {
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name'])  && isset($_POST['email'])) {
                if (isset($_POST['id'])) $id = $_POST['id'];
                else $id = NULL;

                $registered = $this->model->getRegister(
                    $_POST['username'],
                    $_POST['password'],
                    $_POST['name'],
                    $_POST['email'],
                    $id
                );

                if ($registered == True) {
                    $_SESSION['username'] = $_POST['username'];
                    header('Location: index');
                } else {
                    print_r($this->model->getErrors());
                }
            }
        }
    }
}
