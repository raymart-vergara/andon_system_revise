<?php
// CONNECTION
include '../database/index.php';
$method = $_GET['method'];
if($method == 'selectDept'){
	echo '<option value="" disabled selected>Department</option>';
	$sql = "SELECT *FROM tbldepartment";
	$query = $db->query($sql);
	while ($x = $query->fetch_assoc()) {
		echo '<option value="'.$x['deptCode'].'">'.$x['description'].'</option>';
	}
}
// CHECK USER RESTRICT ADMIN ACCT HERE
elseif($method == 'checkUser'){
	$scanID = trim($_GET['id']);
	$qry = "SELECT * FROM tblaccount WHERE idNumber = '$scanID' HAVING accountType = 'Operator Account' OR accountType = 'Event Account' LIMIT 1";
	$query = $db->query($qry);
	if(mysqli_num_rows($query) > 0){
		while($x = $query->fetch_assoc()){
			echo $x['firstName']." ".$x['lastName'];
		}
	}else{
		echo 'invalid';
	}
}
// CARMODEL
elseif($method == 'selectCarmodel'){
	$operatorID = $_GET['operator'];
	$category = $_GET['category'];
	echo '<option value="" disabled selected>Line</option>';
	// FETCH ACCOUNT TYPE
	$qry = "SELECT accountType,carMaker FROM tblaccount WHERE idNumber = '$operatorID'";
	$query = $db->query($qry);
	if(mysqli_num_rows($query) > 0){
		while($x = $query->fetch_assoc()){
			$acc_type = $x['accountType'];
			$carmodel = $x['carMaker'];
			if($acc_type == 'Event Account'){
				// FETCH CARMODEL LINE FOR EVENT OPERATOR
				$fetchLine = "SELECT *FROM tblline WHERE category = '$category' ORDER BY lineNo ASC";
				$query = $db->query($fetchLine);
				while($x = $query->fetch_assoc()){
					echo '<option value="'.$x['carMaker']."-".$x['lineNo'].'">'.$x['carMaker']."-".$x['lineNo'].'</option>';
				}
			}
			// OPERATOR
			if($acc_type == 'Operator Account'){
				$fetchLine = "SELECT *FROM tblline WHERE carMaker = '$carmodel' AND category='$category' ORDER BY lineNo ASC";
				$query = $db->query($fetchLine);
				while($x = $query->fetch_assoc()){
					echo '<option value="'.$carmodel."-".$x['lineNo'].'">'.$carmodel."-".$x['lineNo'].'</option>';
				}
			}
		}
			
	}else{
		// INVALID ID
		echo 'no record';
	}
	
	// $operatorID = $_GET['operator'];
	// $category = $_GET['category'];
	// 
	// // FETCH THE OPERATORS CARMODEL
	// $qry = "SELECT carMaker FROM tblaccount WHERE idNumber = '$operatorID' AND accountType = 'Operator Account' LIMIT 1";
	// $query = $db->query($qry);
	// // IF HAS RESULTS
	// if(mysqli_num_rows($query) > 0){
	// 	while($x = $query->fetch_assoc()){
	// 	$carmodel = $x['carMaker'];
	// 	}
	// // FETCHING THE CARMODEL'S LINE
	// $fecthLine = "SELECT *FROM tblline WHERE carMaker ='$carmodel' AND category = '$category' ORDER BY lineNo ASC";
	// $query = $db->query($fecthLine);
	// while($x = $query->fetch_assoc()){
	// 	echo '<option value="'.$carmodel."-".$x['lineNo'].'">'.$carmodel."-".$x['lineNo'].'</option>';
	// 	}
	// }else{
	// 	// DO NOTHING
	// }	
}
// MACHINE NAME
elseif($method == 'loadmachinename'){
	$prodline = $_GET['categoryProd'];
	$department = $_GET['dept'];
	// QUERY
	$loadmachine = "SELECT machineName FROM tblmachinename WHERE category = '$prodline' AND department = '$department' ORDER BY machineName ASC";
	$query = $db->query($loadmachine);
	if(mysqli_num_rows($query) > 0){
		echo '<option value="" disabled selected>Machine name</option>';
		while($x = $query->fetch_assoc()){
			echo '<option value="'.$x['machineName'].'">'.$x['machineName'].'</option>';
		}
	}
}
// DETECT PROCESS
elseif($method == 'detectprocess'){
	$machine_name = $_GET['machine_name'];
	$dept = $_GET['dept'];
	$sql = "SELECT process FROM tblprocess WHERE machineName = '$machine_name' AND department = '$dept'";
	$query = $db->query($sql);
	if(mysqli_num_rows($query) > 0){
		echo '<option value="" disabled selected>Process</option>';
		while($x = $query->fetch_assoc()){
			echo '<option value="'.$x['process'].'">'.$x['process'].'</option>';
		}
	}else{
		echo 'noprocess';
	}
}

// DETECT MACHINE NUMBER
elseif($method == 'detectmachineno'){
	$machine = $_GET['machine_nym'];
	$dept = $_GET['dept'];
	$sql = "SELECT DISTINCT machineNo FROM tblmachineno WHERE machineName = '$machine' AND department = '$dept' ORDER BY listId ASC";
	$query = $db->query($sql);
	if(mysqli_num_rows($query) > 0){
		// echo '<option><input type="text" /></option>';
		echo '<option value="">Machine Number</option>';
		while($x = $query->fetch_assoc()){
			echo '<option value = "'.$x['machineNo'].'">'.$x['machineNo'].'</option>';
		}
	}else{
		echo 'nonumber';
	}
}

// PROBLEMS
elseif($method == 'loadproblems'){
	$machine = $_GET['machineName'];
	$department = $_GET['department'];
	$qry = "SELECT DISTINCT problem FROM tblproblem WHERE department = '$department' AND machineName = '$machine' ORDER BY problem ASC";
	$query = $db->query($qry);
	if(mysqli_num_rows($query) > 0){
		echo '<option value="">Encountered Problem</option>';
		while($x = $query->fetch_assoc()){
			echo '<option value="'.$x['problem'].'">'.$x['problem'].'</option>';
		}
	}else{
		// DO NOTHING
	}
}

// CHECK ID
elseif($method == 'verify_jr'){
	$andon_id = $_GET['andon_id'];
	$operator = $_GET['jr_staff_id'];
	$operator_name = $_GET['jr_staff_call'];
	// SELECT GET NAME
	$fetch_name = "SELECT firstName,lastName FROM tblaccount WHERE idNumber ='$operator'";
	$query = $db->query($fetch_name);
	if(mysqli_num_rows($query) > 0){
		while($x = $query->fetch_assoc()){
			echo $full = $x['firstName'].' '.$x['lastName'];
		}
	}else{
		echo 'invalid';
	}
}

$db->close();
?>