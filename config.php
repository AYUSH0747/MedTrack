<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'medtrack');

$encryptionKey = '7ab42a1cc1a0c33668f2318d4310f94a155f52b171ab3941b05eaaad3c6b9166';
$userEncrypt = 'c37f7eb9a8f89f1b4c2d1e6f5a9c8b7e303c2d1e6f5a8b7c6d6e5a4c3b2a1d';
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if($db === false){
    die("Error: Connection Error. " . mysqli_connect_error());
}
?>