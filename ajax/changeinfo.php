<?php
    require '../database/index.php';
    $method = $_POST['method'];
    if($method == 'detect_process'){
        $machine = $_POST['machine'];
        $dept = $_POST['dept'];
        $q = "SELECT process FROM tblprocess WHERE machineName LIKE '$machine%' AND department = '$dept'";
        $stmt = $db->query($q);
        if(mysqli_num_rows($stmt) > 0){
            while($x = $stmt->fetch_assoc()){
                echo '<option value="'.$x['process'].'">'.$x['process'].'</option>';
            }
        }else{
            echo 'no_process';
        }

    }elseif($method == 'detect_machine_num'){
        $machine = $_POST['machine'];
        $dept = $_POST['dept'];
        $q = "SELECT DISTINCT machineNo FROM tblmachineno WHERE machineName LIKE '$machine%' AND department ='$dept'";
        $query = $db->query($q);
        if(mysqli_num_rows($query) > 0){
            while($x = $query->fetch_assoc()){
                echo '<option value = "'.$x['machineNo'].'">'.$x['machineNo'].'</option>';
            }
        }else{
            echo 'no_machine';
        }
    }elseif($method == 'detect_prob'){
        $machine = $_POST['machine'];
        $dept = $_POST['dept'];
        $q = "SELECT DISTINCT problem FROM tblproblem WHERE machineName = '$machine' AND department = '$dept'";
        $query = $db->query($q);
        if(mysqli_num_rows($query) > 0){
            while($x = $query->fetch_assoc()){
            echo '<option value = "'.$x['problem'].'">'.$x['problem'].'</option>';
            }
        }else{
            echo 'no_list';
        }
    
    }elseif($method == 'update_information'){
        $id = $_POST['updateID'];
        $machine = $_POST['n_machine'];
        $process = $_POST['n_process'];
        $machine_no = $_POST['n_machine_no'];
        $problem = $_POST['n_problem'];
        $sql = "UPDATE tblandonongoing SET machineName = '$machine', machineNo = '$machine_no',process = '$process', problem = '$problem' WHERE listId = '$id'";
        if($db->query($sql) === TRUE){
            echo 'updated';
        }else{
            echo 'failed';
        }
    }
?>