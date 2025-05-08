<?php
require_once(__DIR__ . '/../config.php');
require_once('Auth.class.php');

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username'], $data['password'])) {
    http_response_code(400);
    echo json_encode(["error" => "Zadaj meno a heslo"]);
    exit;
}

$auth = new Auth($db);
$response = $auth->login($data['username'], $data['password']);

if (isset($response['error'])) {
    http_response_code(401);
}
echo json_encode($response);
