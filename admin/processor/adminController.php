<?php
	include 'conn.php';
	$method = $_POST['method'];
	$datenow = date('Y-m-d H:i:s');
	// FETCH MACHINE
if($method == 'filterMachine'){
		$dept = $_POST['dept'];
		if($dept == 'all_dept'){
			$query = "SELECT *FROM tblmachinename";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr ondblclick="getMachine('.$x['listId'].')" style="cursor:pointer;">';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '</tr>';
				}
		}else{
			$query = "SELECT *FROM tblmachinename WHERE department = '$dept'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr ondblclick="getMachine('.$x['listId'].')" style="cursor:pointer;">';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '</tr>';
				}
		}

	}
// --------------------------------------------------------------------------------------------------------------------------
		// FETCH MACHINE NUMBER
	elseif($method == 'filtermachinenum'){
			$machine = $_POST['machine'];
			if($machine == 'all_machine'){
			$query = "SELECT *FROM tblmachineno ORDER BY machineName ASC";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr ondblclick="getmcNum('.$x['listId'].')" style="cursor:pointer;">';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '</tr>';
				}
		}else{
			$query = "SELECT *FROM tblmachineno WHERE machineName= '$machine'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr ondblclick="getmcNum('.$x['listId'].')" style="cursor:pointer;">';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '</tr>';
				}
		}
	}
// ------------------------------------------------------------------------------------------------------------------------------
	// FETCH CARMAKER
	elseif($method == 'filterCarmaker'){
			$query = "SELECT *FROM tblcarmaker";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr style="cursor:pointer;" ondblclick="getCarmaker('.$x['listId'].')">';
					echo '<td>'.$x['listId'].'</td>';
					echo '<td>'.$x['carMaker'].'</td>';
					echo '</tr>';
				}
	}
// ------------------------------------------------------------------------------------------------------------------------------
	// LINE
	elseif($method == 'filterLine'){
		$carmaker = $_POST['maker'];
		if($carmaker == 'all_line'){
			$query = "SELECT *FROM tblline ORDER BY carMaker ASC";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr style="cursor:pointer;" ondblclick="getLine('.$x['listId'].')">';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['carMaker'].'</td>';
					echo '<td>'.$x['lineNo'].'</td>';
					echo '</tr>';
				}
		}else{
			$query = "SELECT *FROM tblline WHERE carMaker = '$carmaker'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr style="cursor:pointer;" ondblclick="getLine('.$x['listId'].')">';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['carMaker'].'</td>';
					echo '<td>'.$x['lineNo'].'</td>';
					echo '</tr>';
				}
		}
	}
// --------------------------------------------------------------------------------------------------------------------------------
	// PROBLEM
	elseif($method == 'filterProblem'){
		$machine = $_POST['machineName'];
		if($machine == 'all_machine_prob'){
			$query = "SELECT *FROM tblproblem";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr style="cursor:pointer;" ondblclick="getProblem('.$x['listId'].')">';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '</tr>';
				}
		}else{
			$query = "SELECT *FROM tblproblem WHERE machineName = '$machine'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr style="cursor:pointer;" ondblclick="getProblem('.$x['listId'].')">';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '</tr>';
				}
		}
	}
