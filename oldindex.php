<?php
include 'database/index.php';
header('Refresh:3600');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Andon System</title>
  <link rel="icon" type="image/png" href="img/ANDON ICON.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->

  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/selective.css">
  <link href="css/style.css" rel="stylesheet">
</head>

<style>
body{
    /* zoom:90%; */
    font-family:arial;
    
}
/* scrollbar */
div::-webkit-scrollbar {
  width: 10px;
}
div::-webkit-scrollbar-track {
    border-radius:10px;
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}
div::-webkit-scrollbar-thumb {
  background-color: #267ae0;
  border-radius:10px;
}
/* responsive text for request form*/
@media only screen and (max-width:600px){
   
    .request_form {
        font-size:10px;
    }
}
table {
    zoom: 90%;
}
</style>
<!-- Navigation bar Start here -->
  <?php include 'Nav/prod_nav.php';?>
<!-- Navigation bar end here -->
<body>
<input type="hidden" name="" id="countRequestview" value="0">
<input type="hidden" name="" id="countOngoingview" value="0">
<!-- Start your project here-->
  <div class="container-fluid">
    <div class="row">
        <div class="col-4 mt-2">
        <!-- <form action="#" method="post" > -->
            <div class="row">
                <div class="col-12 text-center">
                    <img src="img/andono.png" alt="" style="width:100%;" >
                </div>
            </div>
        
            <div class="row mt-2 h6 request_form" style="min-height:75vh;">
                <div class="card col-12 pt-3 pb-3">
                    <div class="row">
                        <div class="col-6 text-right ">
                            <div class="custom-control ml-3 custom-radio article title font-weight-bolder">
                                <input type="radio" class="custom-control-input" id="initial" name="defaultExampleRadios">
                                <label class="custom-control-label" for="initial" id="init-label">Initial</label>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="custom-control ml-3 custom-radio article title font-weight-bolder">
                                <input type="radio" class="custom-control-input" id="final" name="defaultExampleRadios">
                                <label class="custom-control-label" for="final" id="final-label">Final</label>
                            </div>
                        </div>
                        <!-- hidden text  -->
                            <input type="hidden" name="category" id="category">
                            <input type="hidden" name="fullName" id="fullName">
                            <input type="hidden" name="hiddenID" id="hiddenID">
                        <!-- end of hidden -->
                    </div> 
                    <div class="row">
                        <div class="departmentDiv col-12 text-center mt-2">
                            <select class="select"  id="deptDiv" disabled>
                            </select>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12 text-center mt-2 mb-3">
                            <div class="form-row">
                                <input type="password" id="scanId"  class="form-control text-center" disabled placeholder="Scan your ID" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="carModel col-12 text-center mt-2">
                            <select class="select" id="carModel" disabled>
                                <option value="wala" disabled selected>Car Model / Line</option>
                            </select>
                    </div>
                        <div class="machineName col-12 text-center mt-2">
                            <select class="select" disabled>
                                <option value="wala" disabled selected >Machine Name</option>
                            </select>
                        </div>
                        <div class="process col-12 text-center mt-2">
                            <select class="select" disabled >
                                <option value="wala" disabled selected >Process</option>
                                
                            </select>
                            <select class="select" disabled >
                                <option value="wala" disabled selected >Machine No.</option>
                                
                            </select>
                            <select class="select" disabled >
                                <option value="wala" disabled selected >Encountered Problem</option>
                            </select>
                        </div>
                        <div class="col-12 text-center">
                            <!-- <input type="submit" value="Submit" id="btnSubmit" class="btn btn-danger" > -->
                            <button id="btnSubmit" class="btn btn-danger">Submit</button>
                            <button id="cancelAndonBtn" class="btn btn-success" onclick="location.reload()">Cancel</button>
                        </div>
                    </div>
                </div> 
            </div>
        <!-- </form> -->
        </div>
