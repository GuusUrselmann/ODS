<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
if(!$user->CheckPermission($_SESSION['odsuser'], "perms_groups")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
if(!isset($_POST['gid'])){
  header('HTTP/1.0 400 Bad Request');
  die();
}
if(!isset($_POST['groupnaam'])){
  header('HTTP/1.0 400 Bad Request');
  die();
}
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
$group = $_POST['gid'];
$updatename = $pdo->prepare("UPDATE `groups` SET `naam`=:naam WHERE `id`=:gid");
$updatename->execute(["naam"=>$_POST['groupnaam'], "gid"=>$group]);
$delete = $pdo->prepare("DELETE FROM `perms_groups` WHERE `gid` = :gid");
$delete->execute(["gid"=>$group]);
$getpermgroup = $pdo->prepare("SELECT * FROM `perms` GROUP BY `cat`");
$getpermgroup->execute();
$perms = $getpermgroup->fetchAll();
foreach($perms as $pg){
  $aan = $_POST[$pg['cat']];
  foreach($aan as $keuze){
    $insert = $pdo->prepare("INSERT INTO `perms_groups` (`gid`, `perm`) VALUES (:gid, :perm)");
    $insert->execute(["gid"=>$group, "perm"=>$keuze]);
  }
}
