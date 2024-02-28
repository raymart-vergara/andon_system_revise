<?php
include '../database/index.php';
$dept = $_POST['dept'];
$prod = $_POST['prod'];
    if(empty($dept) && empty($prod)){
         $sql = "SELECT listId, line, technicianName,category, department, startDateTime,operatorName, department,backupComment,machineName,machineNo,process, DATE_FORMAT(requestDateTime, '%Y-%m-%d') as dateRequest, DATE_FORMAT(requestDateTime, '%h:%i %p') as timeRequest  FROM tblandonongoing";
         $query = $db->query($sql);
         // LOOP DATA
         while ($res = $query->fetch_assoc()) {
            if($res['machineNo'] == 'N/A'){
                $res['machineNo'] = '';
            }
            if($res['process'] == 'N/A'){
                $res['process'] = '';
            }
        if($res['department'] == 'IT'){
            echo "<tr style='cursor:pointer;color:white;background-color:#4d6dff;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // EQD INITIAL
        elseif($res['department'] == 'EQD' && $res['category'] == 'Initial'){
            echo "<tr style='cursor:pointer;color:white;background-color:#2cf216;color:black;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // if entry department is from EQD FINAL
        elseif($res['department'] == 'EQD' && $res['category'] == 'Final'){
            echo "<tr style='cursor:pointer;color:white;background-color:#0b9e1f;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // PE INITIAL
        elseif($res['department'] == 'PE' && $res['category'] == 'Initial'){
            echo "<tr style='cursor:pointer;color:white;background-color:red;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // PE FINAL
        elseif($res['department'] == 'PE' && $res['category'] == 'Final'){
            echo "<tr style='cursor:pointer;color:white;background-color:#fa5007;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // default for system fault or error to view records forcely
        else{
            echo "<tr style='cursor:pointer;color:white;background-color:green;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
    }
}
//  filter using dept only
elseif(empty($prod) && !empty($dept)){
    $sql = "SELECT listId, line,category, technicianName, department, startDateTime,operatorName,department,backupComment,machineName,machineNo,process, DATE_FORMAT(requestDateTime, '%Y-%m-%d') as dateRequest, DATE_FORMAT(requestDateTime, '%h:%i %p') as timeRequest  FROM tblandonongoing WHERE department ='$dept'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
        if($res['machineNo'] == 'N/A'){
            $res['machineNo'] = '';
        }
        if($res['process'] == 'N/A'){
            $res['process'] = '';
        }
        if($res['department'] == 'IT'){
            echo "<tr style='cursor:pointer;color:white;background-color:#4d6dff;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
           
            echo "</tr>";
        }
        // eqd initial
        elseif($res['department'] == 'EQD' && $res['category'] == 'Initial'){
            echo "<tr style='cursor:pointer;color:white;background-color:#2cf216;color:black;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // if entry department is from EQD
        elseif($res['department'] == 'EQD' && $res['category'] == 'Final'){
            echo "<tr style='cursor:pointer;color:white;background-color:#0b9e1f;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // pe initial
        elseif($res['department'] == 'PE' && $res['category'] == 'Initial'){
            echo "<tr style='cursor:pointer;color:white;background-color:red;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // pe final
        elseif($res['department'] == 'PE' && $res['category'] == 'Final'){
            echo "<tr style='cursor:pointer;color:white;background-color:#fa5007;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // default for system fault or error to view records forcely
        else{
            echo "<tr style='cursor:pointer;color:white;background-color:green;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
    }
}
// filter using prod only
elseif(!empty($prod) && empty($dept)){
    $sql = "SELECT listId, line,category, technicianName, department, startDateTime,operatorName,department,backupComment,machineName,machineNo,process, DATE_FORMAT(requestDateTime, '%Y-%m-%d') as dateRequest, DATE_FORMAT(requestDateTime, '%h:%i %p') as timeRequest  FROM tblandonongoing WHERE category ='$prod'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
        if($res['machineNo'] == 'N/A'){
            $res['machineNo'] = '';
        }
        if($res['process'] == 'N/A'){
            $res['process'] = '';
        }
        if($res['department'] == 'IT'){
            echo "<tr style='cursor:pointer;color:white;background-color:#4d6dff;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
           
            echo "</tr>";
        }
        // eqd initial
        elseif($res['department'] == 'EQD' && $res['category'] == 'Initial'){
            echo "<tr style='cursor:pointer;color:white;background-color:#2cf216;color:black;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // if entry department is from EQD final
        elseif($res['department'] == 'EQD' && $res['category'] == 'Final'){
            echo "<tr style='cursor:pointer;color:white;background-color:#0b9e1f;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // ?pe initial
        elseif($res['department'] == 'PE' && $res['category'] == 'Initial'){
            echo "<tr style='cursor:pointer;color:white;background-color:red;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // pe final
        elseif($res['department'] == 'PE' && $res['category'] == 'Final'){
            echo "<tr style='cursor:pointer;color:white;background-color:#fa5007;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // default for system fault or error to view records forcely
        else{
            echo "<tr style='cursor:pointer;color:white;background-color:green;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
    }
}
else{
    $sql = "SELECT listId, line,category, technicianName, department, startDateTime,operatorName,department,backupComment,machineName,machineNo,process, DATE_FORMAT(requestDateTime, '%Y-%m-%d') as dateRequest, DATE_FORMAT(requestDateTime, '%h:%i %p') as timeRequest  FROM tblandonongoing WHERE department ='$dept' AND category = '$prod'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
        if($res['machineNo'] == 'N/A'){
            $res['machineNo'] = '';
        }
        if($res['process'] == 'N/A'){
            $res['process'] = '';
        }
        if($res['department'] == 'IT'){
            echo "<tr style='cursor:pointer;color:white;background-color:#4d6dff;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
           
            echo "</tr>";
        }
        // eqd initial
        elseif($res['department'] == 'EQD' && $res['category'] == 'Initial'){
            echo "<tr style='cursor:pointer;color:white;background-color:#2cf216;color:black;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // if entry department is from EQD FInal
        elseif($res['department'] == 'EQD' && $res['category'] == 'Final'){
            echo "<tr style='cursor:pointer;color:white;background-color:#0b9e1f;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // pe initial
        elseif($res['department'] == 'PE' && $res['category']== 'Initial'){
            echo "<tr style='cursor:pointer;color:white;background-color:red;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // pe final
        elseif($res['department'] == 'PE' && $res['category']== 'Final'){
            echo "<tr style='cursor:pointer;color:white;background-color:#fa5007;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
        // default for system fault or error to view records forcely
        else{
            echo "<tr style='cursor:pointer;color:white;background-color:green;' onclick='clickOngoing(&quot;".$res['listId']."&quot;)'> data-toggle='modal'data-target='#basicExampleModal'> ";
            echo "<td>".$res['line']."/".$res['machineName']." ".$res['machineNo']."/".$res['process']."</td>";
            echo "<td>".$res['technicianName']."</td>";
            echo "<td>".$res['department']."</td>";
            echo "<td>".$res['startDateTime']."</td>";
            echo "<td>".$res['operatorName']."</td>";
            echo "<td>".$res['backupComment']."</td>";
            echo "</tr>";
        }
    }
}
?>
