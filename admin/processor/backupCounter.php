<?php
	require 'conn.php';
	$method = $_GET['method'];

	if($method == 'countBackup'){
		// SQL QUERY FOR countbackup
		$dept = $_GET['dept'];
		// SELECT DATA THAT HAS NO BACKUP REQUEST AND HAS DIDNT BACKUPED BY OTHER TECHNICIAN
		$count = "SELECT COUNT(listId) as count FROM tblandonongoing WHERE backupRequestTime <> '0000-00-00 00:00:00' AND backupAccept = '0000-00-00 00:00:00' AND department = '$dept'";
		$stmt = $conn->prepare($count);
		$stmt->execute();
		$res = $stmt->fetchALL();
		foreach($res as $x){
			$count = $x['count'];
		}
		// IF BACKUPREQUEST OR COUNT WAS GREATER THAN 0 ALARM
		if($count > 0){
			echo 'alert';
		}
		else{
			echo 'silent';
		}
		// if($stmt->rowCount() > 0){
		// 	echo 'req';
		// }

	}
	$conn = null;
?>
