<?php
require '../database/index.php';
$method = $_POST['method'];
if ($method == 'access_report') {
    $ip = $_SERVER['REMOTE_ADDR'];
    $pc_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);

    // CHECK IP IF LISTED
    $checkQry = "SELECT ip_address FROM access_report WHERE ip_address = '$ip'";
    $stmt = $db->query($checkQry);
    $count = mysqli_num_rows($stmt);
    if ($count >= 1) {
        // UPDATE ACCESS DATE
        $updateQry = "UPDATE access_report SET last_access_date = '$datenow' WHERE ip_address = '$ip'";
        $stmt = $db->query($updateQry);
    } else {
        $insertQry = "INSERT INTO access_report (`ip_address`,`pc_name`,`last_access_date`) VALUES ('$ip','$pc_name','$datenow')";
        $stmt = $db->query($insertQry);
    }
}


?>