<?php 

include_once '../app/core/jwt/jwt_params.php';
include_once '../app/core/jwt/php-jwt-master/src/BeforeValidException.php';
include_once '../app/core/jwt/php-jwt-master/src/ExpiredException.php';
include_once '../app/core/jwt/php-jwt-master/src/SignatureInvalidException.php';
include_once '../app/core/jwt/php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;

class CampaignController extends Controller {

    private $requestMethod;
    private $campaignId;

    private $model;

    public function __construct($requestMethod, $campaignId)
    {
        $this->requestMethod = $requestMethod;
        $this->campaignId = $campaignId;
        $this->model = $this->model('CampaignModel');
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->campaignId) {
                    $response = $this->getCampaign($this->campaignId);
                } else {
                    $response = $this->getAllCampaigns();
                };
                break;
            case 'POST':
                $response = $this->createCampaign();
                break;
            case 'DELETE':
                $response = $this->deleteCampaign($this->campaignId);
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

    private function getAllCampaigns()
    {
        $result = $this->model->getAllCampaigns();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getCampaign($id)
    {
        $result = $this->model->getCampaignById($id);
        if (!$result) {
            return $this->notFoundResponse();
        } else {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode($result);
            return $response;
        }
    }

    private function createCampaign()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateCampaign($input)) {
            return $this->unprocessableEntityResponse();
        } else {
            if (isset($input['jwt'])) {
                try {
                    $decodedJwt = JWT::decode($input['jwt'], JWT_KEY, array('HS256'));
                    $userId = $decodedJwt->data->id;
                    $this->model->insertCampaign($input['title'], $input['description'], 
                                        (isset($input['location'])?$input['location']:''),
                                        (isset($input['date'])?$input['date']:'0000-00-00'), 
                                        "default.jpg",
                                        $userId
                                    );
                    $response['status_code_header'] = 'HTTP/1.1 201 Created';
                    $response['body'] = null;
                    return $response;
                } catch (Exception $e) {
                    return $this->unauthorizedResponse();
                }
            }  else {
                return $this->unauthorizedResponse();
            }
        }
    }

    private function deleteCampaign($id)
    {
        $input = (array) json_decode(file_get_contents('php://input'));
        if (isset($input['jwt'])) {
            try {
                $decodedJwt = JWT::decode($input['jwt'], JWT_KEY, array('HS256'));
                $user = $decodedJwt->data;
                if ($user->id_comp == null) {
                    return $this->unauthorizedResponse();
                } else {
                    $result = $this->model->getCampaignById($id);
                    if (!$result) {
                        return $this->notFoundResponse();
                    } else {
                        $this->model->deleteCampaign($id);
                        $response['status_code_header'] = 'HTTP/1.1 200 OK';
                        $response['body'] = null;
                        return $response;
                    }
                }
            } catch (Exception $e) {
                return $this->unauthorizedResponse();
            }
        } else
            return $this->unauthorizedResponse();
    }

    private function validateCampaign($input)
    {
        if (!isset($input['title']) || !isset($input['description']))
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

    private function unauthorizedResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 401 Unauthorized';
        $response['body'] = null;
        return $response;
    }
}