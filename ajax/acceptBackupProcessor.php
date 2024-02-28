<?php
	include '../database/index.php';
	$datenow =  date('Y-m-d H:i:s');
	$recordID = $_GET['listID'];
	$techID = $_GET['techID'];
	$dept = $_GET['dept'];
	$prevTech = $_GET['prevTech'];
	// check ID & dept for technician exist

	$checkTech = "SELECT *FROM tblaccount WHERE idNumber = '$techID' AND carMaker = '$dept' LIMIT 1";
	$query = $db->query($checkTech);
	$count = mysqli_num_rows($query);
	if($count > 0){
		// fetch backup tech info
		while($x = $query->fetch_assoc()){
			$backupName = $x['firstName']." ".$x['lastName'];
		}

		if($prevTech == $backupName){
			echo "same";
		}
		else{

		// update ongoing andon
		$sendBackupAccept = "UPDATE tblandonongoing SET backupTechnicianId = '$techID', backupTechnicianName = '$backupName', backupAccept = '$datenow' WHERE listId = '$recordID'";
		// $query = $db->query($sendBackupAccept);
		if($query = $db->query($sendBackupAccept)){
			echo 'success';
		}else{
			echo 'fail';
		}
	}
	// if 0 result
	}else{
		echo "invalid";
	}
	$db->close();
?>