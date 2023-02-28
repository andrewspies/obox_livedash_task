<?php

// User Manager class 

namespace Server\Classes\UserManager;

class UserManager {
  public $name;
  public $email;
  public $time;
  private $db;
  private $user;

  public function createUser($user) {
    $this->name = $user["name"];
    $this->email = $user["email"];
    $this->time = $user["time"];

    $this->$user = [
      "name" => $this->name,
      "email" => $this->email,
      "time" => $this->time
    ];
  }

  public function storeUser($user) {
    $db = '../db/users.txt';
    $file = fopen($db, 'a');
    fwrite($file, $user);
    fclose($file);
  }

  public function deleteUser($user) {
    $db = '../db/users.txt';
    $info = file_get_contents($db);
    $info = str_replace($user, '', $info);
    file_put_contents($db, $info);
  }

  public function getUsers() {
    $db = '../db/users.txt';
    $info = file_get_contents($db);
    return explode(PHP_EOL, $info);
  }
  
}