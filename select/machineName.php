<?php
    require '../database/index.php';
    $department = $_POST['department'];
    $category = $_POST['category'];
    $sql = "SELECT * FROM tblmachinename WHERE department like '$department' AND category like '$category' ";
    $query = $db->query($sql);
    echo '<select class="selectMachineName" id="machineName" >';
    echo '<option value="">Machine Name</option>';                  
    while ($res = $query->fetch_assoc()) {
        echo '<option value="'.$res['machineName'].'">'.$res['machineName'].'</option>';
    }
    echo '</select>';
?>
<script>
$('#machineName').change(function(){
    let department = $('#deptDiv').val();
    let machineName = $('#machineName').val();
    $('.process').load('select/process.php',{iChange:'machineName',department:department,machineName:machineName});
    // $('#btnSubmit').attr('disabled',false);
});
$('#machineName').selectize({
sortField: 'text'
});
</script>