<?php
// https://developer.okta.com/blog/2019/03/08/simple-rest-api-php

require_once('../app/controllers/ReportController.php');
require_once('../app/controllers/AuthController.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class Api extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        echo 'Welcome to GaSM API!';
    }

    public function report($params)
    {
        $reportId = null;
        if (isset($params[0])) {
            $reportId = (int) $params[0];
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $controller = new ReportController($requestMethod, $reportId);
        $controller->processRequest();
    }

    public function auth()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $controller = new AuthController($requestMethod);
        $controller->processRequest();
    }
}