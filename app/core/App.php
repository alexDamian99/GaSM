<?php

class App
{
    protected $controller = 'product';
    protected $method = 'index';
    protected $params = [];
    
    public function __construct()
    {
        $url = $this->parseUrl();

        if(file_exists('../app/controllers/' .  $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        else {
            echo 'Page does not exists!';
            return;
        }

        require_once '../app/controllers/' .  $this->controller . '.php';

        $this->controller = new $this->controller;
        
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