<!-- viewer location -->
        <div class="col-8 mt-2">
            <div class="row">
                <select class="browser-default custom-select" id="viewerFilter" onchange="requestView()" style="width:auto;margin-bottom:-3%;margin-left:1%;">
                    <option value="">--All Department--</option>
                     <?php
                        $sql = "SELECT *FROM tbldepartment";
                        $query = $db->query($sql);
                        while ($x = $query->fetch_assoc()) {
                            echo '<option value="'.$x['deptCode'].'">'.$x['description'].'</option>';
                        }
                    ?>
                </select>
                <div class="col-12 mt-5" style="height:350px;zoom:75%;overflow:auto">
                    <table class="table table-sm table-hover table-bordered table-striped">
                        <thead  style="background:#ada2a1;">
                            <th>Line</th>
                            <th>Problem</th>
                            <th>Request By</th>
                            <th>Department</th>
                            <th>Request Time</th>
                            <th>Confirm By</th>
                        </thead>
                        <tbody class="requestTable"></tbody>
                    </table> 
                </div>
            </div>
            <br>
            <div class="row">
                <select class="browser-default custom-select" id="viewerFilterOngoing" onchange="ongoingView()" style="width:auto;margin-bottom:-3%;margin-left:1%;">
                    <option value="">--All Department--</option>
                     <?php
                        $sql = "SELECT *FROM tbldepartment";
                        $query = $db->query($sql);
                        while ($x = $query->fetch_assoc()) {
                            echo '<option value="'.$x['deptCode'].'">'.$x['description'].'</option>';
                        }
                    ?>
                </select>
                 <div class="col-12 mt-5" style="height:400px;zoom:70%;overflow:auto;">
                    <table class="table table-hovered table-bordered">
                        <thead style="background:#ada2a1;">
                            <th>Line</th>
                            <th>Action By</th>
                            <th>Department</th> 
                            <th>Start Time</th>
                            <th>Requested By</th>
                             <th>Ongoing Backup</th>
                        </thead>
                        <tbody class="ongoingTable" style="border-collapse:collapse;"></tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
  </div>
<?php
include 'modal/requestClickModal.php';
include 'modal/cancelConfirm.php';
include 'modal/startFixing.php';
// ongoging modal
include 'modal/ongoingMenu.php';
include 'modal/doneFixing.php';
include 'modal/doneFixingConfirm.php';
// for confirmation modal
include 'modal/changeInformation.php';
//request backup modal
include 'modal/requestBackupModal.php';
// accept backup modal 
include 'modal/acceptBackupModal.php';
?>
  <!-- SCRIPTS -->
  <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="sweetalert/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="sweetalert/sweetalert2.all.js"></script>
    <script src="js/selectize.js"> </script>
    <!-- JQUERY CODE PERSONAL -->
 <script>
    $(document).ready(function(){
        $('#btnSubmit').attr('disabled',true); 
    });
// REALTIME COUNT REQUEST VIEW
  $(document).ready(function(){
        setTimeout(countRequest, 5000);
        setTimeout(countOngoing, 8000);
        setInterval(realtime, 1000);
    });
// -----------------------------------------------------------------------------------------------------------------------------
   window.onload = function () {
           document.addEventListener("contextmenu", function (e) {
               e.preventDefault();
           }, false);
           document.addEventListener("keydown", function (e) {
               //document.onkeydown = function(e) {
               // "I" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                   disabledEvent(e);
               }
               // "J" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                   disabledEvent(e);
               }
               // "S" key + macOS
               if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                   disabledEvent(e);
               }
               // "U" key
               if (e.ctrlKey && e.keyCode == 85) {
                   disabledEvent(e);
               }
               // "F12" key
               if (event.keyCode == 123) {
                   disabledEvent(e);
               }
           }, false);
           function disabledEvent(e) {
               if (e.stopPropagation) {
                   e.stopPropagation();
               } else if (window.event) {
                   window.event.cancelBubble = true;
               }
               e.preventDefault();
               return false;
           }
       }
//-----------------------------------------------------------------------------------------------------------------------------

// COUNTER OF REQUEST
const countRequest =()=>{
    $.ajax({
        url: "ajax/count.php",
        type: "GET",
        cache:false,
        data:{
            method: 'countRequest'
        },success:function(response){
            var x = document.querySelector("#countRequestview");
            var x = parseInt(x);
            var response = parseInt(response);
            if(x != response){
                requestView();
                $('#countRequestview').val(response);
            }
            setTimeout(countRequest,10000);
        },error:function(){
        }
    });
}
// COUNTER OF ONGOING
const countOngoing =()=>{
     $.ajax({
        url: "ajax/count.php",
        type: "GET",
        cache:false,
        data:{
            method: 'countOngoing'
        },success:function(response){
            var x = document.querySelector("#countOngoingview");
            var x = parseInt(x);
            var response = parseInt(response);
            if(x != response){
                ongoingView();
                $('#countOngoingview').val(response);
            }
            setTimeout(countOngoing,10000);
        },error:function(){
    }
    });
}
// VIEWING ANDON REQUEST
    const requestView = ()=>{
        dept = $('#viewerFilter').val();
        $.ajax({
            type:"POST",
            url: "ajax/requestTable.php",
            cache:false,
            data:{
                    onStart:'onload',
                    dept:dept
                },
            success: function(response){
                $('.requestTable').html(response);
                //console.log(response);
            },
            error: function(){
            }
        });
    } 
