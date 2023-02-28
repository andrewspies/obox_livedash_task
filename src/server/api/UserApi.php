<?php

include_once '../classes/UserManager.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$request = $_SERVER["REQUEST_METHOD"];

function handleRequest($request) {
  switch ($request) {
    case 'GET': 
      $mananger = new UserManager();
      $data = $manager->getUsers();
      $this->sendResponse($data);
      break;
    case 'POST':
      $user = $request['body'];
      $mananger = new UserManager();
      $data = $mananger->CreateUser($user);
      sendResponse($data);
      break;
    case 'DELETE':
      $user = $request['body'];
      $mananger = new UserManager();
      $data = $mananger->deleteUser($user);
      sendResponse($data);
      break;
    default:
      echo 'Invalid request';
      break;
  }
}

function sendResponse($data) {
  $response = ['status_code_header' => 'HTTP/1.1 200 OK', 'body' => json_encode($data)];
  var_dump($response);
  return $response;
}

handleRequest($request);





