<?php
session_start();

class ForgotPass extends Controller
{
    public function __construct()
    {
        $this->view('login/forgotPass', []);
    }

    public function index()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            // send email
            $this->redirect('signin');
        }
    }
}
