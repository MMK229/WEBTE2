<?php


require_once(__DIR__ . '/../config.php');
require_once('Test.class.php');

$test = new Test($db);

header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
$route = explode('/', $_GET['route']);

require_once('Auth.class.php');
$auth = new Auth($db);

$publicRoutes = [
    'questions',
    'questions/',
    'register',
    'login'
];


$routePath = $_GET['route'] ?? '';
$pathIsPublic = false;


if (preg_match('#^questions(/\d+)?$#', $routePath) ||
    $routePath === 'register' ||
    $routePath === 'login') {
    $pathIsPublic = true;
}


if (!$pathIsPublic) {
    $user_id = $auth->authenticate(getallheaders());
    if (!$user_id) {
        http_response_code(401);
        echo json_encode(["error" => "Neautorizovaný prístup"]);
        exit;
    }
}

switch ($method) {
    case 'GET':
        if ($route[0] === 'questions' && count($route) === 1) {
            echo json_encode($test->getAllQuestions());
        } elseif ($route[0] === 'questions' && is_numeric($route[1] ?? null)) {
            $data = $test->getQuestion((int)$route[1]);
            if ($data) {
                echo json_encode($data);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Otázka neexistuje"]);
            }
        } elseif ($route[0] === 'tests' && !isset($route[1])) {
            echo json_encode($test->getAllUserTestsWithQuestions($user_id));
        } elseif ($route[0] === 'tests' && is_numeric($route[1] ?? null)) {
            echo json_encode($test->getTestResult((int)$route[1]));
        } elseif ($route[0] === 'is-admin') {
            $admin = $auth->isAdmin($user_id);
            echo json_encode(["admin" => $admin]);
            break;
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Not found"]);
        }
        break;

    case 'POST':
        if ($route[0] === 'tests' && ($route[1] ?? '') === 'start') {
            $input = json_decode(file_get_contents('php://input'), true);
            if (!isset($input['user_id'], $input['city'], $input['country'])) {
                http_response_code(400);
                echo json_encode(["error" => "Neplatné dáta"]);
                break;
            }
            $result = $test->startTest($input['user_id'], $input['city'], $input['country']);
            http_response_code(201);
            echo json_encode($result);
            break;
        } elseif ($route[0] === 'tests' && ($route[1] ?? '') === 'answer') {
            $input = json_decode(file_get_contents('php://input'), true);
            if (!isset($input['test_id'], $input['question_id'], $input['answered_correctly'], $input['time_taken'])) {
                http_response_code(400);
                echo json_encode(["error" => "Neplatné dáta"]);
                break;
            }
            $result = $test->storeAnswer(
                $input['test_id'],
                $input['question_id'],
                $input['answered_correctly'],
                $input['time_taken']
            );
            http_response_code(201);
            echo json_encode($result);
            break;
        } elseif ($route[0] === 'tests') {
            $input = json_decode(file_get_contents('php://input'), true);
            if (!isset($input['user_id'], $input['city'], $input['country'], $input['questions']) || !is_array($input['questions'])) {
                http_response_code(400);
                echo json_encode(["error" => "Neplatné dáta"]);
                break;
            }

            $result = $test->storeTest($input['user_id'], $input['city'], $input['country'], $input['questions']);
            if (isset($result['error'])) {
                http_response_code(500);
                echo json_encode($result);
            } else {
                http_response_code(201);
                echo json_encode($result);
            }
            break;
        } elseif ($route[0] === 'register') {
            $input = json_decode(file_get_contents('php://input'), true);
            if (!isset($input['username'], $input['password'])) {
                http_response_code(400);
                echo json_encode(["error" => "Zadaj meno a heslo"]);
                break;
            }
            $response = $auth->register($input['username'], $input['password']);
            if (isset($response['error'])) {
                http_response_code(409);
            }
            echo json_encode($response);
            break;
        } elseif ($route[0] === 'login') {
            $input = json_decode(file_get_contents('php://input'), true);
            if (!isset($input['username'], $input['password'])) {
                http_response_code(400);
                echo json_encode(["error" => "Zadaj meno a heslo"]);
                break;
            }
            $response = $auth->login($input['username'], $input['password']);
            if (isset($response['error'])) {
                http_response_code(401);
            }
            echo json_encode($response);
            break;

        } elseif ($route[0] === 'token' && $route[1] === 'refresh') {
            $user_id = $auth->authenticate(getallheaders());
            if (!$user_id) {
                http_response_code(401);
                echo json_encode(["error" => "Neautorizovaný"]);
                break;
            }

            $token = getallheaders()['Authorization'] ?? '';
            $token = trim(str_replace('Bearer', '', $token));
            $newToken = $auth->regenerateToken($token);

            http_response_code(200);
            echo json_encode($newToken);
            break;
        }



        http_response_code(400);
        echo json_encode(["message" => "Bad request"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        break;
}
