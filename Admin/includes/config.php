<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prefix";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
