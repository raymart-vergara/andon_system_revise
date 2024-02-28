<?php
	include 'conn.php';
	// METHOD
	$method = $_POST['method'];
	if($method == 'search'){
		$dateFrom = $_POST['from'];
		$dateTo = $_POST['to'];
		$categ = $_POST['categ'];
		$dept =$_POST['dept'];

		if($categ == 'all'){
			$qry = "SELECT DISTINCT *FROM tblandoncancelrequest WHERE requestDateTime >= '$dateFrom 00:00:00' AND requestDateTime <='$dateTo 23:59:00' AND department ='$dept'";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['cancelDateTime'].'</td>';
					echo '<td>'.$x['reason'].'</td>';
					echo '</tr>';
				}
		}
		// CATEG = INITIAL
		elseif($categ == 'Initial'){
			$qry = "SELECT DISTINCT *FROM tblandoncancelrequest WHERE requestDateTime >= '$dateFrom 00:00:00' AND requestDateTime <='$dateTo 23:59:00' AND department ='$dept' AND category ='Initial'";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['cancelDateTime'].'</td>';
					echo '<td>'.$x['reason'].'</td>';
					echo '</tr>';
				}
		}
		// CATEG = FINAL
		elseif($categ == 'Final'){
			$qry = "SELECT DISTINCT *FROM tblandoncancelrequest WHERE requestDateTime >= '$dateFrom 00:00:00' AND requestDateTime <='$dateTo 23:59:00' AND department ='$dept' AND category ='Final'";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['cancelDateTime'].'</td>';
					echo '<td>'.$x['reason'].'</td>';
					echo '</tr>';
				}
		}
	}
	elseif($method == 'generateAll'){
		$dept =$_POST['dept'];
		$qry = "SELECT DISTINCT *FROM tblandoncancelrequest WHERE department ='$dept' ORDER BY listId DESC";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			$res = $stmt->fetchALL();
				foreach($res as $x){
					echo '<tr>';
					echo '<td>'.$x['category'].'</td>';
					echo '<td>'.$x['line'].'</td>';
					echo '<td>'.$x['machineName'].'</td>';
					echo '<td>'.$x['machineNo'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.$x['problem'].'</td>';
					echo '<td>'.$x['operatorName'].'</td>';
					echo '<td>'.$x['requestDateTime'].'</td>';
					echo '<td>'.$x['department'].'</td>';
					echo '<td>'.$x['cancelDateTime'].'</td>';
					echo '<td>'.$x['reason'].'</td>';
					echo '</tr>';
				}
	}

	// KILL CONNECTION
	$conn = null;
?>