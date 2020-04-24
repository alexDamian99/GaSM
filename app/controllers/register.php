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
            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;

            if (strcmp($this->checkPassword($password), "Very weak") == 0) {
                $_SESSION["error"] = "Password is too weak.";
                $this->redirect('register');
                return;
            }

            if (isset($username) && isset($password) && isset($name) && isset($email)) {
                $password = md5($password);

                $registered = $this->model->getRegister($username, $password, $name, $email, $id);

                if ($registered == True) {
                    $_SESSION['username'] = $username;
                    unset($_SESSION["error"]);
                    $this->redirect('index');
                } else {
                    $_SESSION["error"] = $this->model->getErrors()[0];
                    $this->redirect('register');
                }
            }
        }
    }

    public function checkPassword($password)
    {
        $rez = "Very weak";

        if (preg_match("/^(?=.*\d)(?=.*[a-z]).{6,}$/m", $password))
            $rez = "Weak";

        if (
            preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/m", $password) ||
            preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9]).{6,}$/m", $password)
        )
            $rez = "Good";

        if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,}$/m", $password))
            $rez = "Strong";

        return $rez;
    }
}
