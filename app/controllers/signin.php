<?php
session_start();

class SignIn extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $_SESSION['previous'] = 'signin';

        $this->model = $this->model('LoginModel');
    }

    public function index()
    {
        $this->view('login/signin', []);
        if (isset($_POST['submit'])) {
            // destry old session
            if (isset($_SESSION['username']))
                unset($_SESSION['username']);
            if (isset($_SESSION['id_comp']))
                unset($_SESSION['id_comp']);

            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $logedin = $this->model->getLogin($username, $password);

            if ($logedin == True) {
                $_SESSION["username"] = $username;

                if (isset($_POST["remember"])) {
                    setcookie("username", $username, time() + (3600 * 24 * 30)); // add cookie for 30 days
                } else {
                    if (isset($_COOKIE["username"])) {
                        setcookie("username", $username, time() - (3600 * 24 * 30));
                    }
                }

                $id_comp = $this->model->getIdComp($username);
                if ($id_comp != NULL)
                    $_SESSION['id_comp'] = $id_comp;

                if (isset($_SESSION['error']))
                    unset($_SESSION['error']);
                if (isset($_SESSION['temp-username']))
                    unset($_SESSION['temp-username']);

                $this->redirect('home');
            } else {
                $_SESSION['temp-username'] = $username; // remember username to try again
                $_SESSION['error'] = $this->model->getErrors()[0];
                $this->redirect('signin');
            }
        }
    }
    
    public function logout() {
        if(isset($_SESSION['username'])){
            unset($_SESSION['username']);
        }
        if(isset($_SESSION['id_comp'])){
            unset($_SESSION['id_comp']);
        }
        header("Location:/"); //redirect to home
    }

}
