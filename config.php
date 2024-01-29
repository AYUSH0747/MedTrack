<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'medtrack');

$encryptionKey = '7ab42a1cc1a0c33668f2318d4310f94a155f52b171ab3941b05eaaad3c6b9166';
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if($db === false){
    die("Error: Connection Error. " . mysqli_connect_error());
}
?>