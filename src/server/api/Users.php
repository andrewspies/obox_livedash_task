<?php

use Server\Classes\UserManager;

header("Access-Control-Allow-Origin: *");

$request = $_SERVER['REQUEST_METHOD'];

var_dump($request);

switch ($request) {
  case 'GET': 
    $user = $request['body'];
    $mananger = new UserManager();
    $manager->getUsers();
    break;
  case 'POST':
    $user = $request['body'];
    $mananger = new UserManager();
    $mananger->CreateUser($user);
    break;
  case 'DELETE':
    $user = $request['body'];
    $mananger = new UserManager();
    $mananger->deleteUser($user);
    break;
  default:
    echo 'Invalid request';
    break;
}