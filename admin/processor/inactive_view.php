<?php
include 'conn.php';
$method = $_POST['method'];
if($method == 'eqd_view'){
	$sql = "SELECT department, machineName,problem FROM tblproblem WHERE department = 'EQD' ORDER BY machineName ASC";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		echo '<tr>';
		echo '<td>'.$x['machineName'].'</td>';
		echo '<td>'.$x['problem'].'</td>';
		echo '</tr>';
	}
}

// PE
if($method == 'pe_view'){
	$sql = "SELECT department, machineName,problem FROM tblproblem WHERE department = 'PE' ORDER BY machineName ASC";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		echo '<tr>';
		echo '<td>'.$x['machineName'].'</td>';
		echo '<td>'.$x['problem'].'</td>';
		echo '</tr>';
	}
}
// IT
if($method == 'it_view'){
	$sql = "SELECT department, machineName,problem FROM tblproblem WHERE department = 'IT' ORDER BY machineName ASC";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		echo '<tr>';
		echo '<td>'.$x['machineName'].'</td>';
		echo '<td>'.$x['problem'].'</td>';
		echo '</tr>';
	}
}
?>