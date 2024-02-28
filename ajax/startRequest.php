<?php
include_once '../database/index.php';
if (isset($_POST['listId'])) {
    $listId = $_POST['listId'];
    $sql = "SELECT * FROM tblandonrequest WHERE listId like '$listId'";
    $query = $db->query($sql);
    // IF RECORD EXIST PROVIDE DATA -------------------------------------------------------------------------------------------------------
    if(mysqli_num_rows($query) > 0){
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
         $ipAddRequest = $res['ipPathReq'];   
      }
    ?>
    <table class="table-sm" style="font-size:12px;" cellpadding="0">
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
    </table>
    <input type="password" class="startId form-control z-depth-1" name="startId" id="startFixId" placeholder="Technician Account" autocomplete="off">
    <?php
    }
    // IF ANDON ALREADY ONGOING NOTIFY USER----------------------------------------------------------------------------------------------
    else{
        echo 'ALREADY ONGOING';
    }
} 
?>
<script>
 // START ANDON-----------------------------------------------------------------------------------------------------
    $('.startId').change(function(){
        let line = '<?=$line;?>';
        let machineName = '<?= $machineName;?>';
        let process = '<?= $process;?>';
        let machineNo = '<?= $machineNo;?>';
        let problem = '<?= $problem;?>';
        let department = '<?= $department;?>';
        let operatorName = '<?= $operatorName;?>';
        let requestDateTime = '<?= $requestDateTime?>';
        let scanId = $(this).val();
        let listId = '<?= $listId;?>';
        let category = '<?= $category;?>';
        let requestedId = '<?=$requestedId;?>';
        let ipPathReq = '<?=$ipAddRequest;?>';
            // DISABLE THE ENTER
            $('#startFixId').attr('disabled',true);
            $.ajax({
                type:"POST",
                url:"ajax/request.php",
                data: {
                    method:'startFix',
                    listId:listId,
                    line:line,
                    machineName:machineName,
                    process:process,
                    machineNo:machineNo,
                    problem:problem,
                    department:department,
                    operatorName:operatorName,
                    scanId:scanId,
                    category:category,
                    requestDateTime:requestDateTime,
                    requestedId:requestedId,
                    ipPathReq:ipPathReq
                },
                success:function(response){
                     // console.log(response);
                    if(response == 'Good'){
                        // location.reload();
                        $('#startFixing').modal('toggle');
                        swal('Accepted','Safety First. Please dont forget your tools.','success');
                        $('#startFixId').attr('disabled',false);
                    }else if(response == 'ongoing'){
                        swal('Warning','You have existing andon. Please end your existing Andon first.','info');
                         $('#startFixId').attr('disabled',false);
                    }else if(response == 'exist'){
                          swal('Warning','Already Ongoing.','info');
                    }
                    else{
                        swal('Notification!','Invalid ID Number. Please try again!','info');
                        $('#startFixId').attr('disabled',false);
                    }
                },
                error:function(){
                    swal('Something went wrong, please try again.')
                }
            });
    });

    // // CANCEL
    // $('#startBtn').click(function(){
    //     let line = '<?=$line;?>';
    //     let machineName = '<?= $machineName;?>';
    //     let process = '<?= $process;?>';
    //     let machineNo = '<?= $machineNo;?>';
    //     let problem = '<?=$problem;?>';
    //     let department = '<?= $problem;?>';
    //     let operatorName = '<?= $operatorName;?>';
    //     let requestDateTime = '<?= $requestDateTime?>';
    //     let scanId = $('#startId').val();
    //     let listId = '<?= $listId;?>';
    //     let category = '<?= $category;?>';
    //     let requestedId = '<?=$requestedId;?>';
    //     if (reason =='') {
    //         swal('Please complete the details.');
    //     }
    //     else
    //     {
    //         $.ajax({
    //             type:"POST",
    //             url:"ajax/request.php",
    //             data: {
    //                 method:'cancel_andon',
    //                 listId:listId,
    //                 line:line,
    //                 machineName:machineName,
    //                 process:process,
    //                 scanId:scanId,
    //                 machineNo:machineNo,
    //                 problem:problem,
    //                 department:department,
    //                 operatorName:operatorName,
    //                 category:category,
    //                 requestDateTime:requestDateTime,
    //                 requestedId:requestedId
    //             },
    //             success:function(response){
    //                 location.reload();
    //             },
    //             error:function(){
    //                 swal('Something went wrong, please try again.');
    //             }
    //         });
    //     }
    // });
</script>