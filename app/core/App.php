<?php

class App
{
<<<<<<< HEAD
    protected $controller = 'index';
=======
    protected $controller = 'home';
>>>>>>> 57c372d02c02f6661a25ace3f49d0cbd1302f7c3
    protected $method = 'index';
    protected $params = [];
    
    public function __construct(){
        

<<<<<<< HEAD
        if(isset($url[0])) {
            if(file_exists('../app/controllers/' .  $url[0] . '.php')) {
=======

        $url = $this->parseURL();
        
        if(isset($url[0])){
            if(file_exists('../app/controllers/' . $url[0] . '.php')){
>>>>>>> 57c372d02c02f6661a25ace3f49d0cbd1302f7c3
                $this->controller = $url[0];
                unset($url[0]);
            }
        }

        require_once '../app/controllers/' .  $this->controller . '.php';

        $this->controller = new $this->controller;

        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        
        call_user_func([$this->controller, $this->method], $this->params);
    }

    private function parseURL(){
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}