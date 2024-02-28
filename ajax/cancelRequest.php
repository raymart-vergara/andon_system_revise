<?php

include '../database/index.php';
if (isset($_POST['listId'])) {
    $listId = $_POST['listId'];
    $sql = "SELECT * FROM tblandonrequest WHERE listId = '$listId'";
    $query = $db->query($sql);
    while ($res = $query->fetch_assoc()) {
         $line = $res['line'];
         $machineName = $res['machineName'];
         $process = $res['process'];
         $machineNo = $res['machineNo'];
         $problem = trim($res['problem']);
         $operatorName = $res['operatorName'];
         $requestDateTime = $res['requestDateTime'];
         $requestedId = $res['requestedId'];
         $department = $res['department'];
         $category = $res['category'];
         $ipAddReq = $res['ipPathReq'];
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
    </table>
    <input type="password" class="form-control" name="scanId" id="cancelScanID" placeholder="SCAN STAFF/JR. STAFF ID"  autocomplete="off">
    <input type="text" class="form-control mt-2" name="reason" id="reason" placeholder="REASON" required autocomplete="off" disabled >
    <?php
}
?>
<script>
 // ScanCancel ID function
    $('#cancelScanID').keyup(function(){
        var scanId = $(this).val();
        var requestedId = '<?php echo $requestedId;?>';
        if (event.keyCode === 13){
        // console.log(requestedId);
            event.preventDefault();
            if(scanId == requestedId) {
                $('#reason').attr('disabled',false);
                $('#reason').focus();
                $('#cancelBtn').attr('disabled',false);
            }
            else{
               swal('Notification','Invalid ID Number! Please try again.','info');
            }
        }
    });

    $('#cancelBtn').click(function(){
        let line = '<?php echo $line;?>';
        let machineName = '<?= $machineName;?>';
        let process = '<?= $process;?>';
        let machineNo = '<?= $machineNo;?>';
        let problem = '<?= $problem;?>';
        let department = '<?= $department;?>';
        let operatorName = '<?= $operatorName;?>';
        let requestDateTime = '<?= $requestDateTime?>';
        let scanId = $('#cancelScanID').val();
        let reason = $('#reason').val();
        let listId = '<?= $listId;?>';
        let category = '<?= $category;?>';
        let requestedId = '<?php echo $requestedId;?>';
        let ipAddReq = '<?=$ipAddReq?>';
        if (reason =='') {
             swal({
                title:"Warning",
                text:"Please complete the details",
            });
        }
        else
        {
            $.ajax({
                type:"POST",
                url:"ajax/request.php",
                data: {
                    method:'cancel_andon',
                    listId:listId,
                    line:line,
                    machineName:machineName,
                    process:process,
                    machineNo:machineNo,
                    problem:problem,
                    department:department,
                    operatorName:operatorName,
                    reason:reason,
                    category:category,
                    requestDateTime:requestDateTime,
                    requestedId:requestedId,
                    ipAddReq:ipAddReq
                },
                success:function(response){
                    swal('Andon Cancellation Succeeded');
                    // .then((value) =>{
                    //     location.reload();
                    // });
                    $('#cancelConfirm').modal('toggle');
                    requestView();
                },
                error:function(){
                    swal('Something is wrong. Please press F5 and try again.');
                }
           });
        }

    });
</script>
