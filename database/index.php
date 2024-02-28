<?php
$servername = "localhost";
// $username = "server_113.4";
// $password = 'SystemGroup@2022';
$username = 'root';
	$password = '';
date_default_timezone_set('Asia/Manila');
$datenow =  date('Y-m-d H:i:s');
$db = mysqli_connect($servername, $username, $password,'andon_web');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>