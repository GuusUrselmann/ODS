<?php
if(!isset($config)){
  header("HTTP/1.0 404 Not Found");
  die();
}
class System {
  function GetGroupName($gid){
    $pdo = Database::DB();
    $getuser = $pdo->prepare("SELECT * FROM `groups` WHERE `id`=:gid");
    $getuser->execute(["gid"=>$gid]);
    if($getuser->rowCount() == NULL){
      return "error";
    } else {
      $user = $getuser->fetch();
      return $user['naam'];
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
