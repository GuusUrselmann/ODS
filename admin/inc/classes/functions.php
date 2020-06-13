<?php
if(!isset($config)){
  header("HTTP/1.0 404 Not Found");
  die();
}
function openingstijdenafhalen($daySelected, $fid) {
  $pdo = Database::DB();
  $tijden = $pdo->prepare("SELECT * FROM `openingstijdenafhalen` WHERE `fid` = :fid");
  $tijden->execute(["fid"=>$fid]);
  $row = $tijden->fetch(PDO::FETCH_BOTH);
  echo $shopOpenMaandag;
  $shopOpenMaandag		= $row[2];
  $shopSluitMaandag		= $row[3];
  $shopOpenDinsdag		= $row[4];
  $shopSluitDinsdag		= $row[5];
  $shopOpenWoensdag		= $row[6];
  $shopSluitWoensdag		= $row[7];
  $shopOpenDonderdag		= $row[8];
  $shopSluitDonderdag		= $row[9];
  $shopOpenVrijdag		= $row[10];
  $shopSluitVrijdag		= $row[11];
  $shopOpenZaterdag		= $row[12];
  $shopSluitZaterdag		= $row[13];
  $shopOpenZondag			= $row[14];
  $shopSluitZondag		= $row[15];
  $shopGeopendMaandag		= $row[16];
  $shopGeopendDinsdag		= $row[17];
  $shopGeopendWoensdag	= $row[18];
  $shopGeopendDonderdag	= $row[19];
  $shopGeopendVrijdag		= $row[20];
  $shopGeopendZaterdag	= $row[21];
  $shopGeopendZondag		= $row[22];
  $shopBereidingsTijd		= $row[23];
  $shopTijdVak			= $row[24];
  $shopDaysBefore			= $row[25];
  $Dag = date('d');
  $Maand = date('m');
  $Jaar = date('Y');
  $Uur = date('H');
  $Min = date('i');
  $Sec = date('s');
  $UnixTijd = mktime($Uur, $Min, $Sec, $Maand, $Dag, $Jaar) ;
  $actueleDagNR = date('w', $UnixTijd);
  $dagnaam[1]="Maandag";
  $dagnaam[2]="Dinsdag";
  $dagnaam[3]="Woensdag";
  $dagnaam[4]="Donderdag";
  $dagnaam[5]="Vrijdag";
  $dagnaam[6]="Zaterdag";
  $dagnaam[0]="Zondag";
  if($daySelected == 1) { $dayNR= 1; $day = $shopGeopendMaandag; $shopOpenUnix = $shopOpenMaandag; $shopSluitUnix = $shopSluitMaandag; }
  if($daySelected == 2) { $dayNR= 2; $day = $shopGeopendDinsdag; $shopOpenUnix = $shopOpenDinsdag; $shopSluitUnix = $shopSluitDinsdag; }
  if($daySelected == 3) { $dayNR= 3; $day = $shopGeopendWoensdag; $shopOpenUnix = $shopOpenWoensdag; $shopSluitUnix = $shopSluitWoensdag; }
  if($daySelected == 4) { $dayNR= 4; $day = $shopGeopendDonderdag; $shopOpenUnix = $shopOpenDonderdag; $shopSluitUnix = $shopSluitDonderdag; }
  if($daySelected == 5) { $dayNR= 5; $day = $shopGeopendVrijdag; $shopOpenUnix = $shopOpenVrijdag; $shopSluitUnix = $shopSluitVrijdag; }
  if($daySelected == 6) { $dayNR= 6; $day = $shopGeopendZaterdag; $shopOpenUnix = $shopOpenZaterdag; $shopSluitUnix = $shopSluitZaterdag; }
  if($daySelected == 0) { $dayNR= 0; $day = $shopGeopendZondag; $shopOpenUnix = $shopOpenZondag; $shopSluitUnix = $shopSluitZondag; }
  $shopOpenUur = date('H', $shopOpenUnix - (60*60));
  $shopOpenMin = date('i', $shopOpenUnix - (60*60));
  $shopSluitUur = date('H', $shopSluitUnix - (60*60));
  $shopSluitMin = date('i', $shopSluitUnix - (60*60));
  echo '<div class="row">';
  echo '
  <div class="col-sm-3"><p>'.$dagnaam[$daySelected].'</p></div>
  ';
  echo '
  <div class="col-sm-3">
  <div class="form-group">
  <select class="form-control" name="afhaalday' . $daySelected . '">';
  if($day){ echo '<option selected value="1">Open</option><option value="0">Gesloten</option>'; } else { echo '<option value="1">Open</option><option selected value="0">Gesloten</option>'; }
  echo '
  </select>
  </div>
  </div>
  ';
  echo '<div id="dayTimes' . $daySelected . '" style="float: left; margin-left: 10px;">';
  echo '<select id="afhaalfilialentijdenOpenUur' . $dayNR . '" name="afhaalshopOpenUur' . $dayNR . '" class="form-control-sm">';
  $i = 0;
  while ($i <= (23) ):
    if($i <10) { $i = '0' . $i; }
    if($shopOpenUur == $i) { echo '<option selected value="'.mktime($i, '0', '0', '1', '1', '1970').'">'. $i . '</option>'; } else { echo '<option value="'.mktime($i, '0', '0', '1', '1', '1970').'">'. $i . '</option>'; }
    $i++;
  endwhile;
  echo '</select>';
  echo '&nbsp;<strong>:</strong>&nbsp;';
  echo '<select id="afhaalfilialentijdenOpenMin' . $dayNR . '" name="afhaalshopOpenMin' . $dayNR . '" class="form-control-sm">';
  $i = 0;
  while ($i <= (59) ):
    if($i <10) { $i = '0' . $i; }
    if($shopOpenMin == $i) { echo '<option selected value="'.mktime('0', $i, '0', '1', '1', '1970').'">'. $i . '</option>'; } else { echo '<option value="'.mktime('0', $i, '0', '1', '1', '1970').'">'. $i . '</option>'; }
    $i++;
  endwhile;
  echo '</select>';
  echo '&nbsp;&nbsp;tot&nbsp;&nbsp;';
  echo '<select id="afhaalfilialentijdenSluitUur' . $dayNR . '" name="afhaalshopSluitUur' . $dayNR . '" class="form-control-sm">';
  $i = 0;
  while ($i <= (23) ):
    if($i <10) { $i = '0' . $i; }
    if($shopSluitUur == $i) { echo '<option selected value="'.mktime($i, '0', '0', '1', '1', '1970').'">'. $i . '</option>'; } else { echo '<option value="'.mktime($i, '0', '0', '1', '1', '1970').'">'. $i . '</option>'; }
    $i++;
  endwhile;
  echo '</select>';
  echo '&nbsp;<strong>:</strong>&nbsp;';
  echo '<select id="afhaalfilialentijdenSluitMin' . $dayNR . '" name="afhaalshopSluitMin' . $dayNR . '" class="form-control-sm">';
  $i = 0;
  while ($i <= (59) ):
    if($i <10) { $i = '0' . $i; }
    if($shopSluitMin == $i) { echo '<option selected value="'.mktime('0', $i, '0', '1', '1', '1970').'">'. $i . '</option>'; } else { echo '<option value="'.mktime('0', $i, '0', '1', '1', '1970').'">'. $i . '</option>'; }
    $i++;
  endwhile;
  echo '</select>';
  echo '</div>';
  echo '</div>';
}
function openingstijdenbezorgen($daySelected, $fid) {
  $pdo = Database::DB();
  $tijden = $pdo->prepare("SELECT * FROM `openingstijdenbezorgen` WHERE `fid` = :fid");
  $tijden->execute(["fid"=>$fid]);
  $row = $tijden->fetch(PDO::FETCH_BOTH);
  echo $shopOpenMaandag;
  $shopOpenMaandag		= $row[2];
  $shopSluitMaandag		= $row[3];
  $shopOpenDinsdag		= $row[4];
  $shopSluitDinsdag		= $row[5];
  $shopOpenWoensdag		= $row[6];
  $shopSluitWoensdag		= $row[7];
  $shopOpenDonderdag		= $row[8];
  $shopSluitDonderdag		= $row[9];
  $shopOpenVrijdag		= $row[10];
  $shopSluitVrijdag		= $row[11];
  $shopOpenZaterdag		= $row[12];
  $shopSluitZaterdag		= $row[13];
  $shopOpenZondag			= $row[14];
  $shopSluitZondag		= $row[15];
  $shopGeopendMaandag		= $row[16];
  $shopGeopendDinsdag		= $row[17];
  $shopGeopendWoensdag	= $row[18];
  $shopGeopendDonderdag	= $row[19];
  $shopGeopendVrijdag		= $row[20];
  $shopGeopendZaterdag	= $row[21];
  $shopGeopendZondag		= $row[22];
  $shopBereidingsTijd		= $row[23];
  $shopTijdVak			= $row[24];
  $shopDaysBefore			= $row[25];
  $Dag = date('d');
  $Maand = date('m');
  $Jaar = date('Y');
  $Uur = date('H');
  $Min = date('i');
  $Sec = date('s');
  $UnixTijd = mktime($Uur, $Min, $Sec, $Maand, $Dag, $Jaar) ;
  $actueleDagNR = date('w', $UnixTijd);
  $dagnaam[1]="Maandag";
  $dagnaam[2]="Dinsdag";
  $dagnaam[3]="Woensdag";
  $dagnaam[4]="Donderdag";
  $dagnaam[5]="Vrijdag";
  $dagnaam[6]="Zaterdag";
  $dagnaam[0]="Zondag";
  if($daySelected == 1) { $dayNR= 1; $day = $shopGeopendMaandag; $shopOpenUnix = $shopOpenMaandag; $shopSluitUnix = $shopSluitMaandag; }
  if($daySelected == 2) { $dayNR= 2; $day = $shopGeopendDinsdag; $shopOpenUnix = $shopOpenDinsdag; $shopSluitUnix = $shopSluitDinsdag; }
  if($daySelected == 3) { $dayNR= 3; $day = $shopGeopendWoensdag; $shopOpenUnix = $shopOpenWoensdag; $shopSluitUnix = $shopSluitWoensdag; }
  if($daySelected == 4) { $dayNR= 4; $day = $shopGeopendDonderdag; $shopOpenUnix = $shopOpenDonderdag; $shopSluitUnix = $shopSluitDonderdag; }
  if($daySelected == 5) { $dayNR= 5; $day = $shopGeopendVrijdag; $shopOpenUnix = $shopOpenVrijdag; $shopSluitUnix = $shopSluitVrijdag; }
  if($daySelected == 6) { $dayNR= 6; $day = $shopGeopendZaterdag; $shopOpenUnix = $shopOpenZaterdag; $shopSluitUnix = $shopSluitZaterdag; }
  if($daySelected == 0) { $dayNR= 0; $day = $shopGeopendZondag; $shopOpenUnix = $shopOpenZondag; $shopSluitUnix = $shopSluitZondag; }
  $shopOpenUur = date('H', $shopOpenUnix - (60*60));
  $shopOpenMin = date('i', $shopOpenUnix - (60*60));
  $shopSluitUur = date('H', $shopSluitUnix - (60*60));
  $shopSluitMin = date('i', $shopSluitUnix - (60*60));
  echo '<div class="row">';
  echo '
  <div class="col-sm-3"><p>'.$dagnaam[$daySelected].'</p></div>
  ';
  echo '
  <div class="col-sm-3">
  <div class="form-group">
  <select class="form-control" name="bezorgday' . $daySelected . '">';
  if($day){ echo '<option selected value="1">Open</option><option value="0">Gesloten</option>'; } else { echo '<option value="1">Open</option><option selected value="0">Gesloten</option>'; }
  echo '
  </select>
  </div>
  </div>
  ';
  echo '<div id="dayTimes' . $daySelected . '" style="float: left; margin-left: 10px;">';
  echo '<select id="bezorgfilialentijdenOpenUur' . $dayNR . '" name="bezorgshopOpenUur' . $dayNR . '" class="form-control-sm">';
  $i = 0;
  while ($i <= (23) ):
    if($i <10) { $i = '0' . $i; }
    if($shopOpenUur == $i) { echo '<option selected value="'.mktime($i, '0', '0', '1', '1', '1970').'">'. $i . '</option>'; } else { echo '<option value="'.mktime($i, '0', '0', '1', '1', '1970').'">'. $i . '</option>'; }
    $i++;
  endwhile;
  echo '</select>';
  echo '&nbsp;<strong>:</strong>&nbsp;';
  echo '<select id="bezorgfilialentijdenOpenMin' . $dayNR . '" name="bezorgshopOpenMin' . $dayNR . '" class="form-control-sm">';
  $i = 0;
  while ($i <= (59) ):
    if($i <10) { $i = '0' . $i; }
    if($shopOpenMin == $i) { echo '<option selected value="'.mktime('0', $i, '0', '1', '1', '1970').'">'. $i . '</option>'; } else { echo '<option value="'.mktime('0', $i, '0', '1', '1', '1970').'">'. $i . '</option>'; }
    $i++;
  endwhile;
  echo '</select>';
  echo '&nbsp;&nbsp;tot&nbsp;&nbsp;';
  echo '<select id="bezorgfilialentijdenSluitUur' . $dayNR . '" name="bezorgshopSluitUur' . $dayNR . '" class="form-control-sm">';
  $i = 0;
  while ($i <= (23) ):
    if($i <10) { $i = '0' . $i; }
    if($shopSluitUur == $i) { echo '<option selected value="'.mktime($i, '0', '0', '1', '1', '1970').'">'. $i . '</option>'; } else { echo '<option value="'.mktime($i, '0', '0', '1', '1', '1970').'">'. $i . '</option>'; }
    $i++;
  endwhile;
  echo '</select>';
  echo '&nbsp;<strong>:</strong>&nbsp;';
  echo '<select id="bezorgfilialentijdenSluitMin' . $dayNR . '" name="bezorgshopSluitMin' . $dayNR . '" class="form-control-sm">';
  $i = 0;
  while ($i <= (59) ):
    if($i <10) { $i = '0' . $i; }
    if($shopSluitMin == $i) { echo '<option selected value="'.mktime('0', $i, '0', '1', '1', '1970').'">'. $i . '</option>'; } else { echo '<option value="'.mktime('0', $i, '0', '1', '1', '1970').'">'. $i . '</option>'; }
    $i++;
  endwhile;
  echo '</select>';
  echo '</div>';
  echo '</div>';
}
?>
