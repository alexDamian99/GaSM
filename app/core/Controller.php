<?php

class Controller
{
    public function model($model, $params = [])
    {
        require_once '../app/models/' . $model . '.php';
        return new $model(...$params);
    }

    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }
}
