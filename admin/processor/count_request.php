<?php
    require 'conn.php';
    $dept = $_POST['dept'];
    if($dept != 'IT'){
        // STOP TIME OUT
        echo 'stop';
    }else{
        $c = "SELECT COUNT(id) as count FROM qr_request";
        $stmt=$conn->prepare($c);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo $x['count'];
            }
        }else{
            echo '0';
        }
    }

?>