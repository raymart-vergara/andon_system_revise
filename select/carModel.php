<?php
    require '../database/index.php';
    $carMaker = $_POST['carMaker'];
    $category = $_POST['category'];
    $sql = "SELECT * FROM tblline WHERE carMaker like '%$carMaker%' AND category like '%$category%' ";
    $query = $db->query($sql);
    echo '<select class="selectCarModel" id="carModel" >';
    echo '<option value="">Car Model / Line</option>';
    while ($res = $query->fetch_assoc()){
            echo '<option value="'.$res['lineNo'].'">'.$carMaker.' '.$res['lineNo'].'</option>';
    }
    echo '</select>';
    echo '<input type="hidden" id="carMaker" value="'.$carMaker.'">';
?>
<script>
    $('#carModel').change(function(){
        let department = $('#deptDiv').val();
        let category = $('#category').val();
        $('.machineName').load('select/machineName.php',{iChange:'machineName',department:department,category:category});
    });
    $('#carModel').selectize({
        sortField: 'text'
    });
</script>












