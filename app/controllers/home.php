<?php

class Home extends Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index($params = ''){
        $view = 'home/index';
        $this->view($view);
    }
}