<?php
	include 'conn.php';
	$server = $_POST['server'];
	if($server == 'live'){
		$from = $_POST['date_from'];
		$to = $_POST['date_to'];
		$fixing_stat = $_POST['fixing_status'];
		// FETCHING DATA FROM LIVE SERVER ALL FIX STATUS
		if($fixing_stat == 'cmb'){
			$query = "SELECT requestedId, category,line,machineName, machineNo,problem,operatorName,department,technicianName,backupTechnicianName,backupComment,backupRequestTime,backupAccept,waitingTime,requestDateTime,startDateTime,endDateTime,fixInterval,fixRemarks,counter_measure,solution_TRD,applicator_name,applicator_num,replace_status,work_order_no FROM tblhistory LEFT JOIN applicator_details ON tblhistory.requestedId = applicator_details.request_id WHERE requestDateTime >= '$from 08:00:00' AND requestDateTime <='$to 23:59:59' AND solution_TRD ='replace'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchALL() as $x){
					// FIX INTERVAL MATHEMATICAL COMPUTATION
					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
					if($x['backupRequestTime'] = '0000-00-00'){
						$x['backupRequestTime'] = 'N/A';
					}if(empty($x['backupComment'])){
						$x['backupComment'] = 'N/A';
					}if(empty($x['backupTechnicianName'])){
						$x['backupTechnicianName'] = 'N/A';
					}if($x['backupAccept'] = '0000-00-00 00:00:00'){
						$x['backupAccept'] = 'N/A';
					}
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.round($x['waitingTime'],2).'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['endDateTime'].'</td>';
					echo '<td>'.round($fixingTimeminutes,2).'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['counter_measure'].'</td>';
					echo '<td>'.$x['fixRemarks'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupTechnicianName'].'</td>';
					echo '<td>'.$x['backupAccept'].'</td>';
					echo '<td>'.$x['solution_TRD'].'</td>';
					echo '<td>'.$x['applicator_name'].'</td>';
					echo '<td>'.$x['applicator_num'].'</td>';
					echo '<td>'.$x['replace_status'].'</td>';
					echo '<td>'.$x['work_order_no'].'</td>';
					echo '</tr>';
				}
			}
		}
		// DOWNTIME
		if($fixing_stat == 'dw'){
			$query = "SELECT requestedId, category,line,machineName, machineNo,problem,operatorName,department,technicianName,backupTechnicianName,backupComment,backupRequestTime,backupAccept,waitingTime,requestDateTime,startDateTime,endDateTime,fixInterval,fixRemarks,counter_measure,solution_TRD,applicator_name,applicator_num,replace_status,work_order_no FROM tblhistory LEFT JOIN applicator_details ON tblhistory.requestedId = applicator_details.request_id WHERE requestDateTime >= '$from 08:00:00' AND requestDateTime <='$to 23:59:59' AND solution_TRD ='replace' AND fixRemarks ='DOWNTIME'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchALL() as $x){
					// FIX INTERVAL MATHEMATICAL COMPUTATION
					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
					if($x['backupRequestTime'] = '0000-00-00'){
						$x['backupRequestTime'] = 'N/A';
					}if(empty($x['backupComment'])){
						$x['backupComment'] = 'N/A';
					}if(empty($x['backupTechnicianName'])){
						$x['backupTechnicianName'] = 'N/A';
					}if($x['backupAccept'] = '0000-00-00 00:00:00'){
						$x['backupAccept'] = 'N/A';
					}
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.round($x['waitingTime'],2).'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['endDateTime'].'</td>';
					echo '<td>'.round($fixingTimeminutes,2).'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['counter_measure'].'</td>';
					echo '<td>'.$x['fixRemarks'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupTechnicianName'].'</td>';
					echo '<td>'.$x['backupAccept'].'</td>';
					echo '<td>'.$x['solution_TRD'].'</td>';
					echo '<td>'.$x['applicator_name'].'</td>';
					echo '<td>'.$x['applicator_num'].'</td>';
					echo '<td>'.$x['replace_status'].'</td>';
					echo '<td>'.$x['work_order_no'].'</td>';
					echo '</tr>';
				}
			}
		}

		// GOOD FIX
		if($fixing_stat == 'gd'){
			$query = "SELECT requestedId, category,line,machineName, machineNo,problem,operatorName,department,technicianName,backupTechnicianName,backupComment,backupRequestTime,backupAccept,waitingTime,requestDateTime,startDateTime,endDateTime,fixInterval,fixRemarks,counter_measure,solution_TRD,applicator_name,applicator_num,replace_status,work_order_no FROM tblhistory LEFT JOIN applicator_details ON tblhistory.requestedId = applicator_details.request_id WHERE requestDateTime >= '$from 08:00:00' AND requestDateTime <='$to 23:59:59' AND solution_TRD ='replace' AND fixRemarks ='GOOD'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchALL() as $x){
					// FIX INTERVAL MATHEMATICAL COMPUTATION
					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
					if($x['backupRequestTime'] = '0000-00-00'){
						$x['backupRequestTime'] = 'N/A';
					}if(empty($x['backupComment'])){
						$x['backupComment'] = 'N/A';
					}if(empty($x['backupTechnicianName'])){
						$x['backupTechnicianName'] = 'N/A';
					}if($x['backupAccept'] = '0000-00-00 00:00:00'){
						$x['backupAccept'] = 'N/A';
					}
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.round($x['waitingTime'],2).'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['endDateTime'].'</td>';
					echo '<td>'.round($fixingTimeminutes,2).'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['counter_measure'].'</td>';
					echo '<td>'.$x['fixRemarks'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupTechnicianName'].'</td>';
					echo '<td>'.$x['backupAccept'].'</td>';
					echo '<td>'.$x['solution_TRD'].'</td>';
					echo '<td>'.$x['applicator_name'].'</td>';
					echo '<td>'.$x['applicator_num'].'</td>';
					echo '<td>'.$x['replace_status'].'</td>';
					echo '<td>'.$x['work_order_no'].'</td>';
					echo '</tr>';
				}
			}
	}
}
// BACKUP SERVER QUERY
if($server == 'backup'){
		$from = $_POST['date_from'];
		$to = $_POST['date_to'];
		$fixing_stat = $_POST['fixing_status'];
		// FETCHING DATA FROM LIVE SERVER ALL FIX STATUS
		if($fixing_stat == 'cmb'){
			$query = "SELECT requestedId, category,line,machineName, machineNo,problem,operatorName,department,technicianName,backupTechnicianName,backupComment,backupRequestTime,backupAccept,waitingTime,requestDateTime,startDateTime,endDateTime,fixInterval,fixRemarks,counter_measure,solution_TRD,applicator_name,applicator_num,replace_status,work_order_no FROM backupdatabase LEFT JOIN applicator_details ON backupdatabase.requestedId = applicator_details.request_id WHERE requestDateTime >= '$from 08:00:00' AND requestDateTime <='$to 23:59:59' AND solution_TRD ='replace'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchALL() as $x){
					// FIX INTERVAL MATHEMATICAL COMPUTATION
					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
					if($x['backupRequestTime'] = '0000-00-00'){
						$x['backupRequestTime'] = 'N/A';
					}if(empty($x['backupComment'])){
						$x['backupComment'] = 'N/A';
					}if(empty($x['backupTechnicianName'])){
						$x['backupTechnicianName'] = 'N/A';
					}if($x['backupAccept'] = '0000-00-00 00:00:00'){
						$x['backupAccept'] = 'N/A';
					}
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.round($x['waitingTime'],2).'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['endDateTime'].'</td>';
					echo '<td>'.round($fixingTimeminutes,2).'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['counter_measure'].'</td>';
					echo '<td>'.$x['fixRemarks'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupTechnicianName'].'</td>';
					echo '<td>'.$x['backupAccept'].'</td>';
					echo '<td>'.$x['solution_TRD'].'</td>';
					echo '<td>'.$x['applicator_name'].'</td>';
					echo '<td>'.$x['applicator_num'].'</td>';
					echo '<td>'.$x['replace_status'].'</td>';
					echo '<td>'.$x['work_order_no'].'</td>';
					echo '</tr>';
				}
			}
		}
		// DOWNTIME
		if($fixing_stat == 'dw'){
			$query = "SELECT requestedId, category,line,machineName, machineNo,problem,operatorName,department,technicianName,backupTechnicianName,backupComment,backupRequestTime,backupAccept,waitingTime,requestDateTime,startDateTime,endDateTime,fixInterval,fixRemarks,counter_measure,solution_TRD,applicator_name,applicator_num,replace_status,work_order_no FROM backupdatabase LEFT JOIN applicator_details ON backupdatabase.requestedId = applicator_details.request_id WHERE requestDateTime >= '$from 08:00:00' AND requestDateTime <='$to 23:59:59' AND solution_TRD ='replace' AND fixRemarks ='DOWNTIME'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchALL() as $x){
					// FIX INTERVAL MATHEMATICAL COMPUTATION
					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
					if($x['backupRequestTime'] = '0000-00-00'){
						$x['backupRequestTime'] = 'N/A';
					}if(empty($x['backupComment'])){
						$x['backupComment'] = 'N/A';
					}if(empty($x['backupTechnicianName'])){
						$x['backupTechnicianName'] = 'N/A';
					}if($x['backupAccept'] = '0000-00-00 00:00:00'){
						$x['backupAccept'] = 'N/A';
					}
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.round($x['waitingTime'],2).'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['endDateTime'].'</td>';
					echo '<td>'.round($fixingTimeminutes,2).'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['counter_measure'].'</td>';
					echo '<td>'.$x['fixRemarks'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupTechnicianName'].'</td>';
					echo '<td>'.$x['backupAccept'].'</td>';
					echo '<td>'.$x['solution_TRD'].'</td>';
					echo '<td>'.$x['applicator_name'].'</td>';
					echo '<td>'.$x['applicator_num'].'</td>';
					echo '<td>'.$x['replace_status'].'</td>';
					echo '<td>'.$x['work_order_no'].'</td>';
					echo '</tr>';
				}
			}
		}

		// GOOD FIX
		if($fixing_stat == 'gd'){
			$query = "SELECT requestedId, category,line,machineName, machineNo,problem,operatorName,department,technicianName,backupTechnicianName,backupComment,backupRequestTime,backupAccept,waitingTime,requestDateTime,startDateTime,endDateTime,fixInterval,fixRemarks,counter_measure,solution_TRD,applicator_name,applicator_num,replace_status,work_order_no FROM backupdatabase LEFT JOIN applicator_details ON backupdatabase.requestedId = applicator_details.request_id WHERE requestDateTime >= '$from 08:00:00' AND requestDateTime <='$to 23:59:59' AND solution_TRD ='replace' AND fixRemarks ='GOOD'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchALL() as $x){
					// FIX INTERVAL MATHEMATICAL COMPUTATION
					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
					if($x['backupRequestTime'] = '0000-00-00'){
						$x['backupRequestTime'] = 'N/A';
					}if(empty($x['backupComment'])){
						$x['backupComment'] = 'N/A';
					}if(empty($x['backupTechnicianName'])){
						$x['backupTechnicianName'] = 'N/A';
					}if($x['backupAccept'] = '0000-00-00 00:00:00'){
						$x['backupAccept'] = 'N/A';
					}
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.round($x['waitingTime'],2).'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['endDateTime'].'</td>';
					echo '<td>'.round($fixingTimeminutes,2).'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['counter_measure'].'</td>';
					echo '<td>'.$x['fixRemarks'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupTechnicianName'].'</td>';
					echo '<td>'.$x['backupAccept'].'</td>';
					echo '<td>'.$x['solution_TRD'].'</td>';
					echo '<td>'.$x['applicator_name'].'</td>';
					echo '<td>'.$x['applicator_num'].'</td>';
					echo '<td>'.$x['replace_status'].'</td>';
					echo '<td>'.$x['work_order_no'].'</td>';
					echo '</tr>';
				}
			}
	}
}
?>