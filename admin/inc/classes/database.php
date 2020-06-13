<?php
if(!isset($config)){
  header("HTTP/1.0 404 Not Found");
  die();
}
class Database {
  static public function DB() {
    static $db;
    $dsn = "mysql:host=".mysqlhost.";dbname=".mysqldatabase.";";
    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
      $db = new PDO($dsn, mysqlgebruikersnaam, mysqlwachtwoord, $options);
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    return $db;
  }
}
?>
