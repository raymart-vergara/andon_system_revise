<?php
include '../database/index.php';
if(isset($_POST['listId'])){
  $recordID = $_POST['listId'];
  $sql = "SELECT *FROM tblandonongoing WHERE listId = '$recordID'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
         $line = $res['line'];
         $machineName = $res['machineName'];
         $process = $res['process'];
         $machineNo = $res['machineNo'];
         $problem = $res['problem'];
         $operatorName = $res['operatorName'];
         $requestDateTime = $res['requestDateTime'];
         $requestedId = $res['requestedId'];
         $department = $res['department'];
         $category = $res['category'];
         $startTime= $res['startDateTime'];
         $technician = $res['technicianName'];
         $technicianID = $res['technicianId'];
         $backupRequestTime = $res['backupRequestTime'];
         $comment = $res['backupComment'];
}
}
?>
          <!-- content -->
        <table style="text-align: left;">
          <!-- line -->
          <tr>
            <td>Line:</td>
            <td><?=$line;?></td>
          </tr>
          <!-- machine name -->
          <tr>
            <td>Machine Name:</td>
            <td><?=$machineName;?></td>
          </tr>
          <!-- Process -->
          <tr>
            <td>Process:</td>
            <td><?=$process;?></td>
          </tr>
          <!-- Machine No -->
          <tr>
            <td>Machine No.</td>
            <td><?=$machineNo;?></td>
          </tr>
          <tr>
            <td>Problem:</td>
            <td><?=$problem;?></td>
          </tr>
          <!-- Requested by -->
          <tr>
            <td>Requested by:</td>
            <td><?=$operatorName;?></td>
          </tr>
          <!-- time reported -->
          <tr>
            <td>Date Time Reported:</td>
            <td><?=$requestDateTime;?></td>
          </tr>
          <!-- start time fixing -->
          <tr>
            <td>Start Fixing Time:</td>
            <td><?=$startTime;?></td>
          </tr>
          <!-- technician -->
          <tr>
            <td>Technician:</td>
            <td><?=$technician;?></td>
          </tr>
          <!-- dept -->
          <tr>
            <td>Department:</td>
            <td><?=$department;?></td>
          </tr>
        </table>
        <hr>
        <!-- id -->
        <input type="hidden" name="" id="recID" value="<?=$recordID;?>" >
        <input type="hidden" name="" id="techID" value="<?=$technicianID;?>" >
      <?php
        if($backupRequestTime === '0000-00-00 00:00:00' && $comment == ''){
          echo '<div class="md-form">
                  <input type="text" id="form_remind" class="md-textarea form-control" rows="3" autocomplete="off"  oninput="validate()">
              </div>';
          echo ' <div>
                 <label for="passwordBackup">Scan your ID to call backup</label>
                  <input type="password" id="passwordBackup" class="form-control z-depth-3" placeholder="Scan your ID" onchange="backupEnter()">
                </div>';
        }else{
          echo "You already have sent a request to backup.";
        }
      ?>