<?php
include 'database/index.php';

// FUNCTION FOR ACCESS REPORT--------------------------------------------------------------------------------------------------------


// -----------------------------------------------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Andon System</title>
  <link rel="icon" type="image/png" href="img/ANDON ICON.png">
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/selective.css">
  <link href="css/style.css" rel="stylesheet">
</head>
<style>
  div::-webkit-scrollbar {
    width: 10px
  }

  div::-webkit-scrollbar-track {
    border-radius: 10px;
    box-shadow: inset 0 0 6px rgba(0, 0, 0, .3)
  }

  div::-webkit-scrollbar-thumb {
    background-color: #267ae0;
    border-radius: 10px
  }

  @media only screen and (max-width:600px) {
    .request_form {
      font-size: 10px
    }
  }

  body {
    font-family: arial;
  }

  button {
    border-radius: 20px;
  }

  @media only screen and (max-width: 700px) {
    body {
      /* background-color: lightblue; */
      display: none;
    }
  }

  body::-webkit-scrollbar {
    width: 0.5em;
  }

  body::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  }

  body::-webkit-scrollbar-thumb {
    background-color: blue;
  }
</style>
<!-- Navigation bar Start here -->
<?php include 'Nav/prod_nav.php'; ?>
<!-- Navigation bar end here -->

