<?php
include '../database/index.php';
if (isset($_GET['listId'])) {
    $listId = $_GET['listId'];
    $update = "UPDATE tblandonongoing SET endDateTime = '$datenow' WHERE listId = '$listId'";
    $updateQuery = $db->query($update);
    $sql = "SELECT *, TIMEDIFF(endDateTime,startDateTime) as intervalTime , TIMEDIFF(startDateTime,requestDateTime) as waitingTime  FROM tblandonongoing WHERE listId = '$listId'";
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
        $endDateTime = $res['endDateTime'];
        $interval = $res['intervalTime'];
        $waitingTime = $res['waitingTime'];
        $ipPathReq = $res['ipPathReq'];
        $ipPathTechAccept = $res['ipPathTechAccept'];
        $backupTechID = $res['backupTechnicianId'];
        $backupTechName = $res['backupTechnicianName'];
        $backupComment = $res['backupComment'];
        $backupRequestTime = $res['backupRequestTime'];
        $backupAccept = $res['backupAccept'];
    }
    $arrayLabel = array("Waiting Time","Repair Time");
    function minutes($time){
        $time = explode(':', $time);
        $result = ($time[0]*60) + ($time[1]) + ($time[2]/60);
        return round($result,2);
    }
    $intervalMinutes = minutes($interval);
    $waitingTimeMinutes = minutes($waitingTime);
    $arrayValue = array($waitingTimeMinutes,$intervalMinutes);

     $option = explode(':',$problem);
        $trd_concern = $option[0];
    ?>
<div class="row">
    <div class="col-sm-6">
        <table class="left">
            <tr>
                <td class="text-right" style="font-size:12px;">Line :</td>
                <td class="text-left" style="font-size:12px;font-weight: bold;"><?=$line; ?></td>
            </tr>
            <tr>
                <td class="text-right" style="font-size:12px;">Machine Name :</td>
                <td id="machineNameTD" class="text-left" style="font-size:12px;font-weight: bold;"><?=$machineName; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;"style="font-size:12px;">Process :</td>
                <td class="text-left" style="font-size:12px;font-weight: bold;"><?=$process; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;"style="font-size:12px;">Problem :</td>
                <td class="text-left" style="font-size:12px;font-weight: bold;"><?=$problem; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;"style="font-size:12px;">Machine No :</td>
                <td class="text-left" style="font-size:12px;font-weight: bold;"><?=$machineNo; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;">Concern Department :</td>
                <td class="text-left"style="font-size:12px;font-weight: bold;"><?=$department; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;">Requested By :</td>
                <td class="text-left"style="font-size:12px;font-weight: bold;"><?=$operatorName; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;">Date Time Reported :</td>
                <td class="text-left"style="font-size:12px;font-weight: bold;"><?=$requestDateTime; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;">Start Time:</td>
                <td class="text-left"style="font-size:12px;font-weight: bold;"><?=$startDateTime;?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;">End Time :</td>
                <td class="text-left"style="font-size:12px;font-weight: bold;"><?=$endDateTime; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;">Time Interval :</td>
                <td class="text-left"style="font-size:12px;font-weight: bold;"><?=$interval;?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;">End By :</td>
                <td class="text-left"style="font-size:12px;font-weight: bold;"><?=$technicianName; ?></td>
            </tr>
            <tr>
                <td class="text-right"style="font-size:12px;">Status :</td>
                    <?php
                        if($interval > '00:15:00'){
                            $statusFix = 'DOWNTIME';
                            echo '<td class="text-left" style="font-size:12px;font-weight: bold;color:red;">'.$statusFix.'</td>';
                        }else{
                            $statusFix = 'GOOD';
                            echo '<td class="text-left" style="font-size:12px;font-weight: bold;color:green;">'.$statusFix.'</td>';
                        }
                    ?>
                
            </tr>
        </table>
    </div>



<!-- FORMS------------------------------------------------------------------------------------------------------------ -->
    <div class="col-sm-6">
        <div>
        <button class="btn blue text-center btn-sm white-text z-depth-5" id="confirmationBTN" data-toggle="modal" data-target="#confirmationModal">Change Information</button>
        <br>
            <label style="font-size:12px;font-weight:bold;color:gray;">PROBLEM ENCOUNTERED</label><br>
        </div>
        <div class="form-group">
