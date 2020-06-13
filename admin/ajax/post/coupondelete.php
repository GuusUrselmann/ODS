<?php
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
include "../../inc/config.php";
$user = new User();
if(!$user->CheckPermission($_SESSION['odsuser'], "coupon_verwijderen")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
$pdo = Database::DB();
if(isset($_POST["id"]))
{
  $del = $pdo->prepare("DELETE FROM `couponcodes` WHERE `id`=:id");
  $del->execute(["id"=>$_POST["id"]]);
}
?>
