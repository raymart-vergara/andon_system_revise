<?php
include '../database/index.php';
if (isset($_POST['scanId'])) {
    $scanId = $_POST['scanId'];
    $result = array();
    $sql = "SELECT * from tblaccount where idNumber = '$scanId' AND accountType like 'Operator Account' limit 1 ";
    $query = $db->query($sql);
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        while($res= $query->fetch_assoc()){
            $result[] =  array("firstName"=>$res['firstName'], "lastName"=>$res['lastName'], "carMaker"=>$res['carMaker']); 
        }
        echo json_encode($result);
    }
}
if (isset($_POST['cancelScan'])) {
    $scanId = $_POST['cancelScan'];
    $result = array();
    $sql = "SELECT * from tblaccount where idNumber = '$scanId' AND accountType like 'Operator Account' limit 1 ";
    $query = $db->query($sql);
    $row = mysqli_num_rows($query);
    if ($row >0) {
        while($res= $query->fetch_assoc()){
            $result[] =  array("firstName"=>$res['firstName'], "lastName"=>$res['lastName'], "carMaker"=>$res['carMaker'] );
        }
        echo json_encode($result);
    }
}

// CLOSE THE CONNECTION
$db->close();
?>