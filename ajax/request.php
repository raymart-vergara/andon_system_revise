<?php
require '../database/index.php';
date_default_timezone_set('Asia/Manila');
$method = $_POST['method'];
// CANCEL ANDON -----------------------------------------------------------------------------------------------------------
if ($method == 'cancel_andon') {
    echo $listId = $_POST['listId'];
    $line = $_POST['line'];
    $machineName = $_POST['machineName'];
    $process = $_POST['process'];
    $machineNo = $_POST['machineNo'];
    $problem = $_POST['problem'];
    $department = $_POST['department'];
    $operatorName = $_POST['operatorName'];
    $reason = $_POST['reason'];
    $jigLocation= $_POST['jigLocation'];
    $jigName = $_POST['jigName'];
    $lineStatus = $_POST['lineStatus'];
    $category = $_POST['category'];
    $requestedId = $_POST['requestedId'];
    $requestDateTime = $_POST['requestDateTime'];
    $ip = $_POST['ipAddReq'];
    $sql = "INSERT INTO `tblandoncancelrequest`(`listId`, `category`, `line`, `machineName`, `machineNo`, `process`, `problem`,`jigLocation`,`jigName`,`lineStatus`, `requestedId`, `operatorName`, `department`, `status`, `requestDateTime`, `reason`, `cancelDateTime`,`ipPathReq`) VALUES ('','$category','$line','$machineName','$machineNo','$process','$problem','$jigLocation','$jigName','$lineStatus','$requestedId','$operatorName','$department','Cancel','$requestDateTime','$reason','$datenow','$ip')";
    $query = $db->query($sql);
    $delete = "DELETE FROM tblandonrequest where listId = '$listId'";
    $deleteQ = $db->query($delete);
    echo 'deleted';
}
// STARTFIX -------------------------------------------------------------------------------------------------------------------
if ($method == 'startFix') {
    $listId = $_POST['listId'];
    $line = $_POST['line'];
    $machineName = $_POST['machineName'];
    $process = $_POST['process'];
    $machineNo = $_POST['machineNo'];
    $problem = $_POST['problem'];
    $jigLocation= $_POST['jigLocation'];
    $jigName = $_POST['jigName'];
    $lineStatus = $_POST['lineStatus'];
    $department = $_POST['department'];
    $operatorName = $_POST['operatorName'];
    $category = $_POST['category'];
    $requestedId = $_POST['requestedId'];
    $requestDateTime = $_POST['requestDateTime'];
    $scanId = trim($_POST['scanId']);
    $ipPathReq = $_POST['ipPathReq'];
    $ipPathAccept = $_SERVER['REMOTE_ADDR'];
    //CHECK USER IF EXIST AS TECHNICIAN ------------------------------------------------------------------------------------------
    $checkUser = "SELECT firstName, lastName, carMaker from tblaccount where idNumber  = '$scanId' and accountType LIKE 'Admin Account%' AND carMaker LIKE '$department%'";
    $checkQuery = $db->query($checkUser);
    $count = mysqli_num_rows($checkQuery);
    // FETCH TECHNICIAN -----------------------------------------------------------------------------------------------------------
    if ($count > 0) {
        while ($res = $checkQuery->fetch_assoc()) {
            $fullName = $res['firstName'] . " " . $res['lastName'];
        }
        // CHECK USER IF HAS ANDON ONGOING ---------------------------------------------------------------------------------------------
        $sqlCheck = "SELECT technicianId FROM tblandonongoing WHERE technicianId ='$scanId'";
        $check = $db->query($sqlCheck);
        if (mysqli_num_rows($check) > 0) {
            echo 'ongoing';
        } else {
            // IF NO ONGOING ANDON INSERT TO DATABASE--------------------------------------------------------------------------------------
            $sql = "INSERT INTO `tblandonongoing`(`listId`, `requestedId`, `category`, `line`, `machineName`, `machineNo`, `process`, `problem`,`jigLocation`,`jigName`,`lineStatus`, `operatorName`, `department`, `technicianId`, `technicianName`, `backupTechnicianId`, `backupTechnicianName`, `backupComment`, `backupRequestTime`,`backupAccept`, `status`, `requestDateTime`, `startDateTime`,`ipPathReq`,`ipPathTechAccept`) VALUES ('0','$listId','$category','$line','$machineName','$machineNo','$process','$problem','$jigLocation','$jigName','$lineStatus','$operatorName','$department','$scanId','$fullName','','','','','','Ongoing','$requestDateTime','$datenow','$ipPathReq','$ipPathAccept')";
            $query = $db->query($sql);
            $delete = "DELETE FROM tblandonrequest where listId = '$listId'";
            $deleteQ = $db->query($delete);
            echo "Good";
        }
    } else {
        echo "wrong";
    }

}
$db->close();
?>