// VIEWING ONGOING ANDON
    const ongoingView =()=>{
        dept = $('#viewerFilterOngoing').val();
        $.ajax({
            type:"POST",
            url: "ajax/ongoingTable.php",
            cache:false,
            data:{onStart:'onload',dept:dept},
            success: function(response){
                $('.ongoingTable').html(response);
                //console.log(response);
            },
            error: function(){
            }
        });
    } 
// REALTIME FUNCTION
    const realtime = () =>{
        var real = "real";
        $.ajax({
            type: "GET",
            url: "ajax/datetime.php",
            cache:false,
            data: {real:real},
            success: (response)=>{
                //console.log(response);
                $('#realtime').html(response);
            }
        });
    }
//RADIO CATEGORY FUNCTION ON SELECT
        $('#initial').click(function(){
            $('#category').val("Initial");
            $('.departmentDiv').load('select/department.php');
        });

        $('#final').click(function(){
            $('#category').val("Final");
            $('.departmentDiv').load('select/department.php');
        });


// -------------------------------------------------------------------------------
   // SCAN ID FUNCTIONS
        $('#scanId').keyup(function(){
            let scanId = $(this).val();
            let category = $('#category').val();
            let carMaker = "";
            let fullName = "";
            if (event.keyCode === 13){
                event.preventDefault();
                $.ajax({
                    type:'POST',
                    url: 'ajax/checkUser.php',
                    data:{scanId:scanId},
                        dataType: 'JSON',
                    success:(response)=>{
                        //console.log(response);
                        for(let data of response){
                        //console.log(data.firstName);  
                            $('#carModel').val(data.carMaker);
                            //console.log(data.firstName+data.lastName);
                            fullName =`${data.firstName} ${data.lastName}`;
                            // console.log(fullName);
                            $('#fullName').val(fullName);
                            $('.carModel').load('select/carModel.php',{iChange:'carModel',category:category,carMaker:data.carMaker});
                            $('#carModel').focus();
                        }
                    },
                    error:function(){
                        swal('Invalid ID','Please try again.','error');
                    }
                });
            }
        });
    // END OF SCAN FUNCTION
    $('.select').selectize({
          sortField: 'text'
      });

    // SUBMIT ANDON REQUEST  VIA BUTTON ON CLICK
    $('#btnSubmit').click(function(){
      $('#btnSubmit').attr('disabled',true);
        const categoryText = $('#category').val();
        const lineText = $('#carModel').val();
        const carMakerText = $('#carMaker').val();
        const line = `${carMakerText}-${lineText}`;
        const machineNameText = $('#machineName').val();
        var machineNoText = $('#machineNo').val();
        var processText = $('#process').val();
        const problemText = $('#problem').val();
        const requestedIdText = $('#scanId').val();
        const fullNameText = $('#fullName').val();
        const departmentText = $('#deptDiv').val();
        if (!machineNoText) {
            machineNoText = 'N/A';
        }
        if(!processText) {
            processText = 'N/A'
        }
        if(departmentText == ''){
          swal('Warning','Incomplete Andon Please choose department to concern.','info');
        }
        else if(lineText == ''){
          swal('Warning','Please choose Car Model Line','info');
        }
        else if(machineNameText == ''){
          swal('Warning','Please specify the Machine Name','info');
        }else if(problemText == ''){
          swal('Warning','Please specify the encountered problem','info');
        }
        else{
          $.ajax({
            type:'POST',
            url: 'ajax/request.php',
            data: {
                   request:"request",
                   categoryText:categoryText,
                   line:line,
                   machineNameText:machineNameText,
                   machineNoText:machineNoText,
                   processText:processText,
                   problemText:problemText,
                   requestedIdText:requestedIdText,
                   fullNameText:fullNameText,
                   departmentText:departmentText
            },
            success:function(response){
                // console.log(response);
                swal("Success!", "Andon request successfully posted.", "success")
                .then((value) => {
                    location.reload();
                });
            },
            error:function(response){
            }
        });
        }
    });
    //ANDON REQUEST ON CLICK -> GETTING THE LIST ID
        const clickRequest = (listId)=>{
            $('#modalOption').modal('toggle');
            $('#hiddenID').val(listId);
        }
    //ANDON CANCEL BUTTON FUNCTION
        $('#cancelRequest').click(function(){
            $('#modalOption').modal('hide');
            $('#cancelConfirm').modal('show');
            var listId = $('#hiddenID').val();
            $.ajax({
                type:"POST",
                url:"ajax/cancelRequest.php",
                data: {listId:listId},
                success:function(response){
                    $('.details').html(response);
                    $('#cancelScanID').focus();  
                },
                error:function(response){
                   swal('Error','Something went wrong, please reload the page and try again.','error');
                }
            });
        });
    // START FIXING BUTTON -> GETTING ANDON REQUEST
        $('#startFixingRequest').click(function(){
            $('#modalOption').modal('toggle');
            $('#startFixing').modal('show');  
            var listId = $('#hiddenID').val();
            $.ajax({
                type:"POST",
                url:"ajax/startRequest.php",
                data: {listId:listId},
                success:function(response){
                    // console.log(response);
                    $('.details').html(response);
                    $('#cancelScanID').focus();   
                    requestView();
                    ongoingView();
                },
                error:function(response){
                    swal('Error, Please try again or repload the page.');
                }
            });
        }); 
      // THIS IS FOR ONGOING ANDON FUNCTION   
       const clickOngoing = (id)=>{
        $('#hiddenID').val(id);
        $('#basicExampleModal').modal('toggle');
       }
       const clickDone =()=>{
           listId = $('#hiddenID').val();
           $('#doneFixing').modal('toggle');
           $.ajax({
                url:"ajax/ongoingRequest.php",
                type:"POST",
                data:{listId:listId},
                success:function(response){
                    $('.ongoingDetails').html(response);
                    //console.log(response);
                },
                error:function(){
                    swal('Error, Please try again.');
                }
           });
       }
