<?php
require 'conn.php';
$method = $_POST['method'];
if($method == 'fetchDoubleHistory'){
	$qry = "SELECT listId,requestedId,problem,line,operatorName, COUNT(requestedId) as recordCount,machineName FROM `tblhistory` group by requestedId having count(*) > 1";
	$stmt = $conn->prepare($qry);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		foreach($stmt->fetchAll() as $x){
		echo '<tr>';
		echo '<td>'.$x['listId'].'</td>';
		echo '<td>'.$x['requestedId'].'</td>';
		echo '<td>'.$x['machineName'].'</td>';
		echo '<td>'.$x['problem'].'</td>';
		echo '<td>'.$x['line'].'</td>';
		echo '<td>'.$x['operatorName'].'</td>';
		echo '<td>'.$x['recordCount'].'</td>';
		echo '</tr>';
		$listId = $x['listId'];
		echo $del = "DELETE FROM tblhistory WHERE listId = '$listId + 1'";
		$stmt = $conn->prepare($del);
		$stmt->execute();
	}

	}else{
		echo '<tr><td colspan="7">NO DUPLICATES</td></tr>';
	}
	
}
elseif($method == 'fetchDoubleOngoing'){
		$qry = "SELECT listId,requestedId,problem,line,operatorName, COUNT(requestedId) as recordCount,machineName FROM `tblandonongoing` group by requestedId having count(*) > 1";
	$stmt = $conn->prepare($qry);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		foreach($stmt->fetchAll() as $x){
		echo '<tr>';
		echo '<td>'.$x['listId'].'</td>';
		echo '<td>'.$x['requestedId'].'</td>';
		echo '<td>'.$x['machineName'].'</td>';
		echo '<td>'.$x['problem'].'</td>';
		echo '<td>'.$x['line'].'</td>';
		echo '<td>'.$x['operatorName'].'</td>';
		echo '<td>'.$x['recordCount'].'</td>';
		echo '</tr>';
		$listId = $x['listId'];
		echo $del = "DELETE FROM tblandonongoing WHERE listId = '$listId + 1'";
		$stmt = $conn->prepare($del);
		$stmt->execute();
	}

	}else{
		echo '<tr><td colspan="7">NO DUPLICATES</td></tr>';
	}
}

elseif($method == 'fetchDoubleReq'){
	$qry = "SELECT *,count(listId) as recordCount FROM `tblandonrequest` GROUP BY category,line,machineName,machineNo,process,problem,requestedId,operatorName,department,status,ipPathReq having count(*) >1";
	$stmt = $conn->prepare($qry);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		foreach($stmt->fetchAll() as $x){
		echo '<tr>';
		echo '<td>'.$x['listId'].'</td>';
		echo '<td>'.$x['requestedId'].'</td>';
		echo '<td>'.$x['machineName'].'</td>';
		echo '<td>'.$x['problem'].'</td>';
		echo '<td>'.$x['line'].'</td>';
		echo '<td>'.$x['operatorName'].'</td>';
		echo '<td>'.$x['recordCount'].'</td>';
		echo '</tr>';
		$listId = $x['listId'];
		echo $del = "DELETE FROM tblandonrequest WHERE listId = '$listId + 1'";
		$stmt = $conn->prepare($del);
		$stmt->execute();
	}

	}else{
		echo '<tr><td colspan="7">NO DUPLICATES</td></tr>';
	}
}
?>