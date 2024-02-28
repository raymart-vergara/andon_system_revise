<style>
  .custom-select{
    border-radius:20px;
  }
</style>
<?php
include '../database/index.php';
if (isset($_POST['listIDforChange'])) {
    $listId = $_POST['listIDforChange'];
    $update = "UPDATE tblandonongoing set endDateTime = '$datenow' WHERE listId = '$listId' limit 1 ";
    $updateQuery = $db->query($update);
    $sql = "SELECT * FROM tblandonongoing WHERE listId like '$listId%'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
         $line = $res['line'];
         $machineName = $res['machineName'];
         $process = $res['process'];
         $machineNo = $res['machineNo'];
         $problem = $res['problem'];
         $department = $res['department'];
         $category = $res['category'];
    }
?>  
    <input type="hidden" value="<?=$listId?>" id="id_update">
    <table class="col-12" style="padding:10px;" cellpadding="10px">
        <tr>
            <td>Machine Name:</td>
            <td>
                <select class="machineName custom-select browser-default z-depth-3" id="machineName_update" style="width:100%;" onchange="detect_process()">
                    <option value="<?=$machineName;?>" style="font-weight:bold;"><?=$machineName;?></option>  
                        <?php
                        $sql1 = "SELECT * FROM tblmachinename WHERE department like '$department%' AND category like '$category%'";
                        $query1 = $db->query($sql1);           
                        while ($res1 = $query1->fetch_assoc()) {
                            echo '<option value="'.$res1['machineName'].'">'.$res1['machineName'].'</option>';
                        }
                        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Process:</td>
            <td>
                <select class="custom-select browser-default z-depth-3" id="process_change"  style="width:100%;" >
                    <option value="<?= $process;?>" style="font-weight:bold;"><?= $process;?></option>
                    <?php
                      $process = "SELECT DISTINCT process FROM tblprocess WHERE department = '$department' AND machineName ='$machineName' ORDER BY process ASC";
                      $query = $db->query($process);
                      if(mysqli_num_rows($query) > 0){
                        while($x = mysqli_fetch_assoc($query)){
                          echo '<option>'.$x['process'].'</option>';
                        }
                      }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Machine#:</td>
            <td>
                <select class="custom-select browser-default z-depth-3" id="machine_num_change"  style="width:100%;" >
                    <option value="<?= $machineNo;?>" style="font-weight:bold;"><?= $machineNo;?></option>
                    <?php
                      $process = "SELECT DISTINCT machineNo FROM tblmachineno WHERE department = '$department' AND machineName ='$machineName' ORDER BY listId ASC";
                      $query = $db->query($process);
                      if(mysqli_num_rows($query) > 0){
                        while($x = mysqli_fetch_assoc($query)){
                          echo '<option>'.$x['machineNo'].'</option>';
                        }
                      }
                    ?> 
                </select>
            </td>
        </tr>
        <tr>
            <td>Problem:</td>
            <td>
                <select class="custom-select browser-default z-depth-3" id="problem_change"  style="width:100%;" >
                    <option value="<?= $problem;?>" style="font-weight:bold;"><?= $problem;?></option>
                    <?php
                      $process = "SELECT DISTINCT problem FROM tblproblem WHERE department = '$department' AND machineName ='$machineName' ORDER BY problem ASC";
                      $query = $db->query($process);
                      if(mysqli_num_rows($query) > 0){
                        while($x = mysqli_fetch_assoc($query)){
                          echo '<option>'.$x['problem'].'</option>';
                        }
                      }
                    ?>
                </select>
            </td>
        </tr>
    </table>

<?php
}
?>
<script>
const detect_process =()=>{
    machine = $('#machineName_update').val();
    dept = '<?=$department;?>';
    $.ajax({
      url:'ajax/changeinfo.php',
      type:'POST',
      cache: false,
      data:{
        method: 'detect_process',
        machine:machine,
        dept:dept
      },success:function(response){
        if(response == 'no_process'){
          $('#process_change').attr('disabled',true);
          $('#process_change').html('<option value="N/A">N/A</option>');
          detect_machine_num();
        }else{
          $('#process_change').attr('disabled',false);
          $('#process_change').html(response);
          $('#machine_num_change').attr('disabled',true);
          $('#machine_num_change').html('<option value="N/A">N/A</option>');
        }
      }
    });
  }
const detect_machine_num =()=>{
    machine = $('#machineName_update').val();
    dept = '<?=$department;?>';
    $.ajax({
      url: 'ajax/changeinfo.php',
      type: 'POST',
      cache: false,
      data:{
        method: 'detect_machine_num',
        machine:machine,
        dept:dept
      },success:function(response){
        // console.log(response);
        if(response == 'no_machine'){
          $('#machine_num_change').attr('disabled',true);
          $('#machine_num_change').html('<option value="N/A">N/A</option>');
        }else{
          $('#machine_num_change').attr('disabled',false);
          $('#machine_num_change').html(response);
        }
      }
    });
  }

$('#machineName_update').change(function(){
    var machine = $(this).val();
    var dept = '<?=$department;?>';
    $.ajax({
        url: 'ajax/changeinfo.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'detect_prob',
            machine:machine,
            dept:dept
        },success:function(response){
            // console.log(response);
            $('#problem_change').html(response);
        }
    });
});
</script>
  
