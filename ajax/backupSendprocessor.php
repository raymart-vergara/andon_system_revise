<?php
	include "../database/index.php";
	$reqID = $_POST['reqID'];
	$reminder = $_POST['reminder'];
	$reminder = trim($reminder);
	$password =  $_POST['passwordBackup'];
	$backupRequestDateTime = date('Y-m-d H:i:s');
	// send request for backup SQL
	$sendBackup = "UPDATE tblandonongoing SET backupComment = '$reminder' ,backupRequestTime = '$backupRequestDateTime' WHERE listId = '$reqID'";
	$query = $db->query($sendBackup);
	$db->close();
?>