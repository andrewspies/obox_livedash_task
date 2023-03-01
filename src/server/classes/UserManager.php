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
      $db = "../db/users.txt";
      $data = "{$user->name}, {$user->email}, {$user->time}, {$user->status}\n";

      // if user exists, find and update
      if($this->checkUserExists($user)) {
        $lines = file($db);
        foreach($lines as $line) {
          if(str_contains($line, $user->email) !== false) {
            $contents = file_get_contents($db);
            $contents = str_replace($line, $data, $contents);
            file_put_contents($db, $contents);
          }
        }
        return;
      } else {
        $file = fopen($db, "a");
        fwrite($file, $data);
        fclose($file);
        return;
      }
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
      $db = "../db/users.txt";
      $data = "{$user->name}, {$user->email}, {$user->time}, {$user->status}\n";

      // if user exists, find and update
      if($this->checkUserExists($user)) {
        $lines = file($db);
        foreach($lines as $line) {
          if(str_contains($line, $user->email) !== false) {
            $contents = file_get_contents($db);
            $contents = str_replace($line, $data, $contents);
            file_put_contents($db, $contents);
          }
        }
        return;
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return;
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

  private function generateUID() {
    $uid = md5(uniqid(rand(), true));
    return $uid;
  }
}