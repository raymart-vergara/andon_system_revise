<?php
	$server = 'localhost';
	// $username = 'root';
	// $password = '#Sy$temGr0^p|114167';
	$username = 'root';
	$password = '';
	try{
		$conn = new PDO("mysql:host=$server;dbname=andon_web",$username,$password);
	}catch(PDOException $e){
		echo 'NO CONNECTION'.$e->getMessage();
	}
?>