<?php
	include '../database/index.php';
	$recID = $_GET['listId'];
	$fetchBackupDetails = "SELECT department,technicianName,backupTechnicianId,backupTechnicianName,backupComment,backupRequestTime,backupAccept FROM tblandonongoing WHERE listId = '$recID'";
	$query = $db->query($fetchBackupDetails);
	while($data = $query->fetch_assoc()){
		$dept = $data['department'];
		$technician = $data['technicianName'];
		$backupTechnicianId = $data['backupTechnicianId'];
		$backupTechnician = $data['backupTechnicianName'];
		$backupComment = $data['backupComment'];
		$backupRequestTime = $data['backupRequestTime'];
		$backupAccept = $data['backupAccept'];
	}
?>
<table style="text-align:left;">
	<tr>
		<td>Department:</td>
		<td><?=$dept;?></td>
	</tr>
	<tr>
		<td>Technician:</td>
		<td><?=$technician;?></td>
	</tr>
	<!--  -->
	<tr>
		<td>Backup Request Time:</td>
		<td><?=$backupRequestTime;?></td>
	</tr>
	<!--  -->
	<tr>
		<td>Backup Remarks:</td>
		<td><?=$backupComment;?></td>
	</tr>
	<!--  -->
	<tr>
		<td>Backup Request Accept:</td>
		<td><?=$backupAccept;?></td>
	</tr>
	<!--  -->
	<tr>
		<td>Backed up By:</td>
		<td><?=$backupTechnician;?></td>
	</tr>
</table>
<input type="hidden" name="" id="technicianName" value="<?=$technician;?>">
<input type="hidden" name="" id="dept" value="<?=$dept;?>">
<input type="hidden" name="" id="recordId" value="<?=$recID;?>">
<hr>

<?php
	// IF BACKUP ACCEPT IS NULL AND HAS BACKUPREQUEST, SCAN ID IS ENABLED
	if($backupAccept === '0000-00-00 00:00:00' && empty($backupTechnician) && $backupRequestTime != '0000-00-00 00:00:00')
	{
		ECHO '<center>Scan your ID to accept the backup</center>';
		echo '<input type="password" class="form-control" name="" id="getBackup" placeholder="Technician ID" onchange="getBackup()" autocomplete="off">';
	}else{
		echo '<center>This technician has no backup request or has ongoing backup.</center>';
		echo '<input type="password" class="form-control" name="" id="getBackup" placeholder="Technician ID" onchange="getBackup()" autocomplete="off" disabled>';
	}
?>
