<?php
include '../database/index.php';
if (isset($_POST['listId'])) {
    $listId = $_POST['listId'];
    $sql = "SELECT * FROM tblandonongoing WHERE listId = '$listId'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
         $line = $res['line'];
         $machineName = $res['machineName'];
         $process = $res['process'];
         $machineNo = $res['machineNo'];
         $problem = $res['problem'];
         $operatorName = $res['operatorName'];
         $requestDateTime = $res['requestDateTime'];
         $technicianId = $res['technicianId'];
         $technicianName = $res['technicianName'];
         $department = $res['department'];
         $category = $res['category'];
         $startDateTime = $res['startDateTime'];
         $requestedId = $res['requestedId'];
         $ipPathReq = $res['ipPathReq'];
         $ipPathTechAccept = $res['ipPathTechAccept'];
    }
?>
    <table class="table-sm">
        <tr>
            <td class="text-right" style="font-weight:bold;">Line :</td>
            <td class="text-left"><?=$line; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Machine Name :</td>
            <td class="text-left"><?=$machineName; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Process :</td>
            <td class="text-left"><?=$process; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Problem :</td>
            <td class="text-left"><?=$problem; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Machine No :</td>
            <td class="text-left"><?=$machineNo; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Concern Department :</td>
            <td class="text-left"><?=$department; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Requested By :</td>
            <td class="text-left"><?=$operatorName; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Date Time Reported :</td>
            <td class="text-left"><?=$requestDateTime; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Start Time :</td>
            <td class="text-left"><?=$startDateTime; ?></td>
        </tr>
        <tr>
            <td class="text-right" style="font-weight:bold;">Technician :</td>
            <td class="text-left"><?=$technicianName; ?></td>
        </tr>
    </table>
    <input type="password" class="doneFixing form-control z-depth-3" name="doneFixing" id="doneFixing" placeholder="Technician Account"  autocomplete="off">
    <?php
}
?>
<script>
 // Scan ID function
    $('.doneFixing').keyup(function(){
        let line = '<?= $line;?>';
        let machineName = '<?= $machineName;?>';
        let process = '<?= $process;?>';
        let machineNo = '<?= $machineNo;?>';
        let problem = '<?=$problem;?>';
        let department = '<?= $department;?>';
        let operatorName = '<?= $operatorName;?>';
        let requestDateTime = '<?= $requestDateTime?>';
        let scanId = $(this).val();
        // let listId = '<?= $listId;?>';
        let category = '<?= $category;?>';
        let requestedId = '<?= $requestedId;?>';
        let technicianId = '<?= $technicianId;?>';
         if(event.keyCode === 13){
            // console.log(scanId);
            event.preventDefault();
            if(technicianId.toLowerCase() === scanId.toLowerCase()){
                $('#doneFixing').modal('toggle'); 
                $('#doneFixingConfirm').modal('show');
                $.ajax({
                url:"ajax/ongoingRequestConfirm.php",
                type:"GET",
                cache:false,
                data:{listId:'<?= $listId;?>'},
                success:function(response){
                    $('.ongoingDetailsConfirm').html(response);
                }
           });
            }
            else
            {
                swal('Attention!','Invalid ID Number. Please try again.','info');
                return;
            }
        }
             
    });
</script>
