<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
if(!isset($_POST['uid'])){
  header('HTTP/1.0 400 Bad Request');
  die();
}
if(!isset($_POST['fullname'])){
  header('HTTP/1.0 400 Bad Request');
  die();
}
$user = new User();
if(!$user->CheckPermission($_SESSION['odsuser'], "perms_groups")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
$uid = $_POST['uid'];
$updatename = $pdo->prepare("UPDATE `users` SET `fullname`=:fullname WHERE `id`=:uid");
$updatename->execute(["fullname"=>$_POST['fullname'], "uid"=>$uid]);
$deletefilialen = $pdo->prepare("DELETE FROM `users_filialen` WHERE `uid`=:uid");
$deletefilialen->execute(["uid"=>$uid]);
$filialen = $_POST['filialenbeheer'];
foreach($filialen as $fil){
  $insert = $pdo->prepare("INSERT INTO `users_filialen` (`uid`, `fid`) VALUES (:uid, :fid)");
  $insert->execute(["uid"=>$uid, "fid"=>$fil]);
}
$delete = $pdo->prepare("DELETE FROM `perms_user` WHERE `uid` = :uid");
$delete->execute(["uid"=>$uid]);
$getpermgroup = $pdo->prepare("SELECT * FROM `perms` GROUP BY `cat`");
$getpermgroup->execute();
$perms = $getpermgroup->fetchAll();
foreach($perms as $pg){
  $aan = $_POST[$pg['cat']];
  print_r($aan);
  foreach($aan as $keuze){
    echo $keuze;
    $insert = $pdo->prepare("INSERT INTO `perms_user` (`uid`, `perm`) VALUES (:uid, :perm)");
    $insert->execute(["uid"=>$uid, "perm"=>$keuze]);
  }
}
