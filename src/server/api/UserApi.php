<?php

use Server\Classes\UserManager\UserManager;

require('../classes/UserManager.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$request = $_SERVER["REQUEST_METHOD"];

switch ($request) {
  case 'GET': 
    $manager = new UserManager();
    $users = $manager->getUsers();
    sendResponse($users);
    break;
  case 'POST':
    $manager = new UserManager();
    $resData = json_decode(file_get_contents("php://input", true));
    $manager->storeUser($resData);
    $msg = json_encode("[{ 'message': 'User created' }]");
    sendResponse($msg);
    break;
  case 'DELETE':
    $manager = new UserManager();
    $resData = json_decode(file_get_contents("php://input", true));
    $manager->deleteUser($resData);
    $msg = json_encode("[{'message': 'User deleted'}]");
    sendResponse($msg);
    break;
  default:
    echo 'Invalid request';
    break;
}

function sendResponse($data) {
  $response = ['status_code_header' => 'HTTP/1.1 200 OK', 'body' => json_encode($data)];
  return $response;
}

