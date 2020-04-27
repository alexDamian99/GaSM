<?php
session_start();

class Register extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('LoginModel');
    }

    public function index()
    {
        $this->view('login/register', []);

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $id_comp = isset($_POST['id']) ? $_POST['id'] : NULL;

            if (strcmp($this->checkPassword($password), "Very weak") == 0) {
                goto noRegistered;
            }

            $password = md5($password);

            $registered = $this->model->getRegister($username, $password, $name, $email, $id_comp);

            if ($registered == True) {
                $_SESSION['username'] = $username;

                if ($id_comp != NULL) {
                    $_SESSION['id_comp'] = $id_comp;
                }

                if (isset($_SESSION['temp-id_comp'])) unset($_SESSION['temp-id_comp']);
                if (isset($_SESSION['temp-name'])) unset($_SESSION['temp-name']);
                if (isset($_SESSION['temp-email'])) unset($_SESSION['temp-email']);
                if (isset($_SESSION['temp-username'])) unset($_SESSION['temp-username']);
                if (isset($_SESSION['temp-username-check'])) unset($_SESSION['temp-username-check']);
                if (isset($_SESSION['temp-email-check'])) unset($_SESSION['temp-email-check']);

                $this->redirect('index');
            } else {
                noRegistered:
                // remember credentials for trying again
                if ($id_comp != NULL) $_SESSION['temp-id_comp'] = $id_comp;
                $_SESSION['temp-name'] = $name;
                $_SESSION['temp-email'] = $email;
                $_SESSION['temp-username'] = $username;

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

    public function checkUsername($username)
    {
        if (!$this->model->checkUsername($username)) {
            $_SESSION['temp-username-check'] = false;
            echo false;
        } else {
            $_SESSION['temp-username-check'] = true;
            echo true;
        }
    }

    public function checkEmail($email)
    {
        if (!$this->model->checkEmail($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['temp-email-check'] = false;
            echo false;
        } else {
            $_SESSION['temp-email-check'] = true;
            echo true;
        }
    }
}
