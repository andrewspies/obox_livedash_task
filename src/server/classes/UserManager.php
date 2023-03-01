<?php

// User Manager class 

namespace Server\Classes\UserManager;

class UserManager {
  public $db;

  public function storeUser($user) {
    try {
      if(!isset($user)) {
        return;
      }
      $db = "../db/{$user->email}.txt";
      $data = "{$user->name}, {$user->email}, {$user->time}, {$user->status}";
      file_put_contents($db, $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return;
    }
  }

  public function updateUser($user) {
    try {
      if(!isset($user)) {
        return;
      }
      $db = "../db/{$user->email}.txt";
      $data = "{$user->name}, {$user->email}, {$user->time}, {$user->status}";
      $contents = file_get_contents($db);
      $contents = str_replace($contents, $data, $contents);
      file_put_contents($db, $contents);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return;
    }
  }

  public function getUsers() {
    try {
      $files = scandir("../db/");
      $users = array();
      foreach($files as $file) {
        if($file == "." || $file == "..") {
          continue;
        }
        $fileData = file_get_contents("../db/{$file}");
        array_push($users, explode(PHP_EOL, $fileData));
      }
      $userList = array();
      foreach($users as $user) {
        if(!$user[0] || $user[0] === "") {
          continue;
        }
        $info = explode(", ", $user[0]);
        $name = $info[0];
        $email = $info[1];
        $time = $info[2];
        $status = $info[3];
        array_push($userList, array("name" => trim($name), "email" => trim($email), "time" => trim($time), "status" => trim($status)));
      }
      return $userList;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return;
    }
  }

  public function checkUserExists($user) {
    $existingUsers = $this->getUsers();
    foreach($existingUsers as $olduser) {
      if($olduser["email"] === $user->email) {
        return true;
      } else {
        return false;
      }
    }
  }

}