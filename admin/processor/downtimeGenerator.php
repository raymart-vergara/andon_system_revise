<?php
	include 'conn.php';
	$method =  $_POST['method'];
	if($method == 'generate'){
		$from = $_POST['from'];
		$to = $_POST['to'];
		$server = $_POST['server'];
		if($server == 'live'){
			// QUERY 
			$Qry = "SELECT DISTINCT *FROM tblhistory WHERE requestDateTime >= '$from 00:00:00' AND requestDateTime <= '$to 23:59:59' AND fixRemarks='DOWNTIME' ORDER BY fixInterval DESC LIMIT 10";
			$stmt = $conn->prepare($Qry);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60.0 + $fixingTime[1] * 1.0 + $fixingTime[2] / 60);
					echo '<tr>';
					echo '<td>'.$x['requestedId'].'</td>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td class="dept">'.$x['department'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.round($x['waitingTime'],2).'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['endDateTime'].'</td>';
					echo '<td>'.$x['counter_measure'].'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td class="fixTime">'.round($fixingTimeminutes,2).'</td>';
					echo '</tr>';
				}
			}else{
			$Qry = "SELECT DISTINCT *FROM backupdatabase WHERE requestDateTime >= '$from 00:00:00' AND requestDateTime <= '$to 23:59:59' AND fixRemarks='DOWNTIME' ORDER BY fixInterval DESC LIMIT 10";
			$stmt = $conn->prepare($Qry);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60.0 + $fixingTime[1] * 1.0 + $fixingTime[2] / 60);
					echo '<tr>';
					echo '<td>'.$x['requestedId'].'</td>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td class="dept">'.$x['department'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.round($x['waitingTime'],2).'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['endDateTime'].'</td>';
					echo '<td>'.$x['counter_measure'].'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td class="fixTime">'.round($fixingTimeminutes,2).'</td>';
					echo '</tr>';
				}
			}
		

	}
	elseif($method == 'generate_machine_dw'){
		$server = $_POST['server'];
		$machine = $_POST['machine'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		if($server == 'live_server'){
			$qry = "SELECT SUM(TIMEDIFF(endDateTime,startDateTime)/60)as total_mins,department FROM tblhistory WHERE machineName = '$machine' AND fixRemarks='DOWNTIME' AND requestDateTime >= '$from 00:00:00' AND requestDateTime <= '$to 23:59:59' GROUP BY department";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchALL() as $x){
					// echo $x['total_mins'];
					echo '<tr>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td class="entry_mins">'.round($x['total_mins'],2).'</td>';
					echo '</tr>';
				}	
					echo '<tr>';
					echo '<td>TOTAL DOWNTIME ('.$machine.')</td>';
					echo '<td id="sum_min"></td>';
					echo '</tr>';
			}else{
				echo '<tr>';
				echo '<td colspan="2">No Record</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>TOTAL DOWNTIME ('.$machine.')</td>';
				echo '<td id="sum_min"></td>';
				echo '</tr>';
			}
		}else{
			$qry = "SELECT SUM(TIMEDIFF(endDateTime,startDateTime)/60)as total_mins,department FROM backupdatabase WHERE machineName = '$machine' AND fixRemarks='DOWNTIME' AND requestDateTime >= '$from 00:00:00' AND requestDateTime <= '$to 23:59:59' GROUP BY department";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchALL() as $x){
					// echo $x['total_mins'];
					echo '<tr>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td class="entry_mins">'.round($x['total_mins'],2).'</td>';
					echo '</tr>';
				}	
					echo '<tr>';
					echo '<td>TOTAL DOWNTIME ('.$machine.')</td>';
					echo '<td id="sum_min"></td>';
					echo '</tr>';
			}else{
				echo '<tr>';
				echo '<td colspan="2">No Record</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>TOTAL DOWNTIME ('.$machine.')</td>';
				echo '<td id="sum_min"></td>';
				echo '</tr>';
			}
		}
	}
	$conn=null;
?>