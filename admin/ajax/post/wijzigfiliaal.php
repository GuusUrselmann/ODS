<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
if(!$user->CheckPermission($_SESSION['odsuser'], "filialen_wijzig")){
  header('HTTP/1.0 400 Bad Request');
  die();
}
if(!isset($_POST['fid'])){
  header('HTTP/1.0 400 Bad Request');
  die();
}
if(!$user->FiliaalToegang($_SESSION['odsuser'], $_POST['fid']) AND !$user->CheckPermission($_SESSION['odsuser'], "filialen_all")){
  header('HTTP/1.0 400 Bad Request');
  die();
}
$pdo = Database::DB();
$getfiliaal = $pdo->prepare("SELECT * FROM `filialen` WHERE `id` = :id");
$getfiliaal->execute(["id"=>$_POST['fid']]);
if($getfiliaal->rowCount() == NULL){
  header('HTTP/1.0 400 Bad Request');
  die();
}
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
foreach($_POST as $key => $value)
{
  if($key != "fid"){
    $update = $pdo->prepare("UPDATE `filialen` SET `".$key."` = :value WHERE `id` = :id");
    $update->execute(["value"=>$value, "id"=>$_POST['fid']]);
  }
}
