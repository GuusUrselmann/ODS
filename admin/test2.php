<?php
function get_coordinates($adres)
{
  $adres = str_replace(" ", "+", $adres);
  $address = urlencode($adres);
  $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&region=Netherlands&key=AIzaSyDI2YI5vYHjJ8lyytLOoRFjq2V5d0rmECs";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec($ch);
  curl_close($ch);
  $response_a = json_decode($response);
  echo "<pre>";
  print_r($response_a);
  echo "</pre>";
  $status = $response_a->status;
  if ( $status == 'ZERO_RESULTS' )
  {
    return FALSE;
  }
  else
  {
    $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
    return $return;
  }
}
function GetDrivingDistance($lat1, $lat2, $long1, $long2)
{
  $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=nl-NL&key=AIzaSyDI2YI5vYHjJ8lyytLOoRFjq2V5d0rmECs";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec($ch);
  curl_close($ch);
  $response_a = json_decode($response, true);
  $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
  $time = $response_a['rows'][0]['elements'][0]['duration']['text'];
  return array('distance' => $dist, 'time' => $time);
}
function postcodenaarstraat($postcode)
{
  $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$postcode&sensor=false&region=Netherlands&key=AIzaSyDI2YI5vYHjJ8lyytLOoRFjq2V5d0rmECs";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec($ch);
  curl_close($ch);

  $response_a = json_decode($response);
  echo "<pre>";
  print_r($response_a);
  echo "</pre>";
  $status = $response_a->status;
  if ( $status == 'ZERO_RESULTS' )
  {
    return FALSE;
  }
  else
  {
    $latlong = $response_a->results[0]->geometry->location->lat.",".$response_a->results[0]->geometry->location->lng;
    $latlong = urlencode($latlong);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$latlong&sensor=false&region=Netherlands&key=AIzaSyDI2YI5vYHjJ8lyytLOoRFjq2V5d0rmECs";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_b = json_decode($response);
    return $response_b->results[0]->address_components[1]->long_name;
  }
}
?>

<form method="post">
  <input type="text" name="postcode1" value="<?php echo $_POST['postcode1']; ?>" placeholder="Postcode1"><br />
  <input type="text" name="huisnummer1" value="<?php echo $_POST['huisnummer1']; ?>" placeholder="Huisnummer1"><br /><br />
  <input type="text" name="postcode2" value="<?php echo $_POST['postcode2']; ?>" placeholder="Postcode2"><br />
  <input type="text" name="huisnummer2" value="<?php echo $_POST['huisnummer2']; ?>" placeholder="Huisnummer2"><br /><br />
  <button type="submit">Reken</button>
</form>
<br /><br />
<?php if($_POST['postcode1']){
  $straat1 = postcodenaarstraat($_POST['postcode1']);
  $straat2 = postcodenaarstraat($_POST['postcode2']);
  $coordinates1 = get_coordinates($straat1 . " ". $_POST['huisnummer1']. " ".$stad1);
  $coordinates1 = get_coordinates($straat1 . " ". $_POST['huisnummer1']. " ".$stad1);
  if ( !$coordinates1 || !$coordinates2 )
  {
    echo 'Fout address.';
  }
  else
  {
    $dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
    echo 'Afstand: <b>'.$dist['distance'].'</b><br />Reistijd: <b>'.$dist['time'].'</b>';
  }
  echo $dist;
}
  ?>
