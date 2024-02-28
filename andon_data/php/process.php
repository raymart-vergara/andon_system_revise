<?php
	include 'conn.php';
	$method = $_POST['method'];

	if($method == 'count_backupDB'){
		$query = "SELECT COUNT(listId) as count FROM backupdatabase";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo $x['count'];
		}
	}

	if($method == 'count_history'){
		$query = "SELECT COUNT(listId) as count FROM tblhistory";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo $x['count'];
		}
	}

	if($method == 'count_user'){
		$query = "SELECT COUNT(listId) as count FROM tblaccount WHERE accountType = 'Operator Account' OR accountType = 'Event Account' ";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo $x['count'];
		}
	}

	if($method == 'count_pending'){
		$query = "SELECT COUNT(listId) as count,department FROM tblandonrequest group by department ";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo '<tr>
					<td>'.$x['department'].'</td>
					<td style="color:#f55a42;font-weight:bold;">'.$x['count'].'</td>
				 </tr>';
			
		}
	}

	if($method == 'count_ongoing'){
		$query = "SELECT COUNT(listId) as count,department FROM tblandonongoing group by department ";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo '<tr>
					<td>'.$x['department'].'</td>
					<td style="color:#d442f5;font-weight:bold;">'.$x['count'].'</td>
				 </tr>';
			
		}
	}

	if($method == 'count_tech'){
		$query = "SELECT COUNT(listId) as count,carMaker FROM tblaccount WHERE accountType='Admin Account' group by carMaker ";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo '<tr>
					<td>'.$x['carMaker'].'</td>
					<td style="color:#f54266;font-weight:bold;">'.$x['count'].'</td>
				 </tr>';
			
		}
	}
?>