<?php

class ReportController extends Controller
{

    private $requestMethod;
    private $reportId;

    private $model;

    public function __construct($requestMethod, $reportId)
    {
        $this->requestMethod = $requestMethod;
        $this->reportId = $reportId;
        $this->model = $this->model('ReportModel');
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->reportId) {
                    $response = $this->getReport($this->reportId);
                } else {
                    $response = $this->getAllReports();
                };
                break;
            case 'POST':
                $response = $this->createReport();
                break;
            case 'DELETE':
                $response = $this->deleteReport($this->reportId);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllReports()
    {
        $result = $this->model->getActiveReports();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getReport($id)
    {
        $result = $this->model->getActiveReport($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createReport()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateReport($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->model->doReport($input['type'], $input['location'], $input['date'], $input['user']);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private function deleteReport($id)
    {
        $result = $this->model->getActiveReport($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $this->model->deleteReport($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function validateReport($input)
    {
        if (!isset($input['type']) || !isset($input['location']) || !isset($input['date']) || !isset($input['user']))
            return false;
        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}