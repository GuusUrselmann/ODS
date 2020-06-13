<?php
include "../../inc/config.php";
if(!isset($_POST['username'])){
  header('HTTP/1.0 400 Bad Request');
  die();
}
if(!isset($_POST['password'])){
  header('HTTP/1.0 400 Bad Request');
  die();
}
$user = new User();
$username = $_POST['username'];
$password = $_POST['password'];
if($user->CheckPassword($username, $password)){
  echo "ok";
  $_SESSION['odsuser'] = $user->GetUserId($username);
} else {
  echo "error";
}
?>
