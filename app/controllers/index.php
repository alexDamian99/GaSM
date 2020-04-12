<?php
session_start();

class Index extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['username'])) {
            header('Location: signin');
        } else {
            echo 'Welcome ' . $_SESSION['username'];
            echo '<form action="./index" method="POST">
              <button type="submit" name="signout">Sign out</button>
              </form>';

            if (isset($_POST['signout'])) {
                session_destroy();
            }
        }
    }
}
