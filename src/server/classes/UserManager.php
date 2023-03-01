<?php

// User Manager class 

namespace Server\Classes\UserManager;

class UserManager {
  public $db;

  public function storeUser($user) {
    try {
      if(!$user || $user == "") {
        return;
      }
      $db = "../db/{$user->email}.txt";
      $data = "{$user->name}, {$user->email}, {$user->time}, {$user->status}";
      file_put_contents($db, $data);
      return;

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return;
    }
  }

  public function updateUser($user) {
    try {
      if(!$user) {
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
        array_push($users, explode(PHP_EOL, $file));
      }
      var_dump($users);

      $userList = array();
      foreach($users as $user) {
        if(!$user || $user == "") {
          continue;
        }
        $userInfo = explode(",", $user);
        $name = $userInfo[0];
        $email = $userInfo[1];
        $time = $userInfo[2];
        $status = $userInfo[3];
        array_push($userList, array("name" => trim($name), "email" => trim($email), "time" => trim($time), "status" => trim($status)));
      }
      return $userList;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return;
    }
  }

  private function checkUserExists($user) {
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