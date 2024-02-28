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

    // Check if a record with the same department, line, and machine already exists
    $checkQuery = "SELECT * FROM tblandonrequest WHERE `department` = '$department' AND `line` = '$line' AND `machineName` = '$machine' AND `problem` = '$problem'";
    $result = $db->query($checkQuery);

    if ($result) {
        if ($result->num_rows > 0) {
            echo 'Already Exist';
        } else {
            // Insert new record if no duplicate found
            $datenow = date('Y-m-d H:i:s');
            $qry = "INSERT INTO `tblandonrequest` (`listId`, `category`, `line`, `machineName`, `machineNo`, `process`, `problem`, `requestedId`, `operatorName`, `department`, `status`, `confirm_by`, `requestDateTime`, `ipPathReq`) VALUES ('', '$categ', '$line', '$machine', '$machineNumber', '$process', '$problem', '$scanID', '$operator', '$department', 'pending', '', '$datenow', '$ip')";

            if($db->query($qry)){
                echo 'success';
            } else {
                echo 'fail';
            }
        }
    } else {
        echo 'Query Error: ' . $db->error;
    }
}
?>

