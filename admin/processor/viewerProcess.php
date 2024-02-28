<?php
	// include 'conn.php';
	// error_reporting(0);
	if(isset($_POST['category'])){
		$categ = $_POST['category'];
		$dept = $_POST['dept'];
		if(empty($categ)){
			echo 'Select category';
		}elseif(empty($dept)){
			echo 'Select Department';
		}else{
			header('location: ../admin/page/andonTV.php?dept='.$dept.'&&categ='.$categ);
		}
	}
?>