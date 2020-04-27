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
            // remove old session
            if (isset($_SESSION['username'])) {
                unset($_SESSION['username']);
            }
            if (isset($_SESSION['id_comp'])) {
                unset($_SESSION['id_comp']);
            }

            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $logedin = $this->model->getLogin($username, $password);

            if ($logedin == True) {
                $_SESSION["username"] = $username;

                if (isset($_POST["remember"])) {
                    setcookie("username", $username, time() + (3600 * 24 * 30)); // add cookie for 30 days
                    setcookie("temp_username", $username, time() - 300); // remove temp cookie 
                } else {
                    if (isset($_COOKIE["username"])) {
                        setcookie("username", $username, time() - (3600 * 24 * 30));
                    }
                }

                $id_comp = $this->model->getIdComp($username);
                if ($id_comp != NULL) {
                    $_SESSION['id_comp'] = $id_comp;
                }

                unset($_SESSION["error"]);
                $this->redirect('index');
            } else {
                setcookie("temp_username", $username, time() + 300); // remember username to try again
                $_SESSION["error"] = $this->model->getErrors()[0];
                $this->redirect('sigin');
            }
        }
    }
}
