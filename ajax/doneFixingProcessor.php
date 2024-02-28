<?php
	include "../database/index.php";
	// TRD AND EQD CONCERN
	if($_GET['machine_name'] == 'TRD' && $_GET['department'] == 'EQD' && $_GET['concern_trd'] == 'Applicator'){
	$id = 0;
	$requestID = $_GET['requestedId'];
	$categ = $_GET['category'];
	$line = $_GET['line'];
	$machineName = $_GET['machine_name'];
	$machineNo = $_GET['machine_num'];
	$process = $_GET['process'];
	$problemEncounter = $_GET['problemEn'];
	$operatorName = $_GET['operator_name'];
	$department = $_GET['department'];
	$technicianID = $_GET['techID'];
	$technicianName = $_GET['techName'];
	$backupTechID = $_GET['backupID'];
	$backupTechName = $_GET['backName'];
	$backupComment = $_GET['backComment'];
	$backupReqTime = $_GET['backReqTime'];
	$status = $_GET['status'];
	$waitingTime = $_GET['waiting_time'];
	$reqDateTime = $_GET['andonreqdate'];
	$startFixTime = $_GET['startFixing'];
	$endAndonTime = $_GET['andonenddate'];
	$fixInterval = $_GET['fixingTime'];
	$fixRemarks = $_GET['fixingRemarks'];
	$counterMeasure = $_GET['solution'];
	$counterMeasure = trim($counterMeasure);
	$serialNo = trim($_GET['serial']);
	// $jigName = trim($_GET['jig_name']);
	// $circuit_loc = trim($_GET['circuitLoc']);
	$jigName = '';
	$circuit_loc = '';
	$ipAddReq = $_GET['ipPathReq'];
	$ipAddTechAccept = $_GET['ipPathAccept'];
	$ipEndAndon = $_SERVER['REMOTE_ADDR'];
	$backupAccept = $_GET['backupAccept'];
	$lotNumber = '';
	$productNumber = '';
	// TRD APPLICATOR DETAILS
	$solutionTRD = $_GET['solutionTRD'];
	$appName = trim($_GET['appl_name']);
	$appNumber = trim($_GET['appl_number']);
	$replace = $_GET['replaceStat'];
	$work_order_no = $_GET['work_order_no'];
	// ------------------------------------------------------------------------------------------------------------------------
	if($counterMeasure == ' ' || $counterMeasure == '' || $counterMeasure == '--' || $counterMeasure == '-' || $solutionTRD == '' || $appName == '' || $appNumber == '' || $replace == '' || $work_order_no == ''){
		echo 'counterMeasure';
	}
	else{
		$endAndonSQL = "INSERT INTO tblhistory VALUES ('$id','$requestID','$categ','$line','$machineName','$machineNo','$process','$problemEncounter','$operatorName','$department','$technicianID','$technicianName','$backupTechID','$backupTechName','$backupComment','$backupReqTime','$backupAccept','$status','$waitingTime','$reqDateTime','$startFixTime','$endAndonTime','$fixInterval','$fixRemarks','$counterMeasure','$serialNo','$jigName','$circuit_loc','$lotNumber','$productNumber','$ipAddReq','$ipAddTechAccept','$ipEndAndon')";
		// IF EXECUTE THE ENTRY FROM ANDON ONGOING WILL DISAPPEAR AND TRANSFER TO HISTORY -------------------------------------------------------
		if($db->query($endAndonSQL)){
			// INSERT INTO APPLICATOR DETAILS IF SOLUTION TRD IS FOR REPLACEMENT
			if($solutionTRD == 'replace'){
			$appQL = "INSERT INTO applicator_details (`id`,`solution_TRD`,`applicator_name`,`applicator_num`,`replace_status`,`work_order_no`,`request_id`) VALUES 
			('0','$solutionTRD','$appName','$appNumber','$replace','$work_order_no','$requestID')";
			if($db->query($appQL)){
				// DELETE FROM ONGOING
				$delOngoingSQL = "DELETE from tblandonongoing WHERE requestedId = '$requestID'";
				if($db->query($delOngoingSQL)){
				echo "success";
					}		
				}
			}else{
				// DELETE FROM ONGOING
				$delOngoingSQL = "DELETE from tblandonongoing WHERE requestedId = '$requestID'";
				if($db->query($delOngoingSQL)){
				echo "success";
				}		
			}
		}else{
			echo "fail";
		}
	}
}
// NON TRD CONCERN SYNTAX UNIVERSAL QUERY
else{
	$id = 0;
	$requestID = $_GET['requestedId'];
	$categ = $_GET['category'];
	$line = $_GET['line'];
	$machineName = $_GET['machine_name'];
	$machineNo = $_GET['machine_num'];
	$process = $_GET['process'];
	$problemEncounter = $_GET['problemEn'];
	$operatorName = $_GET['operator_name'];
	$department = $_GET['department'];
	$technicianID = $_GET['techID'];
	$technicianName = $_GET['techName'];
	$backupTechID = $_GET['backupID'];
	$backupTechName = $_GET['backName'];
	$backupComment = $_GET['backComment'];
	$backupReqTime = $_GET['backReqTime'];
	$status = $_GET['status'];
	$waitingTime = $_GET['waiting_time'];
	$reqDateTime = $_GET['andonreqdate'];
	$startFixTime = $_GET['startFixing'];
	$endAndonTime = $_GET['andonenddate'];
	$fixInterval = $_GET['fixingTime'];
	$fixRemarks = $_GET['fixingRemarks'];
	$counterMeasure = $_GET['solution'];
	$counterMeasure = trim($counterMeasure);
	$serialNo = trim($_GET['serial']);
	$jigName = trim($_GET['jig_name']);
	$circuit_loc = trim($_GET['circuitLoc']);
	$ipAddReq = $_GET['ipPathReq'];
	$ipAddTechAccept = $_GET['ipPathAccept'];
	$ipEndAndon = $_SERVER['REMOTE_ADDR'];
	$backupAccept = $_GET['backupAccept'];
	$lotNumber = '';
	$productNumber = '';
	// TRD APPLICATOR SHITNESS
	$solutionTRD = $_GET['solutionTRD'];
	$appName = $_GET['appl_name'];
	$appNumber = $_GET['appl_number'];
	$replace = $_GET['replaceStat'];
	// QUERY NON TRD CONCERN
	if($counterMeasure == ' ' || $counterMeasure == '' || $counterMeasure == '--' || $counterMeasure == '-' ){
		echo 'counterMeasure';
	}
	else{
		$endAndonSQL = "INSERT INTO tblhistory VALUES ('$id','$requestID','$categ','$line','$machineName','$machineNo','$process','$problemEncounter','$operatorName','$department','$technicianID','$technicianName','$backupTechID','$backupTechName','$backupComment','$backupReqTime','$backupAccept','$status','$waitingTime','$reqDateTime','$startFixTime','$endAndonTime','$fixInterval','$fixRemarks','$counterMeasure','$serialNo','$jigName','$circuit_loc','$lotNumber','$productNumber','$ipAddReq','$ipAddTechAccept','$ipEndAndon')";
		// IF EXECUTE THE ENTRY FROM ANDON ONGOING WILL DISAPPEAR AND TRANSFER TO HISTORY -------------------------------------------------------
		if($db->query($endAndonSQL)){
			// DELETE FROM ONGOING
			$delOngoingSQL = "DELETE from tblandonongoing WHERE requestedId = '$requestID'";
			if($db->query($delOngoingSQL)){
			echo "success";
			}		
		}else{
			 echo "fail";
		}
	}
}
?>