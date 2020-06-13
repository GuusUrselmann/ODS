<?php
if(!isset($config)){
  header("HTTP/1.0 404 Not Found");
  die();
}
class User {
  function CheckLogin() {
    if(!isset($_SESSION['odsuser'])){
      header( "refresh:0;url=".adminurl."/Login" );
      die();
    }
  }
  function CodePassword($password){
    $password = $password;
    $options = [
      'cost' => 11,
    ];
    $coded = password_hash($password, PASSWORD_BCRYPT, $options);
    return $coded;
  }
  function CheckPassword($username, $password){
    $pdo = Database::DB();
    $getuser = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
    $getuser->execute(["username"=>$username]);
    if($getuser->rowCount() == NULL){
      return FALSE;
    } else {
      $user = $getuser->fetch();
      if (password_verify($password, $user['password'])) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }
  function GetUserId($username){
    $pdo = Database::DB();
    $getuser = $pdo->prepare("SELECT * FROM `users` WHERE `username`=:username");
    $getuser->execute(["username"=>$username]);
    if($getuser->rowCount() == NULL){
      return "error";
    } else {
      $user = $getuser->fetch();
      return $user['id'];
    }
  }
  function GetFullName($userid){
    $pdo = Database::DB();
    $getuser = $pdo->prepare("SELECT * FROM `users` WHERE `id`=:id");
    $getuser->execute(["id"=>$userid]);
    if($getuser->rowCount() == NULL){
      return "error";
    } else {
      $user = $getuser->fetch();
      return $user['fullname'];
    }
  }
  function FiliaalToegang($uid,$fid){
    $pdo = Database::DB();
    $getuser = $pdo->prepare("SELECT * FROM `users_filialen` WHERE `uid`=:uid AND `fid`=:fid");
    $getuser->execute(["uid"=>$uid, "fid"=>$fid]);
    if($getuser->rowCount() == NULL){
      return FALSE;
    } else {
      return TRUE;
    }
  }
  function CheckPermission($uid, $perm){
    $pdo = Database::DB();
    $getuser = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :uid");
    $getuser->execute(["uid"=>$uid]);
    if($getuser->rowCount() == NULL){
      return FALSE;
    } else {
      $user = $getuser->fetch();
      $checkforuser = $pdo->prepare("SELECT * FROM `perms_user` WHERE `uid`=:uid AND `perm`=:perm");
      $checkforuser->execute(["uid"=>$uid, "perm"=>$perm]);
      if($checkforuser->rowCount() != NULL){
        $userperm = "1";
      }
      $checkforgroup = $pdo->prepare("SELECT * FROM `perms_groups` WHERE `gid`=:gid AND `perm`=:perm");
      $checkforgroup->execute(["gid"=>$user['groep'], "perm"=>$perm]);
      if($checkforgroup->rowCount() != NULL){
        $groupperm = "1";
      }
      if(isset($groupperm) OR isset($userperm)){
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }
  function CheckUserPermission($uid, $perm){
    $pdo = Database::DB();
    $getuser = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :uid");
    $getuser->execute(["uid"=>$uid]);
    if($getuser->rowCount() == NULL){
      return FALSE;
    } else {
      $user = $getuser->fetch();
      $checkforuser = $pdo->prepare("SELECT * FROM `perms_user` WHERE `uid`=:uid AND `perm`=:perm");
      $checkforuser->execute(["uid"=>$uid, "perm"=>$perm]);
      if($checkforuser->rowCount() != NULL){
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }
  function CheckGroupPermission($gid, $perm){
    $pdo = Database::DB();
    $checkforgroup = $pdo->prepare("SELECT * FROM `perms_groups` WHERE `gid`=:gid AND `perm`=:perm");
    $checkforgroup->execute(["gid"=>$gid, "perm"=>$perm]);
    if($checkforgroup->rowCount() != NULL){
      return TRUE;
    } else {
      return FALSE;
    }
  }
  function RandomCode($length = 50) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}
?>
