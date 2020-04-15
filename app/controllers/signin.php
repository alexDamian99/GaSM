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
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            if (isset($username) && isset($password)) {
                $logedin = $this->model->getLogin($username, $password);

                if ($logedin == True) {
                    if (isset($_POST["remember"])) {
                        // set for 30 days
                        setcookie("username", $username, time() + (3600 * 24 * 30));
                    } else {
                        if (isset($_COOKIE["username"])) {
                            setcookie("username", $username, time() - (3600 * 24 * 30));
                        }
                    }

                    $_SESSION["username"] = $username;
                    unset($_SESSION["error"]);
                    $this->redirect('index');
                } else {
                    setcookie("username", $username, time() + (3600 * 24 * 30)); // remember username to try again
                    $_SESSION["error"] = $this->model->getErrors()[0];
                    $this->redirect('sigin');
                }
            }
        }
    }
}
