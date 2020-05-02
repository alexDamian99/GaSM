<?php

class Controller
{
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
