<?php
	require 'server.php';
	$categ = $_SESSION['category'];
	if(isset($_SESSION['username'])){
		// VARIABLE
		$dept = $_SESSION['username'];
		if($dept == 'Administrator'){
		$passcode = $_SESSION['passcode'];
			// IF SESSION USERNAME WAS FETCH
		$fetchDeptData = "SELECT departmentCode,name FROM admin_account WHERE departmentCode = '$dept' AND password ='$passcode'";
		$stmt = $conn->prepare($fetchDeptData);
		$stmt->execute();
		$res = $stmt->fetchALL();
		if($stmt->rowCount() > 0){
			// $myAudioFile = "../../audio/authorized.wav";
			// 	echo '<audio autoplay="true" style="display:none;">
			// 	         <source src="'.$myAudioFile.'" type="audio/wav">
			// 	      </audio>';
			// LOOP THE DATA OF ADMIN
			foreach($res as $x){
			$name = $x['name'];
			$dept = $x['departmentCode'];
		}
	}
}else{
	// IF SESSION USERNAME WAS FETCH
	$fetchDeptData = "SELECT departmentCode,name FROM admin_account WHERE departmentCode = '$dept'";
	$stmt = $conn->prepare($fetchDeptData);
	$stmt->execute();
	$res = $stmt->fetchALL();
	if($stmt->rowCount() > 0){
		// $myAudioFile = "../../audio/authorized.wav";
		// 	echo '<audio autoplay="true" style="display:none;">
		// 	         <source src="'.$myAudioFile.'" type="audio/wav">
		// 	      </audio>';
		// LOOP THE DATA OF ADMIN
		foreach($res as $x){
		$name = $x['name'];
		$dept = $x['departmentCode'];
	}
	}
	}
}else{
	session_unset();
	session_destroy();
	header('location: ../index.php');
}

?>