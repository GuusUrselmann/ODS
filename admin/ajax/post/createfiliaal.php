<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
if(!$user->CheckPermission($_SESSION['odsuser'], "filialen_nieuw")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
$pdo = Database::DB();
$naam = $_POST['naam'];

$insert = $pdo->prepare("INSERT INTO `filialen` (`naam`) VALUES (:naam)");
$insert->execute(["naam"=>$naam]);
$lastid = $pdo->lastInsertId();
$manage = $pdo->prepare("INSERT INTO `users_filialen` (`uid`, `fid`) VALUES (:uid, :fid)");
$manage->execute(["uid"=>$_SESSION['odsuser'], "fid"=>$lastid]);
die('ok');
