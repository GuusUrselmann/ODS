<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
if(!$user->CheckPermission($_SESSION['odsuser'], "coupon_wijzig")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
$pdo = Database::DB();
$cid = $_POST['cid'];
$einddatum = strtotime($_POST['einddatum']);
$filiaal = $_POST['filiaal'];
$soort = $_POST['soort'];
$waarde = $_POST['waarde'];
$type = $_POST['type'];
$min = $_POST['min'];
$eenmalig = $_POST['eenmalig'];
$actief = $_POST['actief'];
$update = $pdo->prepare("UPDATE `couponcodes` SET `einddatum`=:einddatum, `soort`=:soort, `waarde`=:waarde, `min`=:min, `eenmalig`=:eenmalig, `filiaal`=:filiaal, `type`=:type, `actief`=:actief WHERE `id`=:id");
$update->execute(["einddatum"=>$einddatum, "soort"=>$soort, "waarde"=>$waarde, "min"=>$min, "eenmalig"=>$eenmalig, "filiaal"=>$filiaal, "type"=>$type, "actief"=>$actief, "id"=>$cid]);
