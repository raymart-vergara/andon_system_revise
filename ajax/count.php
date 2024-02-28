<?php
	require_once '../database/index.php';
	$method = $_GET['method'];
	if($method == 'countRequest'){
		$Qry = "SELECT listId FROM tblandonrequest";
		$query =  $db->query($Qry);
		$count = mysqli_num_rows($query);
		echo $count;
	}
	elseif($method == 'countOngoing'){
		$Qry = "SELECT listId FROM tblandonongoing";
		$query =  $db->query($Qry);
		$count = mysqli_num_rows($query);
		echo $count;
	}

	$db->close();
?>