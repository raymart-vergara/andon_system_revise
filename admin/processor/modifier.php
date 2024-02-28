<?php
	include 'conn.php';
	$datenow =  date('Y-m-d H:i:s');
	// FETCH METHOD
	$method = $_GET['method'];

	if($method === 'viewPending'){
		$andonID = $_GET['andonID'];
		// SELECT INFO
		$fetchPending = "SELECT *FROM tblandonrequest WHERE listId = '$andonID'";
		$stmt = $conn->prepare($fetchPending);
		$stmt->execute();
		$res = $stmt->fetchALL();
			foreach($res as $x){
				$line = $x['line'];
				$machineName = $x['machineName'];
				$process = $x['process'];
				$problem = $x['problem'];
				$machineNum = $x['machineNo'];
				$dept = $x['department'];
				$requestBy =  $x['operatorName'];
				$dateReported = $x['requestDateTime'];
				$confirm = $x['confirm_by'];
			}

		echo '<table class="container">';
		echo '<tr>';
		echo '<td>LINE</td>';
		echo '<td>'.$line.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>MACHINE NAME</td>';
		echo '<td>'.$machineName.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>PROCESS</td>';
		echo '<td>'.$process.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>PROBLEM</td>';
		echo '<td>'.$problem.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>MACHINE NUMBER</td>';
		echo '<td>'.$machineNum.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>PROCESS</td>';
		echo '<td>'.$process.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>CONCERNED DEPARTMENT</td>';
		echo '<td>'.$dept.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>REQUESTED BY</td>';
		echo '<td>'.$requestBy.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>DATE REPORTED</td>';
		echo '<td>'.$dateReported.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>CONFIRM BY</td>';
		echo '<td>'.$confirm.'</td>';
		echo '</tr>';
		//
		echo '</table>';

		// IF CONFIRM TECH IS NOT EMPTY
		if($confirm === ''){
			echo '<div class="center input-field">';
			echo '<h6 class="center">Scan ID to confirm Andon</h6>';
			echo '<input type="password" id="confirmID" autocomplete="off" onchange="confirmAndon()" class="center" style="width:200px;"/>';
			echo '</div>';
		}else{
			echo '<p class="center" style="color:red;font-weight:bold;">Already Confirmed</p>';
		}
	}
	elseif($method == 'confirmAndon'){
		// ID OF TECHNICIAN
		$scanID = $_GET['technicianID'];
		// FETCH CONCERNING DEPARTMENT
		$dept = $_GET['department'];
		// ID OF ANDON TO BE UPDATED
		$andonID = $_GET['andonID'];
		// GET THE NAME OF TECHNICIAN
		$fetchName = "SELECT firstName,lastName FROM tblaccount WHERE idNumber = '$scanID' AND carMaker = '$dept' LIMIT 1";
		$stmt = $conn->prepare($fetchName);
		$stmt->execute();
		$res = $stmt->fetchALL();
		// IF RECORD RETURN 1 DATA IT WILL FETCH DETAILS OF THE TECHNICIAN
		if($stmt->rowCount() > 0){
			foreach($res as $data){
				// CREATE VARIABLE NAME
			$techName = $data['firstName']." ".$data['lastName'];
		}
		$check = "SELECT confirm_by FROM tblandonrequest WHERE confirm_by = '$techName'";
		$stmt = $conn->prepare($check);
		$stmt->execute();
		$stmt->fetchALL();
			if($stmt->rowCount() >= 1 ){
				echo 'Invalid Attempt. Please end your existing Andon first.';
			}else{
				// SET UPDATING QUERY FOR ANDON REQUEST
				$confirmQry = "UPDATE tblandonrequest SET status = 'confirm', confirm_by = '$techName' WHERE listId = '$andonID'";
				$stmt = $conn->prepare($confirmQry);
				if($stmt->execute()){
					echo 'Success';
				}
			}
	}
	// IF ROW = 0 RETURNS AN ERROR
	else{
		echo 'Invalid ID';
	}
}
	elseif($method == 'viewOngoing'){
		$andonID = $_GET['andonID'];
		// SELECT INFO
		$fetchPending = "SELECT *FROM tblandonongoing WHERE listId = '$andonID'";
		$stmt = $conn->prepare($fetchPending);
		$stmt->execute();
		$res = $stmt->fetchALL();
			foreach($res as $x){
				$line = $x['line'];
				$machineName = $x['machineName'];
				$process = $x['process'];
				$problem = $x['problem'];
				$machineNum = $x['machineNo'];
				$dept = $x['department'];
				$requestBy =  $x['operatorName'];
				$dateReported = $x['requestDateTime'];
				$technician = $x['technicianName'];
				$backupComment = $x['backupComment'];
				$backupRequestTime = $x['backupRequestTime'];
				$backupAccept = $x['backupAccept'];
				$backupTech = $x['backupTechnicianName'];

			}
		echo '<table class="container responsive-table">';
		echo '<tr>';
		echo '<td>LINE</td>';
		echo '<td>'.$line.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>MACHINE NAME</td>';
		echo '<td>'.$machineName.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>PROCESS</td>';
		echo '<td>'.$process.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>PROBLEM</td>';
		echo '<td>'.$problem.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>MACHINE NUMBER</td>';
		echo '<td>'.$machineNum.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>PROCESS</td>';
		echo '<td>'.$process.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>CONCERNED DEPARTMENT</td>';
		echo '<td>'.$dept.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>REQUESTED BY</td>';
		echo '<td>'.$requestBy.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>DATE REPORTED</td>';
		echo '<td>'.$dateReported.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>TECHNICIAN</td>';
		echo '<td>'.$technician.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>BACKUP REMARKS</td>';
		echo '<td>'.$backupComment.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>BACKUP REQUEST TIME</td>';
		echo '<td>'.$backupRequestTime.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>BACKUP ACCEPT TIME</td>';
		echo '<td>'.$backupAccept.'</td>';
		echo '</tr>';
		//
		echo '<tr>';
		echo '<td>BACKUP BY</td>';
		echo '<td>'.$backupTech.'</td>';
		echo '</tr>';
		//
		echo '</table>';

		if(empty($backupComment) && $backupRequestTime = '0000-00-00 00:00:00'){
			echo '<p class="center" style="font-weight:bold;color:red;">No Backup Request</p>';
		}elseif(!empty($backupTech)){
			echo '<p class="center" style="font-weight:bold;color:red;">Ongoing Backup</p>';
		}else{
			echo '<div class="row center input-field">';
			echo '<h6 class="center">Scan your ID to accept this backup request</h6>';
			echo '<input type="password" id="backupAcceptTech" autocomplete="off" class="center" style="width:200px;" onchange="acceptBackup()"/>';
			echo '</div>';
		}
	}
	elseif($method == 'acceptBackup'){
		$andonRef = $_GET['andonID'];
		$technicianBack = $_GET['techID'];
		$concerningDept = $_GET['dept'];
		// DEFINE TECHNICIAN
		$checkTechnician = "SELECT  listId,firstName,lastName FROM tblaccount WHERE idNumber = '$technicianBack' AND carMaker = '$concerningDept'";
		$stmt = $conn->prepare($checkTechnician);
		$stmt->execute();
		$res = $stmt->fetchALL();
		if($stmt->rowCount() > 0){
			// INSERT BACKUP DETAILS
			foreach($res as $x){
				 $fullname = $x['firstName']." ".$x['lastName'];
			}
			// BACKUP TECHNICIAN FULLNAME = TO TECHNICIAN RESTRIC

			$backupQry = "UPDATE tblandonongoing SET backupTechnicianId = '$technicianBack', backupTechnicianName = '$fullname', backupAccept = '$datenow'";
			$stmt = $conn->prepare($backupQry);
			if($stmt->execute()){
				echo 'Successfully accepted the backup request.';
			}else{
				echo 'Failed to accept backup.';
			}
		}else{
			echo 'Invalid ID';
		}
	}
	// REGISTER OPERATOR
	elseif($method == 'regOperator'){
		$id = 0;
		$fname = $_GET['Fname'];
		$lname = $_GET['Lname'];
		$carmaker = $_GET['carmaker'];
		$categ = $_GET['category'];
		$operatorID = $_GET['operatorID'];
		$tech = $_GET['techID'];
		$accountType = $_GET['account_type'];
		// CHECK TECHNICIAN ID
		$checkTech = "SELECT listId FROM tblaccount WHERE carMaker ='IT' AND idNumber = '$tech'";
		$stmt = $conn->prepare($checkTech);
		$stmt->execute();
		$stmt->fetchAll();
			if($stmt->rowCount() > 0){
							// CHECK ID NUMBER IF EXISTS
					$check = "SELECT idNumber FROM tblaccount WHERE idNumber = '$operatorID'";
					$stmt = $conn->prepare($check);
					$stmt->execute();
					$stmt->fetchAll();
						if($stmt->rowCount() > 0){
							echo 'Operator was already registered in the system.';
						}else{
							// IF IDNUMBER WAS NOT DUPLICATED SYSTEM REGISTER THE USER
							$register = "INSERT INTO tblaccount (`listId`,`idNumber`,`firstName`,`lastName`,`carMaker`,`category`,`accountType`) VALUE ('$id','$operatorID','$fname','$lname','$carmaker','$categ','$accountType')";
							$stmt = $conn->prepare($register);
							if($stmt->execute()){
								echo 'Successfully registered';
							}else{
								echo 'Failed';
					}
			}

		}else{
			echo 'Invalid ID';
		}
	}
	// ADD PROBLEM

	elseif($method == 'addProb'){
		$id =0;
		$dept = $_GET['dept'];
		$machine = $_GET['machine'];
		$prob = $_GET['prob'];
		$probRegID = $_GET['probregid'];
		// FETCH TECHNICIAN
		$check_tech = "SELECT firstName,lastName FROM tblaccount WHERE idNumber = '$probRegID' AND carMaker = '$dept'";
		$stmt = $conn->prepare($check_tech);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			foreach($stmt->fetchALL() as $x){
				$regProbName = $x['firstName']." ".$x['lastName'];
			}
			// SAVE MACHINE PROBLEM
			$saveEntry = "INSERT INTO tblproblem (`listId`,`department`,`machineName`,`problem`) VALUES ('$id','$dept','$machine','$prob')";
			$stmt = $conn->prepare($saveEntry);
			if($stmt->execute()){
				$msg = $regProbName." register ".$prob." as machine problem for ". $machine;
				$logQL = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('0','$msg','$datenow')";
				$stmt =$conn->prepare($logQL);
				$stmt->execute();
				echo 'Saved!';
			}else{
				echo 'Failed!';
			}
		}else{
			echo 'Invalid User';
		}
		
	} 

	// ?ADD SOLUTION
	elseif($method == 'addSolution'){
		$id = 0;
		$dept = $_GET['dept'];
		$machine = $_GET['machine'];
		$solution = $_GET['solution'];
		$registrarID = $_GET['registrar'];
		// FETCH ID SCANNED
		$check_tech  = "SELECT firstName,lastName FROM tblaccount WHERE idNumber = '$registrarID' AND carMaker = '$dept'";
		$stmt = $conn->prepare($check_tech);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			foreach($stmt->fetchALL() as $x){
					$regName = $x['firstName']." ".$x['lastName'];
				}
				// AJAX
				$saveQry = "INSERT INTO tblsolution (`listId`,`department`,`machineName`,`solution`) VALUES ('$id','$dept','$machine','$solution')";
				$stmt = $conn->prepare($saveQry);
				if($stmt->execute()){
					$msg = $regName." register ".$solution." as machine solution for ". $machine;
					$logQL = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('0','$msg','$datenow')";
					$stmt =$conn->prepare($logQL);
					$stmt->execute();
					echo 'Saved!';
				}else{
					echo 'Failed!';
				}
		}else{
			echo 'Invalid User!';
		}
		
	}
	// SEARCH OPERATOR
	elseif($method == 'SearchOperator'){
		$idCode = $_GET['idnumber'];
		// QUERY
		$qry = "SELECT *FROM tblaccount WHERE idNumber LIKE '$idCode%' HAVING accountType = 'Operator Account' OR accountType = 'Event Account'";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
			foreach($stmt->fetchAll() as $x){
				echo '<tr>';
				echo '<td>'.$x['idNumber'].'</td>';
				echo '<td>'.$x['firstName'].'</td>';
				echo '<td>'.$x['lastName'].'</td>';
				echo '<td>'.$x['carMaker'].'</td>';
				echo '<td>'.$x['category'].'</td>';
				echo '<td>'.$x['accountType'].'</td>';
				echo '<td>
						 <button class="btn-small red modal-trigger" onclick="deleteOperator(&quot;'.$x['listId'].'~!~'.$x['idNumber'].'&quot;)" data-target="operator_del">delete</button>
					  </td>';
				echo '</tr>';
			}
	}
	// DELETE OPERATOR
	elseif($method == 'deleteOperator'){
		$id = $_GET['record_id'];
		$opt_id = $_GET['id_opt'];
		$moderator = $_GET['moderator'];
		// SELECT TECHNICIAN PASS IF IT OR EXIST
		$checkTech = "SELECT listId FROM tblaccount WHERE carMaker = 'IT' AND accountType = 'Admin Account' AND idNumber = '$moderator'";
		$stmt = $conn->prepare($checkTech);
		$stmt->execute();
		$stmt->fetchAll();
		if($stmt->rowCount() > 0){
			$qry = "DELETE FROM tblaccount WHERE listId = '$id' AND accountType = 'Operator Account' OR accountType = 'Event Account'";
			$stmt = $conn->prepare($qry);
			if($stmt->execute()){
				$message = $moderator." Successfully removed ".$opt_id." from Operator Account";
				$sql = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('0','$message','$datenow')";
				$x=$conn->prepare($sql);
				$x->execute();
				echo 'Deleted';
			}
		}else{
			echo 'Invalid ID';
		}
	}

	// KILL CONNECTION
	$conn = null;
?>
