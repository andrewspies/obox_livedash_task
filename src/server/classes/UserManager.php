<?php

// User Manager class 

namespace Server\Classes\UserManager;

class UserManager {
  public $db;

  public function storeUser($user) {
    try {
      $data = "{$user->name}, {$user->email}, {$user->time} \n";
      $db = "../db/users.txt";
      $file = fopen($db, "a");
      fwrite($file, $data);
      fclose($file);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function deleteUser($user) {
    try {
      $data = "{$user->name}, {$user->email}, {$user->password}";
      $db = "../db/users.txt";
      $info = file_get_contents($db);
      $contents = str_replace($data, "", $info);
      file_put_contents($db, $contents);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function getUsers() {
    try {
      $db = "../db/users.txt";
      $info = file_get_contents($db);
      $users = explode(PHP_EOL, $info);
      $userList = array();
      foreach($users as $user) {
        if(!$user || $user == "") {
          continue;
        }
        $userInfo = explode(",", $user);
        $name = $userInfo[0];
        $email = $userInfo[1];
        $time = $userInfo[2];
        array_push($userList, array("name" => trim($name), "email" => trim($email), "time" => trim($time)));
      }
      return $userList;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}