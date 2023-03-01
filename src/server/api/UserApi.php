<?php

use Server\Classes\UserManager\UserManager;

require('../classes/UserManager.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$request = $_SERVER["REQUEST_METHOD"];
$ip = $_SERVER['REMOTE_ADDR'];

switch ($request) {
  case 'GET': 
    $manager = new UserManager();
    $users = $manager->getUsers();
    sendResponse($users);
    break;
  case 'POST':
    $manager = new UserManager();
    $resData = json_decode(file_get_contents("php://input", true));
    $msg = json_encode("[{ 'message': 'User updated' }]");
    $check = $manager->checkUserExists($resData);
    if($check == true) {
      $manager->updateUser($resData);
    } else {
      $manager->storeUser($resData);
      $msg = json_encode("[{ 'message': 'User created' }]");
    }
    sendResponse($msg);
    break;
  default:
    echo 'Invalid request';
    break;
}

function sendResponse($data) {
  $response = array(
    'status_code_header' => 'HTTP/1.1 200 OK', 
    'headers' => ['Content-Type' => 'application/json'], 
    'status' => 200, 
    'message' => 'OK',
    'data' => $data
  );
  echo json_encode($response);
}