// ------------------------------------------------------------------------------------------------------------------------------
	elseif($method == 'filterSolution'){
		$dept = $_POST['filter_machine'];
		if($dept == 'all_machine_solu'){
			$query = "SELECT *FROM tblsolution";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr ondblclick="getSolution('.$x['listId'].')" style="cursor:pointer;">';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['solution'].'</td>';
					echo '</tr>';
				}
		}else{
			$query = "SELECT *FROM tblsolution WHERE machineName = '$dept'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr ondblclick="getSolution('.$x['listId'].')" style="cursor:pointer;">';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['solution'].'</td>';
					echo '</tr>';
				}
		}
	}
	// ----------------------------------------------------------------------------------------------------------------------------
	// PROCESS FETCH
	elseif($method == 'filterProcess'){
		$machine = $_POST['filter'];
		if($machine == 'all_machine_process'){
			$query = "SELECT *FROM tblprocess";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr style="cursor:pointer;" ondblclick="getProcess('.$x['listId'].')">';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '</tr>';
				}
		}else{
			$query = "SELECT *FROM tblprocess WHERE machineName = '$machine'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				if($stmt->rowCount() > 0){
					foreach($res as $x){
						echo '<tr style="cursor:pointer;" ondblclick="getProcess('.$x['listId'].')">';
						echo '<td>'.$x['department'].'</td>';
						echo '<td>'.$x['machineName'].'</td>';
						echo '<td>'.$x['process'].'</td>';
						echo '</tr>';
					}
				}else{
					echo '<tr>';
					echo '<td colspan="3">No Process with this Machine</td>';
					echo '</tr>';
				}
		}
	}
	// FILTER ACCOUNT---------------------------------------------------------------------------------------------------------------------------
	elseif($method == 'filterAccount'){
		$carmaker = $_POST['filter_carmaker'];
		$prod = $_POST['filter_prod'];
		$rank = $_POST['filter_rank'];
		if(!empty($carmaker) && empty($prod) && empty($rank)){
			$query = "SELECT *FROM tblaccount WHERE carMaker = '$carmaker'";
			$stmt=$conn->prepare($query);
			$stmt->execute();
			foreach($stmt->fetchALL() as $x){
				echo '<tr>';
				echo '<td>'.$x['idNumber'].'</td>';
				echo '<td>'.$x['firstName'].' '.$x['lastName'].'</td>';
				echo '<td>'.$x['carMaker'].'</td>';
				echo '<td>'.$x['category'].'</td>';
				echo '</tr>';
			}
		}elseif(empty($carmaker) && !empty($prod) && empty($rank)){
			$query = "SELECT *FROM tblaccount WHERE category = '$prod'";
			$stmt=$conn->prepare($query);
			$stmt->execute();
			foreach($stmt->fetchALL() as $x){
				echo '<tr>';
				echo '<td>'.$x['idNumber'].'</td>';
				echo '<td>'.$x['firstName'].' '.$x['lastName'].'</td>';
				echo '<td>'.$x['carMaker'].'</td>';
				echo '<td>'.$x['category'].'</td>';
				echo '</tr>';
			}
		}elseif(empty($carmaker) && empty($prod) && !empty($rank)){
			$query = "SELECT *FROM tblaccount WHERE accountType = '$rank'";
			$stmt=$conn->prepare($query);
			$stmt->execute();
			foreach($stmt->fetchALL() as $x){
				echo '<tr>';
				echo '<td>'.$x['idNumber'].'</td>';
				echo '<td>'.$x['firstName'].' '.$x['lastName'].'</td>';
				echo '<td>'.$x['carMaker'].'</td>';
				echo '<td>'.$x['category'].'</td>';
				echo '</tr>';
			}
		}elseif(!empty($carmaker) && !empty($prod) && empty($rank)){
			$query = "SELECT *FROM tblaccount WHERE carMaker = '$carmaker' AND category = '$prod'";
			$stmt=$conn->prepare($query);
			$stmt->execute();
			foreach($stmt->fetchALL() as $x){
				echo '<tr>';
				echo '<td>'.$x['idNumber'].'</td>';
				echo '<td>'.$x['firstName'].' '.$x['lastName'].'</td>';
				echo '<td>'.$x['carMaker'].'</td>';
				echo '<td>'.$x['category'].'</td>';
				echo '</tr>';
			}
		}elseif(!empty($carmaker) && empty($prod) && !empty($rank)){
			$query = "SELECT *FROM tblaccount WHERE carMaker = '$carmaker' AND accountType='$rank'";
			$stmt=$conn->prepare($query);
			$stmt->execute();
			foreach($stmt->fetchALL() as $x){
				echo '<tr>';
				echo '<td>'.$x['idNumber'].'</td>';
				echo '<td>'.$x['firstName'].' '.$x['lastName'].'</td>';
				echo '<td>'.$x['carMaker'].'</td>';
				echo '<td>'.$x['category'].'</td>';
				echo '</tr>';
			}
		}elseif(empty($carmaker) && !empty($prod) && !empty($rank)){
			$query = "SELECT *FROM tblaccount WHERE category = '$prod' AND accountType = '$rank'";
			$stmt=$conn->prepare($query);
			$stmt->execute();
			foreach($stmt->fetchALL() as $x){
				echo '<tr>';
				echo '<td>'.$x['idNumber'].'</td>';
				echo '<td>'.$x['firstName'].' '.$x['lastName'].'</td>';
				echo '<td>'.$x['carMaker'].'</td>';
				echo '<td>'.$x['category'].'</td>';
				echo '</tr>';
			}
		}elseif(!empty($carmaker) && !empty($prod) && !empty($rank)){
			$query = "SELECT *FROM tblaccount WHERE carMaker = '$carmaker' AND category = '$prod' AND accountType = '$rank'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr>';
					echo '<td>'.$x['idNumber'].'</td>';
					echo '<td>'.$x['firstName'].' '.$x['lastName'].'</td>';
					echo '<td>'.$x['carMaker'].'</td>';
					echo '<td>'.$x['category'].'</td>';
					echo '</tr>';
				}
		}else{
			$query = "SELECT *FROM tblaccount";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$res = $stmt->fetchall();
				foreach($res as $x){
					echo '<tr>';
					echo '<td>'.$x['idNumber'].'</td>';
					echo '<td>'.$x['firstName'].' '.$x['lastName'].'</td>';
					echo '<td>'.$x['carMaker'].'</td>';
					echo '<td>'.$x['category'].'</td>';
					echo '</tr>';
				}
		}
	}
		// ADD MACHINE------------------------------------------------------------------------------------------------------------
	elseif($method == 'AddMachine'){
		$categ = $_POST['categ'];
		$dept = $_POST['dept'];
		$name = $_POST['name'];	
		$initiator = $_POST['initiator'];
		// CHECK IF EXISTED
		$query = "INSERT INTO tblmachinename (`listId`,`category`,`department`,`machineName`) VALUES ('','$categ','$dept','$name')";
		$stmt = $conn->prepare($query);
		if($stmt->execute()){
			$notif = $initiator." successfully register ".$name." as Machine of ".$dept." Department";
			$query = "INSERT INTO activity_log(`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($query);
			if($stmt->execute()){
				echo 'success';
			}
		}

	}
	// SELECT MACHINE------------------------------------------------------------------------------------------------------------
	elseif($method == 'selectMachine'){
		echo '<option value="">--Select Machine--</option>';
		$dept = $_POST['dept'];
		$qry = "SELECT DISTINCT machineName FROM tblmachinename WHERE department = '$dept'";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		$res = $stmt->fetchALL();
		foreach($res as $x){
  			 echo '<option value="'.$x['machineName'].'">'.$x['machineName'].'</option>';
  		}		
	}
	// REGISTER MACHINE NO---------------------------------------------------------------------------------------------------------
	elseif($method == 'saveMachineNo'){
		$dept = $_POST['dept'];
		$machine = $_POST['machine'];
		$number = $_POST['machineNo'];
		$initiator = $_POST['initiator'];
		$qry = "INSERT INTO tblmachineno (`listId`,`department`,`machineName`,`machineNo`) VALUES ('','$dept','$machine','$number')";
		$stmt = $conn->prepare($qry);
		if($stmt->execute()){
			// REGISTER TO ACTIVITY LOGS
			$notif = $initiator." successfully register machine number ".$number." for ".$machine." under ".$dept. " department";
			$query = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($query);
			if($stmt->execute()){
				echo 'success';
			}else{
				echo 'failed';
			}
		}
	}
	// REG CARMAKER------------------------------------------------------------------------------------------------------------
	elseif($method == 'regCarmaker'){
		$carmaker = $_POST['carmaker'];
		$init = $_POST['initiator'];
		// ?SQL
		$qry = "INSERT INTO tblcarmaker (`listId`,`carMaker`) VALUES ('','$carmaker')";
		$stmt = $conn->prepare($qry);
		if($stmt->execute()){
			$notif = $init. "successfully registered ".$carmaker;
			$qry = "INSERT into activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($qry);
			if($stmt->execute()){
				echo 'success';
			}else{
				echo 'fail';
			}
		}
	}
	// REGISTER LINE------------------------------------------------------------------------------------------------------------
	elseif($method == 'registerLine'){
		$category = $_POST['category'];
		$carmaker = $_POST['carmaker'];
		$line = $_POST['line'];
		$name = $_POST['name'];
		// CHECK LINE IF EXISTS
		$check = "SELECT lineNo FROM tblline WHERE lineNo = '$line' AND carMaker = '$carmaker'";
		$stmt = $conn->prepare($check);
		$stmt->execute();
		$stmt->fetchALL();
			if($stmt->rowCount() > 0){
				echo 'Line Number already exists!';
			}else{
				// INSERT DATA
				$saveLine = "INSERT INTO tblline (`listId`,`category`,`carMaker`,`lineNo`) VALUES ('','$category','$carmaker','$line')";
				$stmt = $conn->prepare($saveLine);
				if($stmt->execute()){
					// REGISTER TO LOGS
					$notif = $name." successfully registered ".$line." for ".$carmaker;
					$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
					$stmt = $conn->prepare($log);
					if($stmt->execute()){
						echo 'Success!';
					}else{
						echo 'Fail!';
					}
				}

			}
	}
	// DELETE MACHINE------------------------------------------------------------------------------------------------------------
	elseif($method == 'delMachine'){
		$name = $_POST['name'];
		$listID = $_POST['id'];
		// DELETE QUERY 
			$rmQry = "DELETE FROM tblmachinename WHERE listId = '$listID'";
			$stmt = $conn->prepare($rmQry);
			if($stmt->execute()){
				// REFLECT TO LOGS
				$notif = $name. "deleted a machine name";
				$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
				$stmt = $conn->prepare($log);
				$stmt->execute();
				echo 'success';
			}else{
				echo 'fail';
			}
	}
	// DELETE MACHINE NUMBER-------------------------------------------------------------------------------------------------------
	elseif($method == 'delMCNum'){
		$name = $_POST['name'];
		$listID = $_POST['id'];
		// DELETE
		$remNum = "DELETE FROM tblmachineno WHERE listId = '$listID'";
		$stmt = $conn->prepare($remNum);
		if($stmt->execute()){
			// REFLECT TO LOGS
				$notif = $name. "deleted a machine number";
				$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
				$stmt = $conn->prepare($log);
				$stmt->execute();
				echo 'success';
		}else{
				echo 'fail';
			}
	}
	// LOAD MACHINE NAME FOR SELECT------------------------------------------------------------------------------------------
	elseif($method == 'loadSelectMachinename'){
		$dept = $_POST['dept'];
		$qry = "SELECT DISTINCT machineName FROM tblmachinename WHERE department = '$dept'";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
			foreach($stmt->fetchALL() as $x ){
				echo '<option value="'.$x['machineName'].'">'.$x['machineName'].'</option>';
			}
	}
	// REGISTER MACHINE PROCESS---------------------------------------------------------------------------------------------
	elseif($method == 'regProcess'){
		$dept = $_POST['dept'];
		$machine = $_POST['machine'];
		$process = $_POST['processTxt'];
		$name = $_POST['name'];
		// INSERT PROCESS
		$save = "INSERT INTO tblprocess VALUES ('','$dept','$machine','$process')";
		$stmt = $conn->prepare($save);
		// $stmt->execute();
	
		if($stmt->execute()){
			$notif = $name." successfully registered ".$process." to ".$machine." under ".$dept;
			$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($log);
			$stmt->execute();
			echo 'success';
		}else{
			echo 'fail';
		}
	}
	// DELETE CARMAKER------------------------------------------------------------------------------------------------------------
	elseif($method == 'delCarmaker'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		// DELETE
		$remCar = "DELETE FROM tblcarmaker WHERE listId = '$id'";
		$stmt = $conn->prepare($remCar);
		if($stmt->execute()){
			// LOG
			$notif = $name." deleted a carmaker";
			$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($log);
			$stmt->execute();
			echo 'success';
		}else{	
			echo 'failed';
		}
	}
	// DELETE LINE------------------------------------------------------------------------------------------------------------
	elseif($method == 'delLine'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		// DELETE
		$remLine = "DELETE FROM tblline WHERE listId = '$id'";
		$stmt = $conn->prepare($remLine);
		if($stmt->execute()){
			// LOG
			$notif = $name." deleted a line";
			$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($log);
			$stmt->execute();
			echo 'success';
		}else{
			echo 'failed';
		}
	}
	// DELETE PROBLEM------------------------------------------------------------------------------------------------------------
	elseif($method == 'delProblem'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		// DELETE
		$remLine = "DELETE FROM tblproblem WHERE listId = '$id'";
		$stmt = $conn->prepare($remLine);
		if($stmt->execute()){
			// LOG
			$notif = $name." deleted a machine problem";
			$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($log);
			$stmt->execute();
			echo 'success';
		}else{
			echo 'failed';
		}
	}
	// DEL SOLUTION------------------------------------------------------------------------------------------------------------
	elseif($method == 'delSolution'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		// DELETE
		$remLine = "DELETE FROM tblsolution WHERE listId = '$id'";
		$stmt = $conn->prepare($remLine);
		if($stmt->execute()){
			// LOG
			$notif = $name." deleted a machine process solution.";
			$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($log);
			$stmt->execute();
			echo 'success';
		}else{
			echo 'failed';
		}
	}
	// DEL PROCESS ------------------------------------------------------------------------------------------------------------
	elseif($method == 'delProcess'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		// DELETE
		$remLine = "DELETE FROM tblprocess WHERE listId = '$id'";
		$stmt = $conn->prepare($remLine);
		if($stmt->execute()){
			// LOG
			$notif = $name." deleted a machine process.";
			$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('','$notif','$datenow')";
			$stmt = $conn->prepare($log);
			$stmt->execute();
			echo 'success';
		}else{
			echo 'failed';
		}
	}
	// FETCH ACTIVITY -----------------------------------------------------------------------------------------------------------
	elseif($method == 'fetchActivity'){
		$qry = "SELECT *FROM activity_log ORDER BY id DESC";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
			foreach($stmt->fetchALL() as $x){
				echo '<tr>';
				echo '<td>'.$x['notif'].'</td>';
				echo '<td>'.$x['dateAct'].'</td>';
				echo '</tr>';
			}
	}
	//FETCH LOGS ------------------------------------------------------------------------------------------------------------------
	elseif($method == 'fetchLogs'){
		$dateLog = $_POST['dateLog'];
		$qry = "SELECT *FROM activity_log WHERE dateAct >= '$dateLog 00:00:00' AND dateAct <= '$dateLog 23:59:00' ORDER BY id DESC";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
				echo '<tr>';
				echo '<td>'.$x['notif'].'</td>';
				echo '<td>'.$x['dateAct'].'</td>';
				echo '</tr>';
			}
	}
	// DATABASE BACKUP----------------------------------------------------------------------------------------------------------------------
	elseif($method == 'backupDatabase'){
		$from = $_POST['from_date'];
		$to = $_POST['to_date'];
		$name = $_POST['name'];
		// CHECKING IF ALREADY BACKUPED
		$checkBack = "SELECT requestDateTime FROM backupdatabase WHERE requestDateTime >= '$from 00:00:00' AND requestDateTime <= '$to 23:59:59'";
		$stmt = $conn->prepare($checkBack);
		$stmt->execute();
		$stmt->fetchall();
		if($stmt->rowCount() > 0){
			echo 'exists';
		}else{
			// IF NOT BACKUPED PERFORMED A BACKUP SEQUENCE
			$query = "INSERT INTO backupdatabase SELECT * FROM tblhistory WHERE requestDateTime >= '$from 00:00:00' AND requestDateTime <= '$to 23:59:59' GROUP BY requestedId";
			$stmt = $conn->prepare($query);
			if($stmt->execute()){
				$removeHistory = "DELETE FROM tblhistory WHERE requestDateTime >= '$from 00:00:00' AND requestDateTime <= '$to 23:59:00'";
				$stmt = $conn->prepare($removeHistory);
				// $stmt->execute();
				if($stmt->execute()){
					$log_backup = "INSERT INTO `backup_logs` (`id`,`date_from`,`date_to`,`date_backup`,`backup_by`) VALUES ('','$from','$to','$datenow','$name')";
					$stmt = $conn->prepare($log_backup);
					$stmt->execute();
					echo 'success';
				}
			}else{
				echo 'fail';
			}
		}
	}
	// LOAD BACKUP LOGS
	elseif($method == 'loadLatestBackup'){
		$query = "SELECT date_from,date_to,date_backup,backup_by FROM backup_logs ORDER BY id DESC LIMIT 5";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo '<tr>';
			echo '<td>'.$x['date_from'].' to '.$x['date_to'].'</td>';
			echo '<td>'.$x['date_backup'].'</td>';
			echo '<td>'.$x['backup_by'].'</td>';
			echo '</tr>';
		}
	}	
	// DIE CONNECTION
	$conn = null;
?>