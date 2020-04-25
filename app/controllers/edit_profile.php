<?php
session_start();

class Edit_profile extends Controller
{
    private $model;

    public function __construct()
    {
        // $this->model = $this->model('StatisticsModel');
        $this->view('profile/edit_profile', []);
    }

    public function index()
    {
<<<<<<< HEAD
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            if (isset($username)) {
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
=======
        
>>>>>>> 1e1314711d50e23e6f893aadaf2d469421f25502
    }
}