<!-- CONFIRMATION FORM --------------------------------------------------------------------------------------------------->
            <div class="departmentDiv col-12 text-center mt-1">
                <select class="custom-select browser-default z-depth-1"  id="solutionSelect" style="font-size:12px;">
                    <option value="">Solution</option>
                        <?php
                            $sqlSelect = "SELECT DISTINCT solution from tblsolution where department like '$department%' AND machineName like '$machineName%' ORDER BY solution ASC";
                            $qrySelect = $db->query($sqlSelect);
                            while ($resSelect = $qrySelect->fetch_assoc()) {
                                echo "<option value='".$resSelect['solution']."'>".$resSelect['solution']."</option>";
                            }
                        ?>
                </select>
<!-- INPUT ------------------------------------------------------------------------------------------------------------------>
                <input type="text" class="form-control text-center mt-1 z-depth-1" id="solutionInput" placeholder="Manual Input of Solution" style="font-size:12px;" oninput="verify_solution()">
                <input type="text" class="form-control text-center mt-1 z-depth-1" name="serial" id="serial" placeholder="Serial number" style="font-size:12px;">   
<!-- CONFIRM BUTTON --------------------------------------------------------------------------------------------------------->
                <?php
                    if($department == 'EQD' && $machineName == 'TRD' && $trd_concern == 'Applicator'){
                        echo '<button class="btn green btn-sm white-text" id="endAndonBtn" disabled>Confirm</button>';
                    }else{
                        echo '<button class="btn green btn-sm white-text" id="endAndonBtn">Confirm</button>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
<!-- GRAPH ---------------------------------------------------------------------------------------------------------------->
    <div class="col-sm-6">
        <canvas id="myChart" class="myChart z-depth-3" style="max-width: 600px;"></canvas>
    </div>
<!-- END GRAPH ---------------------------------------------------------------------------------------------------------------->


<!-- ADDITIONAL FORMS ---------------------------------------------------------------------------------------------------------->
    <div class="col-sm-6">
        <!-- JIG DETAILS FOR PE -->
        <?php
            if($department == "PE"){
                echo '<legend style="font-size:15px;font-weight:bold;">JIG DETAILS</legend>';
            }
        ?>
        <fieldset>
            <?php
            if ($department =="PE") {
            echo '<input type="text" name="jigName" id="jigName" class="form-control text-center z-depth-1" placeholder="Jig name" autocomplete="off" style="font-size:12px;">';
            echo '<input type="text" name="circuitLocation" id="circuitLocation" class="form-control text-center mt-2 z-depth-1" placeholder="Circuit / Location" autocomplete="off" style="font-size:12px;">';
            }else{
            echo '<input type="text" name="jigName" id="jigName" class="form-control text-center z-depth-1" placeholder="Jig name" autocomplete="off" style="font-size:12px;display:none;">';
            echo '<input type="text" name="circuitLocation" id="circuitLocation" class="form-control text-center mt-2 z-depth-1" placeholder="Circuit / Location" autocomplete="off" style="font-size:12px;display:none;">';
            }
            ?>
<!-- SHOW FIELDS SOLUTION SELECT ---------------------------------------------------------------------------------------------->
    <?php 
       
        // IF CONCERN TRD AND APPLICATOR 
        if($department == "EQD" && $machineName == "TRD" && $trd_concern == 'Applicator'){
    ?>
    <center style="font-size:12px;font-weight:bold;">TRD APPLICATOR SOLUTION INTENDED ONLY FOR CRIMPING AND ANVIL</center>
    <div class="form-group col-sm-12">
        <select class=" custom-select browser-default mt-1 z-depth-1" id="solutionTRD" onchange="enable_part()" style="font-size:12px;">
            <option value="" disabled="" selected="" >--Applicator Solution Category--</option>
            <option value="trouble">Troubleshooting</option>
            <option value="replace">Replacement</option>
        </select>
        <select class=" custom-select browser-default mt-1 z-depth-1 " id="replaceStat" disabled="" style="font-size:12px;">
            <option value="" disabled="" selected="" onclick="enable_appl_name()">--Parts Used--</option>
            <option value="local">Local</option>
            <option value="imported">Imported</option>
        </select>
        <input type="text" class="form-control mt-1 z-depth-1" id="app_name" name="" placeholder="Applicator Name" style="font-size:12px;" autocomplete="off" disabled="">
        <input type="text" class="form-control mt-1 z-depth-1" id="app_uniq_num" name="" placeholder="Applicator Unique #" style="font-size:12px;" autocomplete="off" disabled="">
        <input type="text" class="form-control mt-1 z-depth-1" id="app_work_order_no" name="" placeholder="Work Order #" style="font-size:12px;" autocomplete="off" disabled="">
        <input type="password" class="form-control mt-2 z-depth-1" id="jr_staff_verification" name="" placeholder="Jr. Staff Verification ID" style="font-size:12px;border:1px solid green;" autocomplete="off" onchange="verify_operator(<?=$listId;?>)" disabled>
        <input type="hidden" name="" value="<?=$operatorName;?>" id="operator_call" disabled>
        <span class="mt-1" id="jr_remarks" style="float:right;"></span>
    </div>
    <?php
        }
    ?>
<!-- FORM APPLICATOR INFO ------------------------------------------------------------------------------------------------------>
        </fieldset>
        <!-- <legend>Product Details</legend>
        <fieldset>
            <?php
                // if($department == 'PE'){
                //     echo '<div style="margin-bottom:1%;">';
                //     echo '<input type="text" class="form-control text-center" placeholder="Lot No." id="lotNumber" autocomplete="off">';
                //     echo '<input type="text" class="form-control text-center mt-2" placeholder="Product No." id="productNumber" autocomplete="off">';
                //     echo '</div>';
                // }else{
                //     echo '<div style="margin-bottom:1%;">';
                //     echo '<input type="text" class="form-control text-center" placeholder="Lot No." id="lotNumber" disabled>';
                //     echo '<input type="text" class="form-control text-center mt-2" placeholder="Product No." id="productNumber" disabled>';
                //     echo '</div>';
                // }
            ?>
        </fieldset> -->
    </div>
</div>
    <?php
}
?>
<!-- END ADDITIONAL FORM------------------------------------------------------------------------------------------------------ -->
<script>
function verify_solution(){
    var txt = $('#solutionInput').val();
    var match = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
    var num_match = /\d+/g;
    if(txt.match(match) || 
        txt.includes('awit') || 
        txt.includes('umay') || 
        txt.includes('nagpalit') || 
        txt.includes('nilinis') ||
        txt.includes('nag') ||
        txt.includes('palit') || 
        txt.includes('nalimutan') ||
        txt.includes('pindot') ||
        txt.includes('inalis') ||
        txt.includes('inayos') ||
        txt.includes('hinigpitan') ||
        txt.includes('UMAY') || 
        txt.includes('NAGPALIT') || 
        txt.includes('NILINIS') ||
        txt.includes('NAG') ||
        txt.includes('PALIT') || 
        txt.includes('NALIMUTAN') ||
        txt.includes('PINDOT') ||
        txt.includes('INALIS') ||
        txt.includes('INAYOS') ||
        txt.includes('HINIGPITAN') ||
        txt.match(num_match)
        ){
        swal('Inappropriate Solution','Please observe proper usage of the system!','info');
        $('#solutionInput').val('');
    }
    if(txt.includes('andon problem') || txt.includes('andon system problem')){
        swal('Really?');
    }
}

