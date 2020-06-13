<?php
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
include "../../inc/config.php";
if(!isset($_GET['cid'])){
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
if(!$user->CheckPermission($_SESSION['odsuser'], "coupon_wijzig")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
$pdo = Database::DB();
$getcoupon = $pdo->prepare("SELECT * FROM `couponcodes` WHERE `id`=:id");
$getcoupon->execute(["id"=>$_GET['cid']]);
if($getcoupon->rowCount() == NULL){
  header('HTTP/1.0 403 Forbidden');
  die();
} else {
  $row = $getcoupon->fetch();
}
?>
<input type="hidden" value="<?php echo $row['id']; ?>" name="cid">
<div class="form-group">
  <label>Couponcode</label>
  <div class="input-group">
    <input type="text" id="couponcode" name="couponcode" disabled class="form-control" value="<?php echo $row['code']; ?>">
  </div>
</div>
<div class="form-group">
  <label>Geldig tot</label>
  <input id="datemask" name="einddatum" value="<?php echo date("d-m-Y 23:59", $row['einddatum']); ?>" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy HH:MM" data-mask="" im-insert="false" required>
</div>
<div class="form-group">
  <label>Filiaal</label>
  <select name="filiaal" class="form-control">
    <?php if($row['filiaal'] == "0"){ ?>
      <option value="0" selected>Alle Filialen</option>
    <?php } else { ?>
      <?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_allefilialen")){ ?>
        <option value="0">Alle Filialen</option>
      <?php } ?>
      <?php
      $getfilialen = $pdo->prepare("SELECT * FROM `filialen` ORDER BY `naam`");
      $getfilialen->execute();
      $filialen = $getfilialen->fetchAll();
      foreach($filialen as $filiaal){
        if($user->FiliaalToegang($_SESSION['odsuser'], $filiaal['id'])){
          if($row['filiaal'] == $filiaal['id']){
            echo '<option value="'.$filiaal['id'].'" selected>'.$filiaal['naam'].'</option>';
          } else {
            echo '<option value="'.$filiaal['id'].'">'.$filiaal['naam'].'</option>';
          }
        }
      }
    }
    ?>
  </select>
</div>
<div class="form-group">
  <label>Soort korting</label>
  <select name="soort" class="form-control">
    <option <?php if($row['soort'] == "bedrag"){echo'selected ';} ?>value="bedrag">Vast Bedrag</option>
    <option <?php if($row['soort'] == "procent"){echo'selected ';} ?>value="procent">Percentage op totaalbedrag</option>
  </select>
</div>
<div class="form-group">
  <label>Bedrag / Percentage</label>
  <input name="waarde" value="<?php echo $row['waarde']; ?>" type="text" class="form-control" placeholder="5.50 / 20" required>
</div>
<div class="form-group">
  <label>Afhalen of Bezorgen</label>
  <select name="type" class="form-control">
    <option <?php if($row['type'] == "afhalen"){echo'selected ';} ?>value="afhalen">Afhalen</option>
    <option <?php if($row['type'] == "bezorgen"){echo'selected ';} ?>value="bezorgen">Bezorgen</option>
    <option <?php if($row['type'] == "beide"){echo'selected ';} ?>value="beide">Afhalen en Bezorgen</option>
  </select>
</div>
<div class="form-group">
  <label>Minimaal Bestelbedrag</label>
  <input name="min" value="<?php echo $row['min']; ?>" type="text" class="form-control" placeholder="5.50" required>
</div>
<div class="form-group">
  <label>Eenmalig geldig</label>
  <select name="eenmalig" class="form-control">
    <option <?php if($row['eenmalig'] == "nee"){echo'selected ';} ?>value="nee">Nee</option>
    <option <?php if($row['eenmalig'] == "ja"){echo'selected ';} ?>value="ja">Ja</option>
  </select>
</div>
<div class="form-group">
  <label>Is actief</label>
  <select name="actief" class="form-control">
    <option <?php if($row['actief'] == "ja"){echo'selected ';} ?>value="ja">Ja</option>
    <option <?php if($row['actief'] == "nee"){echo'selected ';} ?>value="nee">Nee</option>
  </select>
</div>
