<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
$pdo = Database::DB();
if(!isset($_POST['fid'])){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Filialen">');
}
$getfiliaal = $pdo->prepare("SELECT * FROM `filialen` WHERE `id` = :id");
$getfiliaal->execute(["id"=>$_POST['fid']]);
if($getfiliaal->rowCount() == NULL){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Filialen">');
}
if(!$user->FiliaalToegang($_SESSION['odsuser'], $_POST['fid']) AND !$user->CheckPermission($_SESSION['odsuser'], "filialen_all")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Filialen">');
}
if(!$user->CheckPermission($_SESSION['odsuser'], "filialen_openingstijden")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
$Dag = date('d');
$Maand = date('m');
$Jaar = date('Y');
$Uur = date('H');
$Min = date('i');
$Sec = date('s');
$UnixTijd = mktime($Uur, $Min, $Sec, $Maand, $Dag, $Jaar) ;
$filiaalID			= $_POST['fid'];
$afhaalshopOpenUur1		= $_POST['afhaalshopOpenUur1'];
$afhaalShopOpenUur2		= $_POST['afhaalShopOpenUur2'];
echo $afhaalshopOpenUur1."<br />";
$afhaalShopOpenUur3		= $_POST['afhaalShopOpenUur3'];
$afhaalShopOpenUur4		= $_POST['afhaalShopOpenUur4'];
$afhaalShopOpenUur5		= $_POST['afhaalShopOpenUur5'];
$afhaalShopOpenUur6		= $_POST['afhaalShopOpenUur6'];
$afhaalShopOpenUur0		= $_POST['afhaalShopOpenUur0'];
$afhaalShopOpenMin1		= $_POST['afhaalShopOpenMin1'];
$afhaalShopOpenMin2		= $_POST['afhaalShopOpenMin2'];
$afhaalShopOpenMin3		= $_POST['afhaalShopOpenMin3'];
$afhaalShopOpenMin4		= $_POST['afhaalShopOpenMin4'];
$afhaalShopOpenMin5		= $_POST['afhaalShopOpenMin5'];
$afhaalShopOpenMin6		= $_POST['afhaalShopOpenMin6'];
$afhaalShopOpenMin0		= $_POST['afhaalShopOpenMin0'];
$afhaalshopOpenUur1		= $_POST['afhaalshopOpenUur1'];
$afhaalshopOpenUur2		= $_POST['afhaalshopOpenUur2'];
echo $afhaalshopOpenUur2."<br />";
$afhaalshopOpenUur3		= $_POST['afhaalshopOpenUur3'];
$afhaalshopOpenUur4		= $_POST['afhaalshopOpenUur4'];
$afhaalshopOpenUur5		= $_POST['afhaalshopOpenUur5'];
$afhaalshopOpenUur6		= $_POST['afhaalshopOpenUur6'];
$afhaalshopOpenUur0		= $_POST['afhaalshopOpenUur0'];
$afhaalshopOpenMin1		= $_POST['afhaalshopOpenMin1'];
$afhaalshopOpenMin2		= $_POST['afhaalshopOpenMin2'];
$afhaalshopOpenMin3		= $_POST['afhaalshopOpenMin3'];
$afhaalshopOpenMin4		= $_POST['afhaalshopOpenMin4'];
$afhaalshopOpenMin5		= $_POST['afhaalshopOpenMin5'];
$afhaalshopOpenMin6		= $_POST['afhaalshopOpenMin6'];
$afhaalshopOpenMin0		= $_POST['afhaalshopOpenMin0'];
$afhaalday1				= $_POST['afhaalday1'];
$afhaalday2				= $_POST['afhaalday2'];
$afhaalday3				= $_POST['afhaalday3'];
$afhaalday4				= $_POST['afhaalday4'];
$afhaalday5				= $_POST['afhaalday5'];
$afhaalday6				= $_POST['afhaalday6'];
$afhaalday0				= $_POST['afhaalday0'];
$bezorgshopOpenUur1		= $_POST['bezorgshopOpenUur1'];
$bezorgshopOpenUur2		= $_POST['bezorgshopOpenUur2'];
$bezorgshopOpenUur3		= $_POST['bezorgshopOpenUur3'];
$bezorgshopOpenUur4		= $_POST['bezorgshopOpenUur4'];
$bezorgshopOpenUur5		= $_POST['bezorgshopOpenUur5'];
$bezorgshopOpenUur6		= $_POST['bezorgshopOpenUur6'];
$bezorgshopOpenUur0		= $_POST['bezorgshopOpenUur0'];
$bezorgshopOpenMin1		= $_POST['bezorgshopOpenMin1'];
$bezorgshopOpenMin2		= $_POST['bezorgshopOpenMin2'];
$bezorgshopOpenMin3		= $_POST['bezorgshopOpenMin3'];
$bezorgshopOpenMin4		= $_POST['bezorgshopOpenMin4'];
$bezorgshopOpenMin5		= $_POST['bezorgshopOpenMin5'];
$bezorgshopOpenMin6		= $_POST['bezorgshopOpenMin6'];
$bezorgshopOpenMin0		= $_POST['bezorgshopOpenMin0'];
$bezorgshopSluitUur1		= $_POST['bezorgshopSluitUur1'];
$bezorgshopSluitUur2		= $_POST['bezorgshopSluitUur2'];
$bezorgshopSluitUur3		= $_POST['bezorgshopSluitUur3'];
$bezorgshopSluitUur4		= $_POST['bezorgshopSluitUur4'];
$bezorgshopSluitUur5		= $_POST['bezorgshopSluitUur5'];
$bezorgshopSluitUur6		= $_POST['bezorgshopSluitUur6'];
$bezorgshopSluitUur0		= $_POST['bezorgshopSluitUur0'];
$bezorgshopSluitMin1		= $_POST['bezorgshopSluitMin1'];
$bezorgshopSluitMin2		= $_POST['bezorgshopSluitMin2'];
$bezorgshopSluitMin3		= $_POST['bezorgshopSluitMin3'];
$bezorgshopSluitMin4		= $_POST['bezorgshopSluitMin4'];
$bezorgshopSluitMin5		= $_POST['bezorgshopSluitMin5'];
$bezorgshopSluitMin6		= $_POST['bezorgshopSluitMin6'];
$bezorgshopSluitMin0		= $_POST['bezorgshopSluitMin0'];
$bezorgday1				= $_POST['bezorgday1'];
$bezorgday2				= $_POST['bezorgday2'];
$bezorgday3				= $_POST['bezorgday3'];
$bezorgday4				= $_POST['bezorgday4'];
$bezorgday5				= $_POST['bezorgday5'];
$bezorgday6				= $_POST['bezorgday6'];
$bezorgday0				= $_POST['bezorgday0'];
$afhaalshopOpenMaandag	= $afhaalshopOpenUur1 + $afhaalshopOpenMin1 + (120*60);
$afhaalshopOpenDinsdag	= $afhaalshopOpenUur2 + $afhaalshopOpenMin2 + (120*60);
$afhaalshopOpenWoensdag	= $afhaalshopOpenUur3 + $afhaalshopOpenMin3 + (120*60);
$afhaalshopOpenDonderdag	= $afhaalshopOpenUur4 + $afhaalshopOpenMin4 + (120*60);
$afhaalshopOpenVrijdag	= $afhaalshopOpenUur5 + $afhaalshopOpenMin5 + (120*60);
$afhaalshopOpenZaterdag	= $afhaalshopOpenUur6 + $afhaalshopOpenMin6 + (120*60);
$afhaalshopOpenZondag		= $afhaalshopOpenUur0 + $afhaalshopOpenMin0 + (120*60);
$afhaalshopSluitMaandag	= $afhaalshopSluitUur1 + $afhaalshopSluitMin1 + (120*60);
$afhaalshopSluitDinsdag	= $afhaalshopSluitUur2 + $afhaalshopSluitMin2 + (120*60);
$afhaalshopSluitWoensdag	= $afhaalshopSluitUur3 + $afhaalshopSluitMin3 + (120*60);
$afhaalshopSluitDonderdag	= $afhaalshopSluitUur4 + $afhaalshopSluitMin4 + (120*60);
$afhaalshopSluitVrijdag	= $afhaalshopSluitUur5 + $afhaalshopSluitMin5 + (120*60);
$afhaalshopSluitZaterdag	= $afhaalshopSluitUur6 + $afhaalshopSluitMin6 + (120*60);
$afhaalshopSluitZondag	= $afhaalshopSluitUur0 + $afhaalshopSluitMin0 + (120*60);
if($afhaalshopSluitUur1 < $afhaalshopOpenUur1) { $afhaalshopSluitMaandag = $afhaalshopSluitMaandag + 86400; }
if($afhaalshopSluitUur2 < $afhaalshopOpenUur2) { $afhaalshopSluitDinsdag = $afhaalshopSluitDinsdag + 86400; }
if($afhaalshopSluitUur3 < $afhaalshopOpenUur3) { $afhaalshopSluitWoensdag = $afhaalshopSluitWoensdag + 86400; }
if($afhaalshopSluitUur4 < $afhaalshopOpenUur4) { $afhaalshopSluitDonderdag = $afhaalshopSluitDonderdag + 86400; }
if($afhaalshopSluitUur5 < $afhaalshopOpenUur5) { $afhaalshopSluitVrijdag = $afhaalshopSluitVrijdag + 86400; }
if($afhaalshopSluitUur6 < $afhaalshopOpenUur6) { $afhaalshopSluitZaterdag = $afhaalshopSluitZaterdag + 86400; }
if($afhaalshopSluitUur0 < $afhaalshopOpenUur0) { $afhaalshopSluitZondag = $afhaalshopSluitZondag + 86400; }
$bezorgshopOpenMaandag	= $bezorgshopOpenUur1 + $bezorgshopOpenMin1 + (120*60);
$bezorgshopOpenDinsdag	= $bezorgshopOpenUur2 + $bezorgshopOpenMin2 + (120*60);
$bezorgshopOpenWoensdag	= $bezorgshopOpenUur3 + $bezorgshopOpenMin3 + (120*60);
$bezorgshopOpenDonderdag	= $bezorgshopOpenUur4 + $bezorgshopOpenMin4 + (120*60);
$bezorgshopOpenVrijdag	= $bezorgshopOpenUur5 + $bezorgshopOpenMin5 + (120*60);
$bezorgshopOpenZaterdag	= $bezorgshopOpenUur6 + $bezorgshopOpenMin6 + (120*60);
$bezorgshopOpenZondag		= $bezorgshopOpenUur0 + $bezorgshopOpenMin0 + (120*60);
$bezorgshopSluitMaandag	= $bezorgshopSluitUur1 + $bezorgshopSluitMin1 + (120*60);
$bezorgshopSluitDinsdag	= $bezorgshopSluitUur2 + $bezorgshopSluitMin2 + (120*60);
$bezorgshopSluitWoensdag	= $bezorgshopSluitUur3 + $bezorgshopSluitMin3 + (120*60);
$bezorgshopSluitDonderdag	= $bezorgshopSluitUur4 + $bezorgshopSluitMin4 + (120*60);
$bezorgshopSluitVrijdag	= $bezorgshopSluitUur5 + $bezorgshopSluitMin5 + (120*60);
$bezorgshopSluitZaterdag	= $bezorgshopSluitUur6 + $bezorgshopSluitMin6 + (120*60);
$bezorgshopSluitZondag	= $bezorgshopSluitUur0 + $bezorgshopSluitMin0 + (120*60);
if($bezorgshopSluitUur1 < $bezorgshopOpenUur1) { $bezorgshopSluitMaandag = $bezorgshopSluitMaandag + 86400; }
if($bezorgshopSluitUur2 < $bezorgshopOpenUur2) { $bezorgshopSluitDinsdag = $bezorgshopSluitDinsdag + 86400; }
if($bezorgshopSluitUur3 < $bezorgshopOpenUur3) { $bezorgshopSluitWoensdag = $bezorgshopSluitWoensdag + 86400; }
if($bezorgshopSluitUur4 < $bezorgshopOpenUur4) { $bezorgshopSluitDonderdag = $bezorgshopSluitDonderdag + 86400; }
if($bezorgshopSluitUur5 < $bezorgshopOpenUur5) { $bezorgshopSluitVrijdag = $bezorgshopSluitVrijdag + 86400; }
if($bezorgshopSluitUur6 < $bezorgshopOpenUur6) { $bezorgshopSluitZaterdag = $bezorgshopSluitZaterdag + 86400; }
if($bezorgshopSluitUur0 < $bezorgshopOpenUur0) { $bezorgshopSluitZondag = $bezorgshopSluitZondag + 86400; }
$afhalen = $pdo->prepare("UPDATE `openingstijdenafhalen` SET `shopGeopendMaandag`=:dag, `shopOpenMaandag`=:open, `shopSluitMaandag`=:sluit WHERE `fid`=:fid");
$afhalen->execute(["dag"=>$afhaalday1, "open"=>$afhaalshopOpenMaandag, "sluit"=>$afhaalshopSluitMaandag, "fid"=>$filiaalID]);
echo $afhaalshopOpenMaandag."<br />";
echo $afhaalshopSluitMaandag."<br />";
$afhalen = $pdo->prepare("UPDATE `openingstijdenafhalen` SET `shopGeopendDinsdag`=:dag, `shopOpenDinsdag`=:open, `shopSluitDinsdag`=:sluit WHERE `fid`=:fid");
$afhalen->execute(["dag"=>$afhaalday2, "open"=>$afhaalshopOpenDinsdag, "sluit"=>$afhaalshopSluitDinsdag, "fid"=>$filiaalID]);
$afhalen = $pdo->prepare("UPDATE `openingstijdenafhalen` SET `shopGeopendWoensdag`=:dag, `shopOpenWoensdag`=:open, `shopSluitWoensdag`=:sluit WHERE `fid`=:fid");
$afhalen->execute(["dag"=>$afhaalday3, "open"=>$afhaalshopOpenWoensdag, "sluit"=>$afhaalshopSluitWoensdag, "fid"=>$filiaalID]);
$afhalen = $pdo->prepare("UPDATE `openingstijdenafhalen` SET `shopGeopendDonderdag`=:dag, `shopOpenDonderdag`=:open, `shopSluitDonderdag`=:sluit WHERE `fid`=:fid");
$afhalen->execute(["dag"=>$afhaalday4, "open"=>$afhaalshopOpenDonderdag, "sluit"=>$afhaalshopSluitDonderdag, "fid"=>$filiaalID]);
$afhalen = $pdo->prepare("UPDATE `openingstijdenafhalen` SET `shopGeopendVrijdag`=:dag, `shopOpenVrijdag`=:open, `shopSluitVrijdag`=:sluit WHERE `fid`=:fid");
$afhalen->execute(["dag"=>$afhaalday5, "open"=>$afhaalshopOpenVrijdag, "sluit"=>$afhaalshopSluitVrijdag, "fid"=>$filiaalID]);
$afhalen = $pdo->prepare("UPDATE `openingstijdenafhalen` SET `shopGeopendZaterdag`=:dag, `shopOpenZaterdag`=:open, `shopSluitZaterdag`=:sluit WHERE `fid`=:fid");
$afhalen->execute(["dag"=>$afhaalday6, "open"=>$afhaalshopOpenZaterdag, "sluit"=>$afhaalshopSluitZaterdag, "fid"=>$filiaalID]);
$afhalen = $pdo->prepare("UPDATE `openingstijdenafhalen` SET `shopGeopendZondag`=:dag, `shopOpenZondag`=:open, `shopSluitZondag`=:sluit WHERE `fid`=:fid");
$afhalen->execute(["dag"=>$afhaalday0, "open"=>$afhaalshopOpenZondag, "sluit"=>$afhaalshopSluitZondag, "fid"=>$filiaalID]);
$bezorgen = $pdo->prepare("UPDATE `openingstijdenbezorgen` SET `shopGeopendMaandag`=:dag, `shopOpenMaandag`=:open, `shopSluitMaandag`=:sluit WHERE `fid`=:fid");
$bezorgen->execute(["dag"=>$bezorgday1, "open"=>$bezorgshopOpenMaandag, "sluit"=>$bezorgshopSluitMaandag, "fid"=>$filiaalID]);
$bezorgen = $pdo->prepare("UPDATE `openingstijdenbezorgen` SET `shopGeopendDinsdag`=:dag, `shopOpenDinsdag`=:open, `shopSluitDinsdag`=:sluit WHERE `fid`=:fid");
$bezorgen->execute(["dag"=>$bezorgday2, "open"=>$bezorgshopOpenDinsdag, "sluit"=>$bezorgshopSluitDinsdag, "fid"=>$filiaalID]);
$bezorgen = $pdo->prepare("UPDATE `openingstijdenbezorgen` SET `shopGeopendWoensdag`=:dag, `shopOpenWoensdag`=:open, `shopSluitWoensdag`=:sluit WHERE `fid`=:fid");
$bezorgen->execute(["dag"=>$bezorgday3, "open"=>$bezorgshopOpenWoensdag, "sluit"=>$bezorgshopSluitWoensdag, "fid"=>$filiaalID]);
$bezorgen = $pdo->prepare("UPDATE `openingstijdenbezorgen` SET `shopGeopendDonderdag`=:dag, `shopOpenDonderdag`=:open, `shopSluitDonderdag`=:sluit WHERE `fid`=:fid");
$bezorgen->execute(["dag"=>$bezorgday4, "open"=>$bezorgshopOpenDonderdag, "sluit"=>$bezorgshopSluitDonderdag, "fid"=>$filiaalID]);
$bezorgen = $pdo->prepare("UPDATE `openingstijdenbezorgen` SET `shopGeopendVrijdag`=:dag, `shopOpenVrijdag`=:open, `shopSluitVrijdag`=:sluit WHERE `fid`=:fid");
$bezorgen->execute(["dag"=>$bezorgday5, "open"=>$bezorgshopOpenVrijdag, "sluit"=>$bezorgshopSluitVrijdag, "fid"=>$filiaalID]);
$bezorgen = $pdo->prepare("UPDATE `openingstijdenbezorgen` SET `shopGeopendZaterdag`=:dag, `shopOpenZaterdag`=:open, `shopSluitZaterdag`=:sluit WHERE `fid`=:fid");
$bezorgen->execute(["dag"=>$bezorgday6, "open"=>$bezorgshopOpenZaterdag, "sluit"=>$bezorgshopSluitZaterdag, "fid"=>$filiaalID]);
$bezorgen = $pdo->prepare("UPDATE `openingstijdenbezorgen` SET `shopGeopendZondag`=:dag, `shopOpenZondag`=:open, `shopSluitZondag`=:sluit WHERE `fid`=:fid");
$bezorgen->execute(["dag"=>$bezorgday0, "open"=>$bezorgshopOpenZondag, "sluit"=>$bezorgshopSluitZondag, "fid"=>$filiaalID]);
?>