$('.select').selectize({sortField: 'text'});
$('#confirmationBTN').click(function(){
    let listIDforChange = '<?= $listId;?>';
    $('#confirmationModal').modal('toggle');
    $.ajax({
        type:"POST",
        url:"ajax/changeInformation.php",
        data:{listIDforChange:listIDforChange},
        success:function(response){
            $('.ConfirmationDetails').html(response);
            // console.log(response);
        }
    });
});
// EXIT CONFIRMATION MODAL ------------------------------------------------------------------------------------------------------
    $('#doneFixingExitbtn').click(function(){
        window.localStorage.removeItem('ongoing_id');
         location.reload();
    });
    let x = <?= json_encode($arrayLabel);?>;
    let y = <?= json_encode($arrayValue);?>;
    const charts = (x,y)=>{
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
            labels: x,
            datasets: [{
            label: 'Total minutes',
            data: y,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                             beginAtZero: true,
                             stepSize: 10,
                        }
                        }]
                    }
                }
            });
        }
        charts(x,y);

// END FUNCTION ------------------------------------------------------------------------------------------------------------------
 $('#endAndonBtn').click(function(){
    var listID = '<?=$listId;?>';
    var line = '<?=$line;?>';
    var requestedId = '<?=$requestedId;?>';
    var category = '<?=$category?>';
    var machineName = '<?=$machineName;?>';
    var machineNo = '<?=$machineNo;?>';
    var processDesc = '<?=$process;?>';
    var problem = '<?=$problem;?>';
    var operatorName = '<?=$operatorName?>';
    var department = '<?=$department?>';
    var technicianID = '<?=$technicianId;?>';
    var technicianName = '<?=$technicianName;?>';
    var backupID = '<?=$backupTechID;?>';
    var backupTechName = '<?=$backupTechName;?>';
    var backupComment = '<?=$backupComment;?>';
    var backupReqTime = '<?=$backupRequestTime;?>';
    var status = 'DONE';
    var waitingTime = '<?=$waitingTimeMinutes;?>';
    var andonRequestDateTime = '<?=$requestDateTime;?>';
    var startFixingTime = '<?=$startDateTime;?>';
    var andonEndDateTime = '<?=$endDateTime; ?>';
    var fixInterval = '<?=$interval;?>';
    var fixRemarks = '<?=$statusFix;?>';
    var solution = $("#solutionSelect").val()+" "+ $('#solutionInput').val();
    var serialNum = $("#serial").val();
    var jigName = $("#jigName").val();
    var circuitLoc = $("#circuitLocation").val();
    var ipPathReq = '<?=$ipPathReq;?>';
    var ipPathAccept = '<?= $ipPathTechAccept;?>';
    var backupDateTimeAccept = '<?=$backupAccept;?>';
    var lot = $('#lotNumber').val();
    var productNo = $('#productNumber').val();
// FOR APPLICATOR-------------------------------------------------------------------------------------------------------------
    var solutionTRD = $('#solutionTRD').val();
    var applicator_name = $('#app_name').val();
    var applicator_number = $('#app_uniq_num').val();
    var replaceStat = $('#replaceStat').val();
    var work_order_no = $('#app_work_order_no').val();
    var concern_trd = '<?=$trd_concern;?>';
// TRD APPLICATOR TROUBLE  ----------------------------------------------------------------------------------------------------
    if(department == 'EQD' && machineName == 'TRD' && concern_trd == 'Applicator'){
      if(solutionTRD == 'trouble'){
        applicator_name = "N/A";
        applicator_number="N/A";
        replaceStat = "N/A";
        work_order_no = "N/A";
        }  
    }else{
        solutionTRD = 'N/A';
        applicator_name = "N/A";
        applicator_number="N/A";
        replaceStat = "N/A";
        work_order_no = "N/A";
    }
// AJAX END ANDON CODE -----------------------------------------------------------------------------------------------------
    $(this).attr('disabled',true);
    var xhttp =  new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var response = this.responseText;
            if(response == 'success'){
                $('#doneFixingConfirm').modal('toggle');
                swal('Andon Ended').then((value) => {
                    location.reload();
                    window.localStorage.removeItem('ongoing_id');
                });
            }
            else if(response == 'counterMeasure'){
                swal('Attention!','Please input your solution or complete necessary details!','info');
                $('#endAndonBtn').attr('disabled',false);
            }
            else{
                swal('Failed, please try again.');
                $('#endAndonBtn').attr('disabled',false);
            }
        }
    };
    xhttp.open("GET","ajax/doneFixingProcessor.php?line="+line+
        "&&requestedId="+requestedId+
        "&&category="+category+
        "&&machine_name="+machineName+
        "&&machine_num="+machineNo+
        "&&process="+processDesc+
        "&&problemEn="+problem+
        "&&operator_name="+operatorName+
        "&&department="+department+
        "&&techID="+technicianID+
        "&&techName="+technicianName+
        "&&backupID="+backupID+
        "&&backName="+backupTechName+
        "&&backComment="+backupComment+
        "&&backReqTime="+backupReqTime+
        "&&status="+status+
        "&&startFixing="+startFixingTime+
        "&&waiting_time="+waitingTime+
        "&&andonreqdate="+andonRequestDateTime+
        "&&andonenddate="+andonEndDateTime+
        "&&fixingTime="+fixInterval+
        "&&fixingRemarks="+fixRemarks+
        "&&solution="+solution+
        "&&serial="+serialNum+
        "&&jig_name="+jigName+
        "&&circuitLoc="+circuitLoc+
        "&&ipPathReq="+ipPathReq+
        "&&ipPathAccept="+ipPathAccept+
        "&&backupAccept="+backupDateTimeAccept+
        "&&lotNumber="+lot+
        "&&productNumber="+productNo+
        "&&solutionTRD="+solutionTRD+
        "&&appl_name="+applicator_name+
        "&&appl_number="+applicator_number+
        "&&replaceStat="+replaceStat+
        "&&work_order_no="+work_order_no+
        "&&concern_trd="+concern_trd
        ,true);
    xhttp.send();
 });
</script>
<?php $db->close();?>