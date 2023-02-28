<?php

include('../classes/UserManager.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$request = $_SERVER["REQUEST_METHOD"];

$mananger = new UserManager();

function handleRequest($request) {
  switch ($request) {
    case 'GET': 
      $data = $manager->getUsers();
      $this->sendResponse($data);
      break;
    case 'POST':
      $user = $request['body'];
      $data = $mananger->CreateUser($user);
      sendResponse($data);
      break;
    case 'DELETE':
      $user = $request['body'];
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





