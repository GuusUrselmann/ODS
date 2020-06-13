<?php
if(!isset($_GET['aantal'])){
  header('HTTP/1.0 403 Forbidden');
  die();
}
function RandomCode($length = 50) {
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
echo RandomCode($_GET['aantal']);
?>
