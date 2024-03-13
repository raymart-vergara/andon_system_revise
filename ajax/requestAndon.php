<?php
	// require '../database/index.php';
	// date_default_timezone_set('Asia/Manila');
	// // $datenow =  date('Y-m-d H:i:s');
	// $method = $_POST['method'];
	// if($method == 'requestAndon'){
	// 	$categ = $_POST['category'];
	// 	$department = $_POST['department'];
	// 	$operator = $_POST['operator'];
	// 	$line = $_POST['line'];
	// 	$machine = $_POST['machine'];
	// 	$process = $_POST['processTxt'];
	// 	$machineNumber = $_POST['machineNumber'];
	// 	$problem = $_POST['problem'];
	// 	$ip = $_SERVER['REMOTE_ADDR'];
	// 	$scanID = $_POST['scanID'];
	// 	$qry = "INSERT INTO `tblandonrequest` (`listId`,`category`,`line`,`machineName`,`machineNo`,`process`,`problem`,`requestedId`,`operatorName`,`department`,`status`,`confirm_by`,`requestDateTime`,`ipPathReq`) VALUES ('','$categ','$line','$machine','$machineNumber','$process','$problem','$scanID','$operator','$department','pending','','$datenow','$ip')";
	// 	if($query = $db->query($qry)){
	// 		echo 'success';
	// 	}else{
	// 		echo 'fail';
	// 	}
	// }

?>
<?php
require '../database/index.php';
date_default_timezone_set('Asia/Manila');

$method = $_POST['method'];

if($method == 'requestAndon') {
    $categ = $_POST['category'];
    $department = $_POST['department'];
    $operator = $_POST['operator'];
    $line = $_POST['line'];
    $machine = $_POST['machine'];
    $process = $_POST['processTxt'];
    $machineNumber = $_POST['machineNumber'];
    $problem = $_POST['problem'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $scanID = $_POST['scanID'];
    $jigLocation = $_POST['jigLocation'];
    $jigName = $_POST['jigName'];
    $lineStatus = $_POST['lineStatus'];

    // Check if a record with the same department, line, and machine already exists in  STATUS = pending
    $checkQuery = "SELECT * FROM tblandonrequest WHERE `department` = '$department' AND `line` = '$line' AND `machineName` = '$machine' AND  `machineNo` = '$machineNumber'";
    $result = $db->query($checkQuery);
	  // Check if a record with the same department, line, and machine already exists in  STATUS = ongoing
	$checkOngoing = "SELECT * FROM tblandonongoing WHERE `department` = '$department' AND `line` = '$line' AND `machineName` = '$machine'";
    $resultOngoing = $db->query($checkOngoing);

    if ($result || $resultOngoing) {
        if ($result->num_rows > 0 || $resultOngoing->num_rows > 0) {
            echo 'Already Exist';
        } else {
            // Insert new record if no duplicate found
            $datenow = date('Y-m-d H:i:s');
            $qry = "INSERT INTO `tblandonrequest` (`listId`, `category`, `line`, `machineName`, `machineNo`, `process`, `problem`, `jigLocation`,`jigName`,`lineStatus`,`requestedId`, `operatorName`, `department`, `status`, `confirm_by`, `requestDateTime`, `ipPathReq`) VALUES ('', '$categ', '$line', '$machine', '$machineNumber', '$process', '$problem','$jigLocation','$jigName','$lineStatus', '$scanID', '$operator', '$department', 'pending', '', '$datenow', '$ip')";
            if($db->query($qry)){
                echo 'success';
            } else {
                echo 'Query Error: ' . $db->error;
            }
        }
    } else {
        echo 'Query Error: ' . $db->error;
    }
}
?>

