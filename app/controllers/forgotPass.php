<?php
session_start();

class ForgotPass extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $_SESSION['previous'] = 'forgotPass';
        $this->model = $this->model('LoginModel');
    }

    public function index()
    {
        $text = 'Enter your email adress and follow the steps to recover your account.';
        $this->view('login/forgotPass', ['text' => $text, 'input-type' => 'email']);

        if (isset($_POST['submit'])) {
            $to = $_POST['email'];
            if (!$this->model->checkEmail($to)) {
                $_SESSION['reset-email'] = $to;
                $this->sendEmail($to, 'GaSM - Reset your password', $this->generateToken());
                $this->redirect('forgotPass/token');
            } else {
                $_SESSION['error'] = 'Email not found!';
                header("Refresh:0");
            }
        }
    }

    public function token()
    {
        $text = 'Enter the token received on the email.';
        $this->view('login/forgotPass', ['text' => $text, 'input-type' => 'token']);

        if (isset($_POST['submit'])) {
            $token = $_POST['token'];
            if ($this->model->checkToken($_SESSION['reset-email'], $token)) {
                $this->redirect('./reset/' . $token);
            } else {
                $_SESSION['error'] = 'Incorrect token!';
                header("Refresh:0");
            }
        }
    }

    public function reset($params)
    {
        $token = $params[0];
        $text = 'Enter your new password.';
        $this->view('login/forgotPass', ['text' => $text, 'input-type' => 'password']);

        if (isset($_POST['submit'])) {
            $password = $_POST['password'];
            if ($this->checkPassword($password) != 'Very weak') {
                $this->model->updatePassword($_SESSION['reset-email'], md5($password));
                unset($_SESSION['reset-email']);
                $this->redirect('../../signin');
            } else {
                $_SESSION['error'] = 'Password is too weak';
                header("Refresh:0");
            }
        }
    }

    /* util funs */

    public function sendEmail($to, $subject, $message)
    {
        $headers = array(
            'From' => 'pythonsender77@gmail.com',
            'Reply-To' => 'pythonsender77@gmail.com',
            'X-Mailer' => 'PHP/' . phpversion()
        );

        mail($to, $subject, $message, $headers);
    }

    public function generateToken()
    {
        $token = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < 8; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }

        $this->model->insertToken($_SESSION['reset-email'], $token);
        return $token;
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