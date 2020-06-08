<?php

include_once '../app/core/jwt/jwt_params.php';
include_once '../app/core/jwt/php-jwt-master/src/BeforeValidException.php';
include_once '../app/core/jwt/php-jwt-master/src/ExpiredException.php';
include_once '../app/core/jwt/php-jwt-master/src/SignatureInvalidException.php';
include_once '../app/core/jwt/php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;

class AuthController extends Controller
{

    private $requestMethod;

    private $model;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->model = $this->model('LoginModel');
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'POST':
                $response = $this->authenticate();
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

    private function authenticate()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $username = $input['username'];
        $password = md5($input['password']);

        if (!$this->validateReport($input)) {
            return $this->unprocessableEntityResponse();
        }
        $checkAuth = $this->model->getLogin($username, $password);
        if ($checkAuth) {
            $token = array(
                'iss' => JWT_ISS,
                'aud' => JWT_AUD,
                'iat' => JWT_IAT,
                'ext' => JWT_EXP,
                'data' => array(
                    'username' => $username,
                    'id_comp' => $this->model->getIdComp($username)
                )
            );

            $jwt = JWT::encode($token, JWT_KEY);

            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode(['jwt' => $jwt]);
            return $response;
        } else {
            return $this->unauthorizedResponse();
        }
    }

    private function validateReport($input)
    {
        if (!isset($input['username']) || !isset($input['password']))
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