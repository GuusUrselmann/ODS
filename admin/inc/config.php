<?php
SESSION_START();
DEFINE('sitename', "ODS Panel");
DEFINE('adminurl', "http://ods.vnieuwenhuizen.com/admin");
DEFINE('sitepath', "/volume1/ods/admin/");
DEFINE('mysqlhost', "127.0.0.1");
DEFINE('mysqldatabase', "ods");
DEFINE('mysqlgebruikersnaam', "ods");
DEFINE('mysqlwachtwoord', "f4DNPRM6Vz9S3DBU");




$config="true";
include sitepath."inc/classes/database.php";
include sitepath."inc/classes/user.php";
include sitepath."inc/classes/system.php";
include sitepath."inc/classes/functions.php";
?>
