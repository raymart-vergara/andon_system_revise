<?php 
include 'conn.php';

$method = $_POST['method'];

if ($method == 'server_hangup') {
	$c =0;
	$query = "SELECT * FROM tblandonrequest WHERE department = 'IT' AND status = 'pending' AND confirm_by = ''";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){

			$c++;
			echo '<tr>';
				echo '<td style="text-align:center;">';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="selectLot" class="singleCheck" value="'.$j['listId'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
                echo '<td>'.$j['line'].'</td>';
                echo '<td>'.$j['problem'].'</td>';
                echo '<td>'.$j['operatorName'].'</td>';
                echo '<td>'.$j['department'].'</td>';
                echo '<td>'.$j['requestDateTime'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
				echo '<td colspan="6" style="text-align:center; color:red;"><h5><b>NO RESULT ! ! !</b></h5><td>';
		echo '</tr>';
	}
}

if ($method == 'fix_hangup') {
	$ipPathAccept = $_SERVER['REMOTE_ADDR'];
	$id = [];
	$id = $_POST['id'];
	$count = count($id);
	foreach($id as $x){
		$check = "SELECT * FROM tblandonrequest WHERE listId = '$x'";
		$stmt = $conn->prepare($check);
		$stmt->execute();
		foreach($stmt->fetchALL() as $j){
			$line = $j['line'];
			$listId = $j['listId'];
			$machineName = $j['machineName'];
	        $process = $j['process'];
	        $machineNo = $j['machineNo'];
	        $problem = $j['problem'];
	        $department = $j['department'];
	        $operatorName = $j['operatorName'];
	        $category = $j['category'];
	        $requestedId = $j['requestedId'];
	        $requestDateTime = $j['requestDateTime'];
	        $ipPathReq = $j['ipPathReq'];

		}

		$query = "INSERT INTO tblandonongoing (`listId`, `requestedId`, `category`, `line`, `machineName`, `machineNo`,`process`,`problem`,`operatorName`,`department`,`technicianId`,`technicianName`,`backupTechnicianId`,`backupTechnicianName`,`backupComment`,`backupRequestTime`,`backupAccept`,`status`,`requestDateTime`,`startDateTime`,`ipPathReq`,`ipPathTechAccept`) VALUES ('0','$listId','$category','$line','$machineName','$machineNo','$process','$problem','$operatorName','IT','IT-Admin','IT-Admin','','','','','','Ongoing','$requestDateTime','$datenow','$ipPathReq','$ipPathAccept')";
	        $stmt2 = $conn->prepare($query);
	        if ($stmt2->execute()) {
	        		
	        	$delete = "DELETE FROM tblandonrequest WHERE listId = '$x'";
	        	$stmt3 = $conn->prepare($delete);
	        	if ($stmt3->execute()) {
	        		echo 'success';
	        	}else{
	        		echo 'error';
	        	}

	        }
	}
}


if ($method == 'end_server_hangup') {
	$c =0;
	$query = "SELECT * FROM tblandonongoing WHERE department = 'IT' AND status = 'Ongoing' AND technicianId = 'IT-Admin'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){

			$c++;
			echo '<tr>';
				echo '<td style="text-align:center;">';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="selectLot" class="singleCheck" value="'.$j['listId'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
                echo '<td>'.$j['line'].'</td>';
                echo '<td>'.$j['problem'].'</td>';
                echo '<td>'.$j['technicianName'].'</td>';
                echo '<td>'.$j['department'].'</td>';
                echo '<td>'.$j['startDateTime'].'</td>';
                echo '<td>'.$j['operatorName'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
				echo '<td colspan="7" style="text-align:center; color:red;"><h5><b>NO RESULT ! ! !</b></h5><td>';
		echo '</tr>';
	}
}

if ($method == 'fix_hangups') {
	$ipPathEndAndon = $_SERVER['REMOTE_ADDR'];
	$id = [];
	$id = $_POST['id'];
	$count = count($id);
	foreach($id as $x){
		$check = "SELECT * FROM tblandonongoing WHERE listId = '$x'";
		$stmt = $conn->prepare($check);
		$stmt->execute();
		foreach($stmt->fetchALL() as $j){
			$requestedId = $j['requestedId'];
            $category = $j['category'];
            $line = $j['line'];
            $machineName = $j['machineName'];
            $machineNo = $j['machineNo'];
            $process = $j['process'];
            $problem = $j['problem'];
            $operatorName = $j['operatorName'];
            $department = $j['department'];
            $technicianID = $j['technicianId'];
            $technicianName = $j['technicianName'];
            $backupTechnicianId = $j['backupTechnicianId'];
            $backupTechnicianName = $j['backupTechnicianName'];
            $backupComment = $j['backupComment'];
            $backupRequestTime = $j['backupRequestTime'];
            $backupAccept = $j['backupAccept'];
            $status = $j['status'];
            $requestDateTime = $j['requestDateTime'];
            $startDateTime = $j['startDateTime'];
            $endDateTime = $j['endDateTime'];
            $ipPathReq = $j['ipPathReq'];
            $ipPathTechAccept = $j['ipPathTechAccept']; 

		}
 
		$query = "INSERT INTO tblhistory (`requestedId`,`category`,`line`,`machineName`,`machineNo`,`process`,`problem`,`operatorName`,`department`,`technicianId`,`technicianName`,`backupTechnicianId`,`backupTechnicianName`,`backupComment`,`backupRequestTime`,`backupAccept`,`status`,`waitingTime`,`requestDateTime`,`startDateTime`,`endDateTime`,`fixInterval`,`fixRemarks`,`counter_measure`,`ipPathReq`,`ipPathTechAccept`,`ipPathEndAndon`)VALUES('$requestedId','$category','$line','$machineName','$machineNo','$process','$problem','$operatorName','$department','$technicianID','$technicianName','$backupTechnicianId','$backupTechnicianName','$backupComment','$backupRequestTime','$backupAccept','DONE','00:00:00','$requestDateTime','$startDateTime','$datenow','00:00:00','DOWNTIME','Server Confirmation','$ipPathReq','$ipPathTechAccept','$ipPathEndAndon')";
		$stmt2 = $conn->prepare($query);
		if ($stmt2->execute()) {
			$delete = "DELETE FROM tblandonongoing WHERE listId = '$x'";
			$stmt3 = $conn->prepare($delete);
			if ($stmt3->execute()) {
				echo 'success';
			}else{
				echo 'error';
			}
		}
	}
}
?>