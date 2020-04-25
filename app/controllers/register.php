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
            // remove old session
            if (isset($_SESSION['username'])) {
                unset($_SESSION['username']);
            }
            if (isset($_SESSION['id_comp'])) {
                unset($_SESSION['id_comp']);
            }

            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $id_comp = isset($_POST['id']) ? $_POST['id'] : NULL;

            // setcookie("temp_name", $name, time() + 300); // remember username to try again
            // setcookie("temp_email", $email, time() + 300); // remember username to try again
            // setcookie("temp_username", $username, time() + 300); // remember username to try again


            if (strcmp($this->checkPassword($password), "Very weak") == 0) {
                $_SESSION["error"] = "Password is too weak.";
                $this->redirect('register');
                return;
            }

            $password = md5($password);

            $registered = $this->model->getRegister($username, $password, $name, $email, $id_comp);

            if ($registered == True) {
                $_SESSION['username'] = $username;

                if ($id_comp != NULL) {
                    $_SESSION['id_comp'] = $id_comp;
                }

                unset($_SESSION["error"]);
                $this->redirect('index');
            } else {
                $_SESSION["error"] = $this->model->getErrors()[0];
                $this->redirect('register');
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
