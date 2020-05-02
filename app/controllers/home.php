<?php

class Home extends Controller{
    public function index($params = ''){
        $view = 'home/index';
        $this->view($view);
    }
}