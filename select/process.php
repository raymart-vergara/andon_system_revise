<?php
    require '../database/index.php';
    $department = $_POST['department'];
    $machineName = $_POST['machineName'];
    $sql = "SELECT * FROM tblprocess WHERE department = '$department' AND machineName like '%$machineName%' ";
    $query = $db->query($sql); 
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $sql1 = "SELECT * FROM tblMachineNo WHERE department = '$department' AND machineName like '%$machineName%' ORDER BY listId ASC";
        $query1 = $db->query($sql1); 
        $count1 = mysqli_num_rows($query1);
        if ($count1 > 0) {
            echo '<select class="select" id="process" >';
            echo '<option value="">Process</option>';                      
            while ($res = $query->fetch_assoc()) {
                echo '<option value="'.$res['process'].'">'.$res['process'].'</option>';
            }
            echo '</select>';
            echo '<select class="select" id="machineNo" >';
            echo '<option value="">Machine No.</option>';                      
            while ($res1 = $query1->fetch_assoc()) {
                echo '<option value="'.$res['machineNo'].'">'.$res['machineNo'].'</option>';
            }
            echo '</select>';
        }
        else{
            echo '<select class="select" id="process" >';
            echo '<option value="">Process</option>';                      
            while ($res = $query->fetch_assoc()) {
                echo '<option value="'.$res['process'].'">'.$res['process'].'</option>';
            }
            echo '</select>';
        }
    }
    else{
        $sql1 = "SELECT * FROM tblMachineNo WHERE department = '$department' AND machineName like '%$machineName%' order by listId ASC ";
        $query1 = $db->query($sql1); 
        $count1 = mysqli_num_rows($query1);
        if ($count1 > 0) {
            echo '<select class="select" id="machineNo" >';
            echo '<option value="">Machine No.</option>';                      
            while ($res1 = $query1->fetch_assoc()) {
                echo '<option value="'.$res1['machineNo'].'">'.$res1['machineNo'].'</option>';
            }
            echo '</select>';
        }
    }
    $sql2 = "SELECT * FROM tblproblem WHERE department = '$department' AND machineName like '%$machineName%' ";
    $query2 = $db->query($sql2); 
    echo '<select class="select" id="problem" >';
            echo '<option value="">Problem.</option>';                      
            while ($res2 = $query2->fetch_assoc()) {
                echo '<option value="'.$res2['problem'].'">'.$res2['problem'].'</option>';
            }
           echo '</select>';
?>
<script>
$('#process').change(function(){
    let department = $('#deptDiv').val();
    let machineName = $('#machineName').val();
});
$('#problem').change(function(){
    $('#btnSubmit').attr('disabled',false);
});
$('#process').selectize({
sortField: 'text'
});
$('#machineNo').selectize({
sortField: 'text'
});
$('#problem').selectize({
sortField: 'text'
});
</script>