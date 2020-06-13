<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
if(!$user->CheckPermission($_SESSION['odsuser'], "coupon_maken")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
$pdo = Database::DB();
$couponcode = $_POST['couponcode'];
$einddatum = strtotime($_POST['einddatum']);
$filiaal = $_POST['filiaal'];
$soort = $_POST['soort'];
$waarde = $_POST['waarde'];
$type = $_POST['type'];
$min = $_POST['min'];
$eenmalig = $_POST['eenmalig'];
$actief = $_POST['actief'];
$checkdouble = $pdo->prepare("SELECT * FROM `couponcodes` WHERE `code`=:code");
$checkdouble->execute(["code"=>$couponcode]);
if($checkdouble->rowCount() != NULL){
  die('double');
}
$insert = $pdo->prepare("INSERT INTO `couponcodes` (`code`, `einddatum`, `soort`, `waarde`, `min`, `eenmalig`, `filiaal`, `type`, `actief`) VALUES (:code, :einddatum, :soort, :waarde, :min, :eenmalig, :filiaal, :type, :actief)");
$insert->execute(["code"=>$couponcode, "einddatum"=>$einddatum, "soort"=>$soort, "waarde"=>$waarde, "min"=>$min, "eenmalig"=>$eenmalig, "filiaal"=>$filiaal, "type"=>$type, "actief"=>$actief]);
die('ok');
