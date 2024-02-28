<?php
    include 'conn.php';
    $method = $_POST['method'];
    if($method == 'request'){
        $id = 0;
        $operatorID = trim($_POST['operator_id']);
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $car_model = trim($_POST['car_model']);
        $category = trim($_POST['categ']);
        $type = trim($_POST['type']);
        $ip = $_SERVER['REMOTE_ADDR'];
        // CHECK REQUEST TO AVOID DOUBLE REQUEST
        $sql = "SELECT id_number FROM qr_request WHERE id_number = '$operatorID'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->fetchALL();
        if($stmt->rowCount() > 0){
            echo 'exist';
        }else{
            $insert = "INSERT INTO qr_request (`id`,`id_number`,`fname`,`lname`,`car_model`,`process_categ`,`account_type`,`ip`)
            VALUES ('$id','$operatorID','$fname','$lname','$car_model','$category','$type','$ip')";
            $stmt = $conn->prepare($insert);
            if($stmt->execute()){
                echo 'save';
            }else{
                echo 'fail';
            }

        }
    }elseif($method == 'view_request'){
        $qry = 'SELECT *FROM qr_request';
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        foreach($stmt->fetchALL() as $x){
            echo '<tr class="modal-trigger" data-target="modalMenuQR" onclick="get_req_qr_id(&quot;'.$x['id'].'&quot;)" style="cursor:pointer;">';
            echo '<td>'.$x['id_number'].'</td>';
            echo '<td>'.$x['fname'].'</td>';
            echo '<td>'.$x['lname'].'</td>';
            echo '<td>'.$x['car_model'].'</td>';
            echo '<td>'.$x['process_categ'].'</td>';
            echo '<td>'.$x['account_type'].'</td>';
            echo '<td>'.$x['ip'].'</td>';
            echo '</tr>';
        }
}  elseif($method == 'approve'){
    $qrID = $_POST['qrID'];
    // GET VALUES
    $get = "SELECT *FROM qr_request WHERE id = '$qrID' LIMIT 1";
    $stmt = $conn->prepare($get);
    $stmt->execute();
    foreach($stmt->fetchALL() as $x){
        $id_pass = $x['id_number'];
        $fname = $x['fname'];
        $lname = $x['lname'];
        $car = $x['car_model'];
        $process = $x['process_categ'];
        $accountType = $x['account_type'];
    }
    // CHECK USER
    $chk = "SELECT *FROM tblaccount WHERE idNumber = '$id_pass'";
    $stmt = $conn->prepare($chk);
    $stmt->execute();
    $stmt->fetchALL();
    if($stmt->rowCount() > 0){
        echo 'denied';
    }else{
        $insert =  "INSERT INTO tblaccount (`listId`,`idNumber`,`firstName`,`lastName`,`carMaker`,`category`,`accountType`) 
        VALUES ('','$id_pass','$fname','$lname','$car','$process','$accountType')";
        $stmt = $conn->prepare($insert);
        if($stmt->execute()){
            $del = "DELETE FROM qr_request WHERE id = '$qrID'";
            $stmt = $conn->prepare($del);
            $stmt->execute();
            echo 'save';
        }else{
            echo 'fail';
        }
    }
}elseif($method == 'decline'){
    $id = $_POST['id_decline'];
    $sql = "DELETE FROM qr_request WHERE id = '$id'";
    $stmt=$conn->prepare($sql);
    if($stmt->execute()){
        echo 'success';
    }else{
        echo 'fail';
    }
}
?>