<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prefix";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'stevofame15@gmail.com');
define('SMTP_PASSWORD', 'jmebpvrceoxryham');
define('SMTP_PORT', 587);
?>