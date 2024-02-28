<?php
	include 'conn.php';

	$process = $_GET['process'];
	$date_now = date('Y-m-d H:i:s');
	// PROCESS
	if($process === 'fetchPending'){
		$concernDept = $_GET['concern'];
		$category = $_GET['categ'];
		if($category == 'Initial'){
			$pendingAndon = "SELECT *FROM tblandonrequest WHERE department = '$concernDept' AND category = 'Initial'";
			$stmt = $conn->prepare($pendingAndon);
			$stmt->execute();
			$result = $stmt->fetchALL();
			foreach($result as $x){
				$waiting_time =  strtotime($date_now) - strtotime($x['requestDateTime']);
				$min = round($waiting_time / 60,2);
				if($min > 30){
				echo '<tr style="cursor:pointer;background-color:#ed6b6b;color:white;" class="modal-trigger" data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
				}
				elseif($x['status'] == 'confirm'){
				echo '<tr style="cursor:pointer;background-color:yellow;" class="modal-trigger" data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
				}else{
				echo '<tr style="cursor:pointer;" class="modal-trigger " data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
			}
		}
	}
	// END OF CODE IN INITIAL PENDING

	// START OF FINAL FETCHING
		elseif($category == 'Final'){
			$pendingAndon = "SELECT *FROM tblandonrequest WHERE department = '$concernDept' AND category = 'Final'";
			$stmt = $conn->prepare($pendingAndon);
			$stmt->execute();
			$result = $stmt->fetchALL();
			foreach($result as $x){
				$waiting_time =  strtotime($date_now) - strtotime($x['requestDateTime']);
				$min = round($waiting_time / 60,2);
				if($min > 30){
				echo '<tr style="cursor:pointer;background-color:#ed6b6b;color:white;" class="modal-trigger" data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
				}
				elseif($x['status'] == 'confirm'){
				echo '<tr style="cursor:pointer;background-color:yellow;" class="modal-trigger" data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
				}else{
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
			}
		}
	}
	// ALL
	else{
		
		$pendingAndon = "SELECT *FROM tblandonrequest WHERE department = '$concernDept'";
			$stmt = $conn->prepare($pendingAndon);
			$stmt->execute();
			$result = $stmt->fetchALL();
			foreach($result as $x){
				$waiting_time =  strtotime($date_now) - strtotime($x['requestDateTime']);
				$min = round($waiting_time / 60,2);
				if($min > 30){
				echo '<tr style="cursor:pointer;background-color:#ed6b6b;color:white;" class="modal-trigger" data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
				}
				elseif($x['status'] == 'confirm'){
				echo '<tr style="cursor:pointer;background-color:yellow;" class="modal-trigger" data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
				}else{
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="modalConfirmAndon" onclick="clickRequest(&quot;'.$x['listId'].'&quot;)">';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['confirm_by'].'</td>';
				echo '</tr>';
			}
		}
	}
}
// END CODE FOR FETCHING PENDING ANDON
	// FETCH ONGOING 
	if($process === 'fetchOngoing'){
		$concernDept = $_GET['concern'];
		$category = $_GET['category'];
		if($category == 'Initial'){
			// SQL FETCH REQUEST 
			$ongoingAndon = "SELECT *FROM tblandonongoing WHERE department = '$concernDept' AND status ='Ongoing' AND category = 'Initial'";
			$stmt = $conn->prepare($ongoingAndon);
			$stmt->execute();
			$result = $stmt->fetchALL();
			foreach($result as $x){
				$fixing_time =  strtotime($date_now) - strtotime($x['startDateTime']);
				$min = round($fixing_time / 60,2);
				if($min > 60){
					echo '<tr onclick="clickOngoing(&quot;'.$x['listId'].'&quot;)" style="cursor:pointer;background-color:#ed6b6b;color:white;" class="modal-trigger" data-target="modalOngoingMenu">';
					echo '<td>'.$x['line']."&nbsp;/".$x['machineName']."-".$x['machineNo']."&nbsp;(".$x['process'].")".'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '</tr>';
				}else{
					echo '<tr onclick="clickOngoing(&quot;'.$x['listId'].'&quot;)" style="cursor:pointer;" class="modal-trigger" data-target="modalOngoingMenu">';
					echo '<td>'.$x['line']."&nbsp;/".$x['machineName']."-".$x['machineNo']."&nbsp;(".$x['process'].")".'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '</tr>';
				}
				echo '</tr>';
			}
		}elseif($category == 'Final'){
			// SQL FETCH REQUEST 
			$ongoingAndon = "SELECT *FROM tblandonongoing WHERE department = '$concernDept' AND status ='Ongoing' AND category = 'Final'";
			$stmt = $conn->prepare($ongoingAndon);
			$stmt->execute();
			$result = $stmt->fetchALL();
			foreach($result as $x){
				$fixing_time =  strtotime($date_now) - strtotime($x['startDateTime']);
				$min = round($fixing_time / 60,2);
				if($min > 60){
					echo '<tr onclick="clickOngoing(&quot;'.$x['listId'].'&quot;)" style="cursor:pointer;background-color:#ed6b6b;color:white;" class="modal-trigger" data-target="modalOngoingMenu">';
					echo '<td>'.$x['line']."&nbsp;/".$x['machineName']."-".$x['machineNo']."&nbsp;(".$x['process'].")".'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '</tr>';
				}else{
					echo '<tr onclick="clickOngoing(&quot;'.$x['listId'].'&quot;)" style="cursor:pointer;" class="modal-trigger" data-target="modalOngoingMenu">';
					echo '<td>'.$x['line']."&nbsp;/".$x['machineName']."-".$x['machineNo']."&nbsp;(".$x['process'].")".'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '</tr>';
				}
			}
		}else{
			// SQL FETCH REQUEST 
			$ongoingAndon = "SELECT *FROM tblandonongoing WHERE department = '$concernDept' AND status ='Ongoing'";
			$stmt = $conn->prepare($ongoingAndon);
			$stmt->execute();
			$result = $stmt->fetchALL();
			foreach($result as $x){
				$fixing_time =  strtotime($date_now) - strtotime($x['startDateTime']);
				$min = round($fixing_time / 60,2);
				if($min > 60){
					echo '<tr onclick="clickOngoing(&quot;'.$x['listId'].'&quot;)" style="cursor:pointer;background-color:#ed6b6b;color:white;" class="modal-trigger" data-target="modalOngoingMenu">';
					echo '<td>'.$x['line']."&nbsp;/".$x['machineName']."-".$x['machineNo']."&nbsp;(".$x['process'].")".'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '</tr>';
				}else{
					echo '<tr onclick="clickOngoing(&quot;'.$x['listId'].'&quot;)" style="cursor:pointer;" class="modal-trigger" data-target="modalOngoingMenu">';
					echo '<td>'.$x['line']."&nbsp;/".$x['machineName']."-".$x['machineNo']."&nbsp;(".$x['process'].")".'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['technicianName'].'</td>';
					echo '<td>'.$x['startDateTime'].'</td>';
					echo '<td>'.$x['backupComment'].'</td>';
					echo '<td>'.$x['backupRequestTime'].'</td>';
					echo '</tr>';
				}
			}
		}
	}
	$conn = null;
?>