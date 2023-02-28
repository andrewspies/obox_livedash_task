<?php

// User Manager class 

namespace Server\Classes\UserManager;

class UserManager {
  public $db;

  public function storeUser($user) {
    try {
      $db = "../db/users.txt";
      $existingUsers = $this->getUsers($user);
      $data = "{$user->name}, {$user->email}, {$user->time}, {$user->ip}, {$user->status}\n";
      
      // if user exists, find and update
      if($existingUsers) {
        foreach($existingUsers as $existingUser) {
          if($existingUser["email"] == $user->email) {
            $info = file_get_contents($db);
            if(strpos($info, $user->email)) {
              $oldData = implode(", ", $existingUser);
              $contents = str_replace($existingUser, $data, $info);
            };
            file_put_contents($db, $contents);
            return;
          }
        }
      }

      $file = fopen($db, "a");
      fwrite($file, $data);
      fclose($file);
      return;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return;
    }
  }

  public function deleteUser($user) {
    try {
      $data = "{$user->name}, {$user->email}, {$user->password}, {$user->ip}, inActive";
      $db = "../db/users.txt";
      $info = file_get_contents($db);
      $contents = str_replace($data, "", $info);
      file_put_contents($db, $contents);
      return;
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

  private function generateUID() {
    $uid = md5(uniqid(rand(), true));
    return $uid;
  }
}