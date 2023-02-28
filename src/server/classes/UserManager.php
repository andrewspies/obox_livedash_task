<?php

// User Manager class 

namespace Server\Classes\UserManager;

class UserManager {
  public $db;

  public function storeUser($user) {
    try {
      $data = "{$user->name}, {$user->email}, {$user->time}";
      $db = "../db/users.txt";
      $file = fopen($db, "a");
      fwrite($file, $data);
      fclose($file);
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public function deleteUser($user) {
    try {
      $data = "{$user['name']}, {$user['email']}, {$user['password']}";
      $db = '../db/users.txt';
      $info = file_get_contents($db);
      $contents = str_replace($user, '', $data);
      file_put_contents($db, $contents);
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public function getUsers() {
    try {
      $db = '../db/users.txt';
      $info = file_get_contents($db);
      return explode(PHP_EOL, $info);
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }
}