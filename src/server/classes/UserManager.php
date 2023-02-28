<?php

// User Manager class 

namespace Server\Classes;

class UserManager {
  public $name;
  public $email;
  public $time;
  private $db = __DIR__ . '/src/srver/db/users.txt';
  private $user;

  public function CreateUser($name, $email, $time) {
    $this->name = $name;
    $this->email = $email;
    $this->time = $time;

    $this->$user = [
      'name' => $this->name,
      'email' => $this->email,
      'time' => $this->time
    ];
  }

  public function storeUser($user) {
    $file = fopen($db, 'a');
    fwrite($file, $user);
    fclose($file);
  }

  public function deleteUser($user) {
    $info = file_get_contents($db);
    $info = str_replace($user, '', $info);
    file_put_contents($db, $info);
  }

  public function getUsers() {
    $info = file_get_contents($db);
    return explode(PHP_EOL, $info);
  }
  
}