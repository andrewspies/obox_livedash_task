<?php

use Server\Classes\UserManager\UserManager;

require('../classes/UserManager.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$request = $_SERVER["REQUEST_METHOD"];

function handleRequest($request) {
  switch ($request) {
    case 'GET': 
      $manager = new UserManager();
      $data = $manager->getUsers();
      sendResponse($data);
      break;
    case 'POST':
      $data = json_decode($_REQUEST["body"]);
      print_r($data);
      $manager = new UserManager();
      $user = $manager->createUser($data);
      $manager->storeUser($user);
      sendResponse($data);
      break;
    case 'DELETE':
      $data =  json_decode($_POST);
      $manager = new UserManager();
      $data = $manager->deleteUser($data);
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





