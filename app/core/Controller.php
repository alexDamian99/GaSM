<?php

class Controller
{
    public function __construct()
    {
        // destroy session used for sigin/register
        if (isset($_SESSION['previous'])) {
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            $currPage =  end($uri);

            if ($currPage != $_SESSION['previous']) {
                if (isset($_SESSION['temp-id_comp'])) unset($_SESSION['temp-id_comp']);
                if (isset($_SESSION['temp-name'])) unset($_SESSION['temp-name']);
                if (isset($_SESSION['temp-email'])) unset($_SESSION['temp-email']);
                if (isset($_SESSION['temp-username'])) unset($_SESSION['temp-username']);
                if (isset($_SESSION['temp-username-check'])) unset($_SESSION['temp-username-check']);
                if (isset($_SESSION['temp-email-check'])) unset($_SESSION['temp-email-check']);
            }
        }
    }

    public function model($model, $params = [])
    {
        require_once '../app/models/' . $model . '.php';
        return new $model(...$params);
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function redirect($url)
    {
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            echo '</noscript>';
            exit;
        }
    }
}