// backup request viewing details
        const reqBack =()=>{
            listId = $('#hiddenID').val();
            $('#requestBackupModal').modal('toggle');
            $('#basicExampleModal').modal('toggle');
            $.ajax({
                url: "ajax/requestBackup.php",
                type: "POST",
                data:{listId:listId},
                success:function(response){
                    $('#backupDetails').html(response);
                },
                error:function(){
                    swal('Error, Please try again.');
                }
            });
          }
        // on enter password on backup
        const backupEnter =()=>{
             reqID = $('#recID').val();
             reminder = $('#form_remind').val();
             passwordBackup = $('#passwordBackup').val();
             techID = $('#techID').val();
             // if entered ID is equal to the ID of fixer syntax will proceed
              if(reminder == ''){
                swal('Please input reminder','Example: I need DDR4 RAM.');
              }
             else if(passwordBackup === techID){
                $.ajax({
                    url: "ajax/backupSendprocessor.php",
                    type: "POST",
                    data:{
                        reqID:reqID,
                        reminder:reminder,
                        passwordBackup:passwordBackup,
                    },
                    success:function(response){
                     swal('Success','Backup request successfully sent.','success');
                      $('#requestBackupModal').modal('toggle');
                    },
                    error:function(){
                        swal('Error, please try again or reload the page.');
                    }
                });
             }else{
                swal('Invalid ID');
             }
        }

        // viewing backup details
        const acceptBack =()=>{
            listId = $('#hiddenID').val();
            $('#acceptBackupModal').modal('toggle');
            $('#basicExampleModal').modal('toggle');
            $.ajax({
                url: "ajax/acceptBackupDetails.php",
                type: "GET",
                data:{listId:listId},
                success:function(response){
                    $('#backupdetails').html(response);
                },
                error:function(){
                    swal('Error, please try again or press F5.');
                }
            });
        }
        // get backup
       const getBackup =()=>{
        techID = $('#getBackup').val();
        listID = $('#recordId').val();
        dept = $('#dept').val();
        prevTech = $('#technicianName').val();
        $.ajax({
            url:"ajax/acceptBackupProcessor.php",
            type:"GET",
            data:{
                techID:techID,
                listID:listID,
                dept:dept,
                prevTech:prevTech
            },
                success:function(response){
                    if(response == 'success'){
                        $('#acceptBackupModal').modal('toggle');
                        swal('Success','You successfully accepted the backup request.','success');
                    }else{
                        swal('Failed','Invalid ID','info');
                   }
                },
                error:function(){
                    swal('Error, please try again or press F5.');
            }
        });
       }
        const openDowntime =()=>{
            window.open("admin/page/generateDowntime.php","Top 10 Downtime","width=1000,height=600,left=150");
        }
        // -----------------------------------------------------------------------------------------------------------------------
        const openAndonLogsProd =()=>{
            window.open("admin/page/andonProdLogs.php","Andon Logs","width=1000,height=600,left=150");
        }

        // ------------------------------------------------------------------------------------------
       
 </script>
</body>
</html>
<?php $db->close();?>