<body>
  <input type="hidden" name="" id="countRequestview" value="0">
  <input type="hidden" name="" id="countOngoingview" value="0">
  <!-- START PROJECT HERE--------------------------------------------------------------------------------------------------------->
  <div class="container-fluid">
    <div class="row">
      <div class="col-4 mt-1">
        <div class="row">
          <div class="col-12 text-center">
            <img src="img/andono.png" class="responsive-img" alt="" style="width:60%;">
          </div>
        </div>
        <!-- ANDON FORM------------------------------------------------------------------------------------------------------------------- -->
        <div class="row mt-2 request_form z-depth-3" id="form" style="min-height:70vh;width:80%;margin-left:10%;">
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
                <!-- DEPARTMENT -->
                <select class="z-depth-1 custom-select browser-default" id="deptDiv" disabled></select>
              </div>
            </div>
            <!-- ID -->
            <div class="row">
              <div class="col-12 text-center mt-2 mb-3">
                <input type="password" id="scanId" class="z-depth-1 form-control text-center" disabled
                  placeholder="Scan your ID" autocomplete="off" disabled>
              </div>
            </div>
            <!-- --------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="row">
              <div class="carModel col-12 text-center mt-2">
                <select class="z-depth-1 custom-select browser-default" id="carModel" disabled></select>
              </div>
              <div class="machineName col-12 text-center mt-2">
                <!-- MACHINE NAME -->
                <select class="z-depth-1 custom-select browser-default" id="machineName" disabled></select>
              </div>
              <div class="process col-12 text-center mt-2">
                <!-- PROCESS -->
                <select class="z-depth-1 custom-select browser-default" id="process" disabled></select>
              </div>
              <!-- MACHINE NUMBER -->
              <div class="machineNo col-12 text-center mt-2">
                <select class="z-depth-1 custom-select browser-default" disabled id="machineNo"></select>
              </div>
              <div class="problem col-12 text-center mt-2">
                <select class="z-depth-1 custom-select browser-default" disabled id="problem"></select>
              </div>
              <div class="jigLocation col-12 text-center mt-2">
                <select class="z-depth-1 custom-select browser-default" disabled id="jigLocation"></select>
              </div>
              <div class="jigName col-12 text-center mt-2">
                <select class="z-depth-1 custom-select browser-default" disabled id="jigName"></select>
              </div>
              <div class="lineStatus col-12 text-center mt-2">
                <select class="z-depth-1 custom-select browser-default" disabled id="lineStatus"></select>
              </div>
              <div class="col-12 text-center">
                <!-- <input type="submit" value="Submit" id="btnSubmit" class="btn btn-danger" > -->
                <button id="btnSubmit" class="btn red z-depth-5 white-text btn-sm" disabled
                  style="border-radius:20px;">Submit</button>
                <button class="btn green z-depth-5 white-text btn-sm" onclick="location.reload()"
                  style="border-radius:20px;">Cancel</button>
              </div>
            </div>
            <br>
            <center>
              <span style="background-color:blue;color:white;padding:5px;font-size:9px;">IT</span>
              <span style="background-color:#2cf216;color:black;padding:5px;font-size:9px;">EQD Initial</span>
              <span style="background-color:#0b9e1f;color:white;padding:5px;font-size:9px;">EQD Final</span>
              <span style="background-color:red;color:white;padding:5px;font-size:9px;">PE Initial</span>
              <span style="background-color:#fa5007;color:white;padding:5px;font-size:9px;">PE Final</span>
            </center>
          </div>
        </div>

        <!-- </form>--------------------------------------------------------------------------------------------------------------------->
      </div>
      <!-- VIEWER LOCATION ----------------------------------------------------------------------------------------------------------->
      <div class="col-8 mt-2">
        <div class="row">
          <select class="browser-default custom-select z-depth-5" id="viewerFilter" onchange="requestView()"
            style="width:auto;margin-bottom:-3%;margin-left:1%;">
            <option value="">--All Department--</option>
            <?php
            $sql = "SELECT *FROM tbldepartment";
            $query = $db->query($sql);
            while ($x = $query->fetch_assoc()) {
              echo '<option value="' . $x['deptCode'] . '">' . $x['description'] . '</option>';
            }
            ?>
          </select>
          <!-- PRODUCTION -->
          <select class="browser-default custom-select z-depth-5" id="requestProd" onchange="requestView()"
            style="width:auto;margin-bottom:-3%;margin-left:1%;">
            <option value="">--All Production--</option>
            <option value="initial">Initial</option>
            <option value="final">Final</option>
          </select>

          <!-- TABLE PENDING -->
          <div class="col-12 mt-5" style="height: 50vh;zoom:80%;overflow:auto">
            <table class=" z-depth-5 table table-sm table-hover table-bordered table-striped">
              <thead style="background:#ada2a1;">
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
          <select class="browser-default custom-select z-depth-5" id="viewerFilterOngoing" onchange="ongoingView()"
            style="width:auto;margin-bottom:-3%;margin-left:1%;">
            <option value="">--All Department--</option>
            <?php
            $sql = "SELECT *FROM tbldepartment";
            $query = $db->query($sql);
            while ($x = $query->fetch_assoc()) {
              echo '<option value="' . $x['deptCode'] . '">' . $x['description'] . '</option>';
            }
            ?>
          </select>
          <!-- PRODUCTION -->
          <select class="browser-default custom-select z-depth-5" id="ongoingProd" onchange="ongoingView()"
            style="width:auto;margin-bottom:-3%;margin-left:1%;">
            <option value="">--All Production--</option>
            <option value="initial">Initial</option>
            <option value="final">Final</option>
          </select>
          <!-- TABLE ONGOING -->
          <div class="col-12 mt-5" style="height:50vh;zoom:80%;overflow:auto;">
            <table class="z-depth-5 table table-hovered table-bordered">
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
  <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
  <?php
  include 'modal/requestClickModal.php';
  include 'modal/cancelConfirm.php';
  include 'modal/startFixing.php';
  include 'modal/ongoingMenu.php';
  include 'modal/doneFixing.php';
  include 'modal/doneFixingConfirm.php';
  include 'modal/changeInformation.php';
  include 'modal/requestBackupModal.php';
  include 'modal/acceptBackupModal.php'; ?>
  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="sweetalert/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="sweetalert/sweetalert2.all.js"></script>
  <script src="js/selectize.js"></script>
  <script>
    // REALTIME COUNT REQUEST VIEW ------------------------------------------------------------------------------------------------------
    $(document).ready(function () {
      setTimeout(countRequest, 1000);
      setTimeout(countOngoing, 5000);
      setInterval(realtime, 1000);
      access_report();
    });
    // // -----------------------------------------------------------------------------------------------------------------------------
    //  window.onload=function(){function e(e){return e.stopPropagation?e.stopPropagation():window.event&&(window.event.cancelBubble=!0),e.preventDefault(),!1}document.addEventListener("contextmenu",function(e){e.preventDefault()},!1),document.addEventListener("keydown",function(t){t.ctrlKey&&t.shiftKey&&73==t.keyCode&&e(t),t.ctrlKey&&t.shiftKey&&74==t.keyCode&&e(t),83==t.keyCode&&(navigator.platform.match("Mac")?t.metaKey:t.ctrlKey)&&e(t),t.ctrlKey&&85==t.keyCode&&e(t),123==event.keyCode&&e(t)},!1)};
    //-----------------------------------------------------------------------------------------------------------------------------
    function access_report() {
      $.ajax({
        url: 'ajax/access_report.php',
        type: 'POST',
        cache: false,
        data: {
          method: 'access_report'
        }, success: function (response) {
          // DO NOTHING
        }
      });
    }


    // IDLE TIME DETECT INACTIVITY
    var idleTime = 0;
    $(document).ready(function () {
      var idleInterval = setInterval(timerIncrement, 60000); //PER 1 MINUTE
      $(this).mousemove(function (e) {
         idleTime = 0;
      });

      $(this).keypress(function (e) {
        idleTime = 0;
      });

      $(this).mousedown(function (e) {
        idleTime = 0;
      });

      $(this).click(function (e) {
        idleTime = 0;
      });

      $(this).keydown(function (e) {
        idleTime = 0;
      });

      $(this).scroll(function (e) {
        idleTime = 0;
      });
    });
    function timerIncrement() {
      idleTime = idleTime + 1;
      if (idleTime > 2) {
        location.replace('inactive.php');
      }
    }
    // COUNTER OF REQUEST--------------------------------------------------------------------------------------------------------------
    const countRequest = () => {
      $.ajax({
        url: "ajax/count.php",
        type: "GET",
        cache: false,
        data: {
          method: 'countRequest'
        }, success: function (response) {
          var x = document.querySelector("#countRequestview");
          var x = parseInt(x);
          var response = parseInt(response);
          if (x != response) {
            requestView();
            document.getElementById('countRequestview').value = response;
          }
          setTimeout(countRequest, 2000);
        }
      });
    }
    // COUNTER OF ONGOING------------------------------------------------------------------------------------------------------------------
    const countOngoing = () => {
      $.ajax({
        url: "ajax/count.php",
        type: "GET",
        cache: false,
        data: {
          method: 'countOngoing'
        }, success: function (response) {
          var x = document.querySelector("#countOngoingview");
          var x = parseInt(x);
          var response = parseInt(response);
          if (x != response) {
            ongoingView();
            document.getElementById('countOngoingview').value = response;
          }
          setTimeout(countOngoing, 20000);
        }
      });
    }
    // VIEWING ANDON REQUEST --------------------------------------------------------------------------------------------------------------
    const requestView = () => {
      var dept = document.getElementById('viewerFilter').value;
      var prod = document.getElementById('requestProd').value;
      $.ajax({
        type: "POST",
        url: "ajax/requestTable.php",
        cache: false,
        data: {
          onStart: 'onload',
          dept: dept,
          prod: prod
        },
        success: function (response) {
          $('.requestTable').html(response);
        }
      });
    }
    // VIEWING ONGOING ANDON
    const ongoingView = () => {
      var dept = document.getElementById('viewerFilterOngoing').value;
      var prod = document.getElementById('ongoingProd').value;
      $.ajax({
        type: "POST",
        url: "ajax/ongoingTable.php",
        cache: false,
        data: {
          onStart: 'onload',
          dept: dept,
          prod: prod
        },
        success: function (response) {
          $('.ongoingTable').html(response);
        }
      });
    }
    // REALTIME FUNCTION
    const realtime = () => {
      var real = "real";
      $.ajax({
        type: "GET",
        url: "ajax/datetime.php",
        cache: false,
        data: { real: real },
        success: (response) => {
          //console.log(response);
          $('#realtime').html(response);
        }
      });
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    // INITIAL SELECT
    $('#initial').click(function () {
      $('#category').val("Initial");
      $(this).attr('disabled', true);
      $('#final').attr('disabled', true);
      $.ajax({
        url: 'ajax/select.php',
        cache: false,
        type: 'GET',
        data: {
          method: 'selectDept'
        }, success: function (response) {
          $('#deptDiv').html(response);
          $('#deptDiv').attr('disabled', false);
          $('#deptDiv').focus();
        }, error: function () {
          // DO NOTHING IDIOT
        }
      });
    });
    // FINAL SELECT-------------------------------------------------------------------------------------------------------------------
    $('#final').click(function () {
      $('#category').val("Final");
      $(this).attr('disabled', true);
      $('#initial').attr('disabled', true);
      $.ajax({
        url: 'ajax/select.php',
        cache: false,
        type: 'GET',
        data: {
          method: 'selectDept'
        }, success: function (response) {
          $('#deptDiv').html(response);
          $('#deptDiv').attr('disabled', false);
          $('#deptDiv').focus();
        }, error: function () {
          // DO NOTHING 
        }
      });
    });
    // DISABLE DEPARTMENT ON SELECT- -------------------------------------------------------------------------------------------------------
    $('#deptDiv').change(function () {
      $(this).attr('disabled', true);
      enterID();
      $('#scanId').focus();
      $('#scanId').val('');
    });
    // SCAN ID ENABLE
    const enterID = () => {
      $('#scanId').attr('disabled', false);
    }
    // DISABLE ID AFTER SCAN
    $('#scanId').change(function () {
      $(this).attr('disabled', true);
      $('#carModel').attr('disabled', false);
      checkUser();
    });

    // CHECK OPERATOR ----------------------------------------------------------------------------------------------------------------------
    const checkUser = () => {
      id = $('#scanId').val();
      if (/[^a-zA-Z0-9\-\/]/.test(id)) {
        swal('Warning', 'Special Characters are not allowed!', 'info');
        $("#scanId").attr('disabled', false);
      } else {
        $.ajax({
          url: 'ajax/select.php',
          type: 'GET',
          cache: false,
          data: {
            id: id,
            method: 'checkUser'
          }, success: function (response) {
            if (response == 'invalid') {
              swal('Notice', 'Invalid ID Number! Please try again.', 'info');
              $("#scanId").attr('disabled', false);
              $('#scanId').val('');
            } else {
              $('#fullName').val(response);
              loadCarmodel();
              $(this).attr('disabled', true);
              $('#carModel').focus();
            }
          }
        });
      }
    }

    // loadcarmodel----------------------------------------------------------------------------------------------------------------
    const loadCarmodel = () => {
      operator = $('#scanId').val();
      category = $('#category').val();
      $.ajax({
        url: 'ajax/select.php',
        type: 'GET',
        cache: false,
        data: {
          method: 'selectCarmodel',
          operator: operator,
          category: category
        }, success: function (response) {
          $('#carModel').html(response);
          // console.log(response);
        }, error: function () {
          // DO NOTHING
        }
      });
    }
    // DISABLE CARMODEL AND ENABLES MACHINE NAME------------------------------------------------------------------------------
    $('#carModel').change(function () {
      $(this).attr('disabled', true);
      $('#machineName').attr('disabled', false);
      $('#machineName').focus();
      loadMachineName();
    });

    // LOAD MACHINE------------------------------------------------------------------------------------------------------------
    const loadMachineName = () => {
      categoryProd = $('#category').val();
      dept = $('#deptDiv').val();
      // /AJAX
      $.ajax({
        url: 'ajax/select.php',
        type: 'GET',
        cache: false,
        data: {
          method: 'loadmachinename',
          categoryProd: categoryProd,
          dept: dept
        }, success: function (response) {
          $('#machineName').html(response);
        }
      });
    }
    // ON MACHINE NAME SELECTION WILL DETECH IF HAVE PROCESS AND MACHINE NUMBER------------------------------------------------------
    $('#machineName').change(function () {
      $(this).attr('disabled', true);
      $('#process').attr('disabled', false);
      $('#process').focus();
      $('#machineNo').attr('disabled', false);
      detectProcess();
      // detectMachineNo();
    });

    // DETECT IF HAVE PROCESS-----------------------------------------------------------------------------------------------------
    const detectProcess = () => {
      machine_name = $('#machineName').val();
      dept = $('#deptDiv').val();
      $.ajax({
        url: 'ajax/select.php',
        type: 'GET',
        cache: false,
        data: {
          method: 'detectprocess',
          machine_name: machine_name,
          dept: dept
        }, success: function (response) {
          if (response == 'noprocess') {
            $('#process').attr('disabled', true);
            $('#process').val('');
            $('#machineNo').attr('disabled', false);
            detectMachineNo();
          } else {
            $('#machineNo').attr('disabled', true);
            $('#process').html(response);
          }
        }
      });
    }
    // ON CHANGE PROCESS ------------------------------------------------------------------------------------------------------------
    $('#process').change(function () {
      $(this).attr('disabled', true);
      $('#machineNo').attr('disabled', false);
      $('#problem').attr('disabled', false);
      detectMachineNo();
    });

    // DETECT MACHINE NO-------------------------------------------------------------------------------------------------------------
    const detectMachineNo = () => {
      machine_nym = $('#machineName').val();
      dept = $('#deptDiv').val();
      $.ajax({
        url: 'ajax/select.php',
        type: 'GET',
        cache: false,
        data: {
          method: 'detectmachineno',
          machine_nym: machine_nym,
          dept: dept
        }, success: function (response) {
          if (response == 'nonumber') {
            $('#machineNo').val('');
            $('#machineNo').attr('disabled', true);
            $('#problem').attr('disabled', false);
            loadProblem();
          } else {
            $('#machineNo').html(response);
          }
        }
      });
    }
    // ON CHANGE VALUE OF MACHINE NUMBER-------------------------------------------------------------------------------------------
    $('#machineNo').change(function () {
      $(this).attr('disabled', true);
      $('#problem').attr('disabled', false);
      $('#problem').focus();
      loadProblem();
    });
    // ------------------------------------------------------------------------------------------------------------------------------
    const loadProblem = () => {
      department = $('#deptDiv').val();
      machineName = $('#machineName').val();
      $.ajax({
        url: 'ajax/select.php',
        type: 'GET',
        cache: false,
        data: {
          method: 'loadproblems',
          department: department,
          machineName: machineName
        }, success: function (response) {
          $('#problem').html(response);
        }
      });
    }
    // -------------------------------------------------------------------------------------------------------------------------------
    $('#problem').change(function () {
      $(this).attr('disabled', true);
      $('#btnSubmit').attr('disabled', false);
    });
    // ----------------------------------------------------------------------------------------------------------------------------------------

    $('.select').selectize({
      sortField: 'text'
    });
    // -------SEND REQUEST ----------------------------------------------------------------------------------------------------
    $('#btnSubmit').click(function () {
      category = $('#category').val();
      department = $('#deptDiv').val();
      operator = $('#fullName').val();
      line = $('#carModel').val();
      machine = $('#machineName').val();
      processTxt = $('#process').val();
      machineNumber = $('#machineNo').val();
      problem = $('#problem').val();
      scanID = $('#scanId').val();
      if (processTxt == null) {
        processTxt = 'N/A';
      }
      if (machineNumber == null) {
        machineNumber = 'N/A';
      }
      $.ajax({
        url: 'ajax/requestAndon.php',
        type: 'POST',
        cache: false,
        data: {
          method: 'requestAndon',
          category: category,
          department: department,
          operator: operator,
          line: line,
          machine: machine,
          processTxt: processTxt,
          machineNumber: machineNumber,
          problem: problem,
          scanID: scanID
        }, success: function (response) {
           response = response.trim();
          if (response == 'success') {
            swal('Success', 'Andon Requested!', 'success').then((value) => {
              location.reload();
            });
          }else if(response == 'Already Exist'){
            swal('Andon Already Filed !', ' ', 'info');
          } else{
            swal('Error', 'Error', 'error');
          }
        }
      });
    });
    //ANDON REQUEST ON CLICK -> GETTING THE LIST ID-----------------------------------------------------------------------------------
    const clickRequest = (listId) => {
      $('#modalOption').modal('toggle');
      $('#hiddenID').val(listId);
    }
    //ANDON CANCEL BUTTON FUNCTION---------------------------------------------------------------------------------------------------
    $('#cancelRequest').click(function () {
      $('#modalOption').modal('hide');
      $('#cancelConfirm').modal('show');
      var listId = $('#hiddenID').val();
      $.ajax({
        type: "POST",
        url: "ajax/cancelRequest.php",
        data: { listId: listId },
        success: function (response) {
          // console.log(response);
          $('.details').html(response);
        },
        error: function (response) {
          swal('Error', 'Something went wrong, please reload the page and try again.', 'error');
        }
      });
    });
    // START FIXING BUTTON -> GETTING ANDON REQUEST----------------------------------------------------------------------
    $('#startFixingRequest').click(function () {
      $('#modalOption').modal('toggle');
      $('#startFixing').modal('show');
      var listId = $('#hiddenID').val();
      $.ajax({
        type: "POST",
        url: "ajax/startRequest.php",
        data: { listId: listId },
        success: function (response) {
          $('.details').html(response);
          requestView();
          ongoingView();
        }
      });
    });
    // THIS IS FOR ONGOING ANDON FUNCTION   ---------------------------------------------------------------------------------------------------
    const clickOngoing = (id) => {
      $('#hiddenID').val(id);
      $('#basicExampleModal').modal('toggle');
    }
    const clickDone = () => {
      listId = $('#hiddenID').val();
      $('#doneFixing').modal('toggle');
      $.ajax({
        url: "ajax/ongoingRequest.php",
        type: "POST",
        data: { listId: listId },
        success: function (response) {
          $('.ongoingDetails').html(response);
        }, error: function () {
          swal('Error, Please try again.');
        }
      });
    }
    // CHANGE INFO
    const change_info = () => {
      listId = $('#hiddenID').val();
      updateID = $('#id_update').val();
      n_machine = $('#machineName_update').val();
      n_process = $('#process_change').val();
      n_machine_no = $('#machine_num_change').val();
      n_problem = $('#problem_change').val();

      $.ajax({
        url: 'ajax/changeinfo.php',
        type: 'POST',
        cache: false,
        data: {
          method: 'update_information',
          updateID: updateID,
          n_machine: n_machine,
          n_process: n_process,
          n_machine_no: n_machine_no,
          n_problem: n_problem
        }, success: function (response) {
          // console.log(response);
          if (response == 'updated') {
            localStorage.setItem("ongoing_id", listId);
            swal('Alert', 'Successfully updated!', 'success').then((value) => {
              location.reload();
            });
          } else {
            swal('Failed!', 'Error, Please relaod your browser!', 'error');
          }
        }
      });
    }
    // GET THE ONGOING ANDON ID
    function get_ongoing_id() {
      return localStorage.getItem("ongoing_id");
    }
    // CHECK ID
    check_id();
    function check_id() {
      var ongoing_id = get_ongoing_id();
      listId = ongoing_id;
      if (!listId) {
        // DO NOTHING
      } else {
        $('#doneFixingConfirm').modal('show');
        $.ajax({
          url: "ajax/ongoingRequestConfirm.php",
          type: "GET",
          data: { listId: listId },
          success: function (response) {
            $('.ongoingDetailsConfirm').html(response);
          }, error: function () {
            swal('Error');
          }
        });
      }
    }

    const reqBack = () => {
      listId = $('#hiddenID').val();
      $('#requestBackupModal').modal('toggle');
      $('#basicExampleModal').modal('toggle');
      $.ajax({
        url: "ajax/requestBackup.php",
        type: "POST",
        data: { listId: listId },
        success: function (response) {
          $('#backupDetails').html(response);
        }, error: function () {
          swal('Error, Please try again.');
        }
      });
    }
    //  ON ENTER PASSWORD ON BACKUP ---------------------------------------------------------------------------------------
    const backupEnter = () => {
      reqID = $('#recID').val();
      reminder = $('#form_remind').val();
      passwordBackup = $('#passwordBackup').val();
      techID = $('#techID').val();
      // if entered ID is equal to the ID of fixer syntax will proceed
      if (reminder == '') {
        swal('Please input reminder', 'Example: I need DDR4 RAM.');
      }
      else if (passwordBackup === techID) {
        $.ajax({
          url: "ajax/backupSendprocessor.php",
          type: "POST",
          data: {
            reqID: reqID,
            reminder: reminder,
            passwordBackup: passwordBackup,
          },
          success: function (response) {
            swal('Success', 'Backup request successfully sent.', 'success');
            $('#requestBackupModal').modal('toggle');
          },
          error: function () {
            swal('Error, please try again or reload the page.');
          }
        });
      } else {
        swal('Invalid ID');
      }
    }
    // VIEWING BACKUP DETAILS ----------------------------------------------------------------------------------------
    const acceptBack = () => {
      listId = $('#hiddenID').val();
      $('#acceptBackupModal').modal('toggle');
      $('#basicExampleModal').modal('toggle');
      $.ajax({
        url: "ajax/acceptBackupDetails.php",
        type: "GET",
        data: { listId: listId },
        success: function (response) {
          $('#backupdetails').html(response);
        },
        error: function () {
          swal('Error, please try again or press F5.');
        }
      });
    }
    // get backup --------------------------------------------------------------------------------------------------
    const getBackup = () => {
      techID = $('#getBackup').val();
      listID = $('#recordId').val();
      dept = $('#dept').val();
      prevTech = $('#technicianName').val();
      $.ajax({
        url: "ajax/acceptBackupProcessor.php",
        type: "GET",
        data: {
          techID: techID,
          listID: listID,
          dept: dept,
          prevTech: prevTech
        },
        success: function (response) {
          if (response == 'success') {
            $('#acceptBackupModal').modal('toggle');
            swal('Success', 'You successfully accepted the backup request.', 'success');
          } else {
            swal('Failed', 'Invalid ID', 'info');
          }
        },
        error: function () {
          swal('Error, please try again or press F5.');
        }
      });
    }
    const openDowntime = () => {
      window.open("admin/page/generateDowntime.php", "Top 10 Downtime", "width=1000,height=600,left=150");
    }
    // -------------------------------------------------------------------------------------------------------------------------------
    const openAndonLogsProd = () => {
      window.open("admin/page/andonProdLogs.php", "Andon Logs", "width=1000,height=600,left=150");
    }
    // -------------------------------------------------------------------------------------------------------------------------------
    const validate = () => {
      var str = document.getElementById('form_remind').value;
      var res = str.includes('#') || str.includes('.') || str.includes('/') || str.includes('-');
      console.log(res);
      if (res == true) {
        swal('Notification', 'Special characters are not allowed!', 'info');
        document.getElementById('form_remind').value = '';
      }
    }
    // -------------------------------------------------------------------------------------------------------------------------------
    const machineDownTime = () => {
      window.open("admin/page/machineDowntime.php", "Machine Downtime", "width=1000,height=600,left=150");
    }
    // REGISTER QR ---------------------------------------------------------------------------------------------------------------
    const regQR = () => {
      window.open("admin/page/regQrForm.php", "Register QR", "width=1000,height=600,left=150");
    }
    // TRD APPLICATOR REPLACEMENT -----------------------------------------------------------------------------------------------------
    const applicatorLogs = () => {
      window.open("admin/page/applicator_replacement_logs.php", "TRD Applicator REplacement Logs", "width=1000,height=600,left=150");
    }

    const mmtrSummary = () => {
      window.open("admin/page/mmtrSummary.php", "MMTR Summary", "width=1000,height=600,left=150");
    }
    const machineSummary = () => {
      window.open("admin/page/machineSummary.php", "Machine Summary", "width=1000,height=600,left=150");
    }

    // VERIFY JR STAFF

    const verify_operator = (andon_id) => {
      var jr_staff_id = document.getElementById('jr_staff_verification').value;
      var jr_staff_call = document.getElementById('operator_call').value;
      $.ajax({
        url: 'ajax/select.php',
        type: 'GET',
        cache: false,
        data: {
          method: 'verify_jr',
          jr_staff_id: jr_staff_id,
          andon_id: andon_id,
          jr_staff_call: jr_staff_call
        }, success: function (response) {
          // console.log(response);
          if (response == jr_staff_call) {
            // console.log('same');
            $('#jr_remarks').html('Verified &check;');
            $('#jr_remarks').css('color', 'green');
            $('#jr_staff_verification').css('border', '1px solid green');
            $('#endAndonBtn').attr('disabled', false);
            $('#replaceStat').attr('disabled', true);
            $('#app_name').attr('disabled', true);
            $('#app_uniq_num').attr('disabled', true);
            $('#app_work_order_no').attr('disabled', true);
            $('#jr_staff_verification').attr('disabled', true);
          } else {
            // console.log('invalid');
            $('#jr_staff_verification').val('');
            $('#jr_remarks').html('Verify Failed &times;');
            $('#jr_remarks').css('color', 'red');
            $('#jr_staff_verification').css('border', '1px solid red');
            $('#endAndonBtn').attr('disabled', true);
          }
        }
      });

    }

    const enable_part = () => {
      var x = $('#solutionTRD').val();
      if (x == 'trouble') {
        $('#replaceStat').attr('disabled', true);
        $('#app_name').attr('disabled', true);
        $('#app_uniq_num').attr('disabled', true);
        $('#app_work_order_no').attr('disabled', true);
        $('#jr_staff_verification').attr('disabled', false);
      } else {
        $('#replaceStat').attr('disabled', false);
        $('#app_name').attr('disabled', false);
        $('#app_uniq_num').attr('disabled', false);
        $('#app_work_order_no').attr('disabled', false);
        $('#jr_staff_verification').attr('disabled', false);
      }
    }
  </script>
</body>

</html>
<?php $db->close(); ?>