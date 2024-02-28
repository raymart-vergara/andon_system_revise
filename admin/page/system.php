<?php
	require '../processor/session.php';
	// SECURITY PATCH IF THE USER ROLE WAS DETECTED AS NON_ADMIN USER PAGE ACCESS WILL DENIED
	if($dept != 'Administrator'){
		session_unset();
		session_destroy();
		header('location:../index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">	
	<title><?=$dept;?></title>
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
	<style type="text/css">
		center{font-weight:700;font-family: ubuntu;}body::-webkit-scrollbar{width:1em}body::-webkit-scrollbar-track{box-shadow:inset 0 0 6px rgba(0,0,0,.3)}body::-webkit-scrollbar-thumb{background-color:#a9a9a9}div::-webkit-scrollbar{width:5px}div::-webkit-scrollbar-track{box-shadow:inset 0 0 6px rgba(0,0,0,.3)}div::-webkit-scrollbar-thumb{background-color:#a9a9a9}tbody tr:hover{background-color:#dbdad7}.spinner{width:40px;height:40px;margin:100px auto;background-color:#333;border-radius:100%;-webkit-animation:sk-scaleout 1s infinite ease-in-out;animation:sk-scaleout 1s infinite ease-in-out}@-webkit-keyframes sk-scaleout{0%{-webkit-transform:scale(0)}100%{-webkit-transform:scale(1);opacity:0}}@keyframes sk-scaleout{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}

    body{
      font-family: arial;
    }
    button{
	  font-family: arial;
    }
    select {
	  font-family: arial;
	  border-radius:20px;
    }

	</style>
</head>
<body>
<!-- ---------------------------------------------------------------------------------------------------------------------- -->
<?php 
	include '../Modal/logoutMenu.php';
	include '../Modal/addMachine.php';
	include '../Modal/addMachineNo.php';
	include '../Modal/addCarMaker.php';
	include '../Modal/addLineModal.php';
	include '../Modal/addProcess.php';
	include '../Modal/activity_logs.php';
	include '../Modal/dataBackup.php';
?>
<!-- ----------------------------------------------------------------------------------------------------------------------- -->
	<!-- SIDENAV TRIGGER -->
	<div class="nav-wrapper navbar-fixed" style="padding:10px;">
		<button class="sidenav-trigger btn white grey-text z-depth-5" data-target="slide-out" style="font-weight:bold;">menu</button>
		<!-- <span class="right">SYSTEM ADMINISTRATOR</span> -->
		<h6 class="header right"><?=$name;?> (SYSTEM ADMINISTRATOR)</h6>
	</div>
<!-- ----------------------------------------------------------------------------------------------------------------------- -->
<br>
	<!-- SIDENAV -->
	<ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background">
        <img src="../Img/andono.png" class="responsive-img">
      </div>
      <br>
      <a href="#user"><img class="circle z-depth-4" src="../Img/technician.svg"></a>
      <span class="black-text name"><?=$name;?></span>
      <span class="black-text email"><?=$dept;?></span>
    </div></li>
    <li><div class="divider"></div></li>
    <li><a href="#" onclick="loadDowntime()">Top 10 Downtime</a></li>
    <li><a href="#" data-target="activityLogsModal" class="modal-trigger" onclick="loadLogs()">Activity Logs</a></li>
    <li><a href="#" onclick="loadAndonLogs()">Andon Logs</a></li>
    <li><a href="#" data-target="modalDataBackup" class="modal-trigger" id="backupLink">Backup Data</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Others</a></li>
    <li><a class="waves-effect modal-trigger" href="#logoutModal">Sign Out</a></li>
  </ul>
<!-- ----------------------------------------------------------------------------------------------------------------------- -->
  	<div class="row">
		<div class="col s12">
			<div class="input-field col s3 right">
				<select name="" id="view_option_value" class="browser-default z-depth-5" onchange="select_view()">
					<option value="">Statistics</option>
					<option value="machine_name_view">Machine Name</option>
					<option value="machine_no_view">Machine Numbers</option>
					<option value="carmaker_view">Carmakers</option>
					<option value="prod_line_view">Production Lines</option>
					<option value="machine_prob_view">Machine Problems</option>
					<option value="machine_solution_view">Machine Solutions</option>
					<option value="machine_process_view">Machine Process</option>
					<option value="account_view">Accounts</option>
				</select>
			</div>
		</div>  
	</div>
	<div class="row">
		<div id="content" class="z-depth-5"></div>
	</div>
	<!-- JAVASCRIPT AND JQUERY PLUGINS -->
	<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
	<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
	<script src="../node_modules/chart.js/dist/Chart.js"></script>
    <!-- LOCAL JS -->
    <script type="text/javascript">
window.onload = function () {
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
    	$(document).ready(function(){
    		$('.sidenav').sidenav();
    		$('.modal').modal({
    			inDuration: 600,
    			outDuration: 600
    		});
    		$('.datepicker').datepicker();
			$('select').formSelect();
    		// FUNCTIONS
			select_view();
    	});
// ------VIEWER OPTION ---------------------------------------------------------------------------------------------
const select_view =()=>{
			var view_opt = document.getElementById('view_option_value').value;
			if(view_opt == ''){
				$('#content').load('../Form/landing_view.php');
			} if(view_opt == 'machine_name_view'){
				$('#content').load('../Form/machineMgmt.php');
			} if(view_opt == 'machine_no_view'){
				$('#content').load('../Form/machineNumMgt.php');
			} if(view_opt == 'carmaker_view'){
				$('#content').load('../Form/carmakerMgt.php');
			} if(view_opt == 'prod_line_view'){
				$('#content').load('../Form/lineMgt.php');
			} if(view_opt == 'machine_prob_view'){
				$('#content').load('../Form/machineProbMgt.php');
			}if(view_opt == 'machine_solution_view'){
				$('#content').load('../Form/machineSolutionMgt.php');
			}if(view_opt == 'machine_process_view'){
				$('#content').load('../Form/machineProcessMgt.php');
			}if(view_opt == 'account_view'){
				$('#content').load('../Form/accountMgt.php');
			}
		}
// MACHINE CONTROLLER
const load_machine =()=>{
		dept = $('#machineFilter').val();
		$.ajax({
			url:'../processor/adminController.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'filterMachine',
				dept:dept
			},success:function(response){
				$('#machine_list').html(response);
			}
		});
	}
const load_machine_form =()=>{
		$('#addMachineForm').load('../Form/addMachineform.php');
	}
const btnSaveMachine =()=>{
		categ = $('#machineCateg').val();
		dept = $('#machineDept').val();
		name = $('#machineName').val();
		if(categ == ''){
			swal('Warning','Please specify the machine category.','info');
		}else if(dept == ''){
			swal('Warning','Please specify the machine department.','info');
		}else if(name == ''){
			swal('Warning','Please specify the machine name.','info');
		}else{
			$('#btnMachine').attr('disabled',true);
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'AddMachine',
					categ:categ,
					dept:dept,
					name:name,
					initiator: '<?=$name;?>'
				},success:function(response){
					if(response == 'success'){
						swal('Success','','success');
						load_machine();
						$('#btnMachine').attr('disabled',false);
						$('#machineCateg').prop('selectedIndex',0);
						$('#machineDept').prop('selectedIndex',0);
						$('#machineName').val('');
					}else{
						swal('Error','Error when saving..','error');
						$('#btnMachine').attr('disabled',false);
					}
				},error:function(){
					// TANGINAKA
				}
			});
		}
	}
const getMachine =(listId)=>{
		var x =  confirm('To confirm delete, please click "OK"');
		if(x == true){
			// DELETE MACHINE VIA ID + AJAX
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data: {
					method: 'delMachine',
					name: '<?=$name;?>',
					id:listId
				},success:function(response){
					if(response == 'success'){
						swal('Success','Deleted!','success');
						load_machine();
					}else{
						swal('Error','Failed!','error');
					}
				},error:function(){

				}
			});
		}else{
			// DO NOTHING
		}
	}
	

// MACHINE NUMBER CONTROLLER
const load_machine_num =()=>{
	var machine = $('#machineNumFilter').val();
	$.ajax({
		url: '../processor/adminController.php',
		type: 'POST',
		cache: false,
		data:{
			method:'filtermachinenum',
			machine:machine
		},success:function(response){
			$('#machine_num_list').html(response);
		}
	});
}
const getmcNum =(listId)=>{
		// alert(listId);
		var x = confirm('To confirm delete, please click "OK"');
		if(x == true){
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'delMCNum',
					name: '<?=$name;?>',
					id:listId
				},success:function(response){
					if(response == 'success'){
						swal('Success','Deleted!','success');
						load_machine_num();
					}else{
						swal('Error','Failed!','error');
					}
				}
			});
		}
	}
const load_machine_num_form =()=>{
	$('#addMachineNoForm').load('../Form/addMachineNoForm.php');
}
const loadMachineforSelect =()=>{
		dept = $('#deptMN').val();
		$.ajax({
			url: '../processor/adminController.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'selectMachine',
				dept:dept
			},success:function(response){
				$('#MachineMN').html(response);
			},error:function(){
				// DO NOTHING
			}
		});
	}
const saveMachineNumber =()=>{
		dept = $('#deptMN').val();
		machine = $('#MachineMN').val();
		machineNo = $('#machineNum').val();
		if(dept == ''){
			swal('Error','Please select department','info');
		}else if(machine == ''){
			swal('Error','Please select machine','info');
		}else if(machineNo == ''){
			swal('Error','Please enter machine number','info');
		}else if(machineNo == 0){
			swal('Error','Machine number must not be 0','info');
		}else if(machineNo < 0){
			swal('Error','Machine number must not less than 0','info');
		}else{
			$('#saveMachineNumber').attr('disabled',true);
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'saveMachineNo',
					dept:dept,
					machine:machine,
					machineNo:machineNo,
					initiator: '<?=$name;?>'
				},success:function(response){
					if(response == 'success'){
						load_machine_num();
						swal('Success','Machine number registered!','success');
						$('#saveMachineNumber').attr('disabled',false);
						// CLEAR FIELDS
						// $('#deptMN').prop('selectedIndex',0);
						// $('#MachineMN').prop('selectedIndex',0);
						 $('#machineNum').val('');
						}else{
						swal('Error','Machine number failed to register!','error');
						$('#saveMachineNumber').attr('disabled',false);
					}
				},error:function(){
					// DO NOTHING
				}
			});
		}
	}

// CARMAKER CONTROLLER
const load_carmaker =()=>{
	$.ajax({
		url: '../processor/adminController.php',
		type: 'POST',
		cache: false,
		data:{
			method: 'filterCarmaker'
		},success:function(response){
			$('#carmaker_list').html(response);
		}
	});
}
const loadCarmakerform =()=>{
	$('#carmakerForm').load('../Form/addCarmakerForm.php');
}
const regCarMaker =()=>{
		carmaker = $('#carmaker').val();
		$('#regCarmakerbtn').attr('disabled',true);
		if(carmaker == ''){
			swal('Error','Please enter car maker','error');
			$('#regCarmakerbtn').attr('disabled',false);
		}else{
			$.ajax({
			url: '../processor/adminController.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'regCarmaker',
				carmaker:carmaker,
				initiator: '<?=$name;?>'
			},success:function(response){
				// console.log(response);
				if(response == 'success'){
					$('#regCarmakerbtn').attr('disabled',false);
					swal('Success!','Carmaker registered successfully!','success');
					load_carmaker();
				}else{
					$('#regCarmakerbtn').attr('disabled',false);
					swal(':(','Registration Failed!','error');
				}
			},error:function(){
				// DO NOTHING
				$('#regCarmakerbtn').attr('disabled',false);
			}
		});
		}
	}
const getCarmaker =(listId)=>{
		var x = confirm('To confirm delete, Please click "OK"');
		if(x == true){
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'delCarmaker',
					id:listId,
					name: '<?=$name;?>'
				},success:function(response){
					if(response == 'success'){
						swal('Success','Deleted!','success');
						load_carmaker();
					}else{
						swal('Error','Failed!','error');
					}
				}
			});
		}else{
			// DO NOTHING
		}
	}


// LINE MGT CONTROLLER
const filterLine =()=>{
	var line_opt = $('#line_option').val();
	$.ajax({
		url: '../processor/adminController.php',
		type: 'POST',
		cache: false,
		data:{
			method:'filterLine',
			maker:line_opt
		},success:function(response){
			$('#line_data').html(response);
		}
	});
}
const loadAddLine =()=>{
	$('#addLineForm').load('../Form/addLineForm.php');
}
const registerLine =()=>{
		category = $("#categProd").val();
		carmaker = $('#carMakerSelect').val();
		line = $('#lineNumber').val();
		if(category == ''){
			swal('Warning','Please select category!','info');
		}else if(carmaker == ''){
			swal('Warning','Please select carmaker!','info');
		}else if(line == ''){
			swal('Warning','Please enter the line number!','info');
		}else{
			$('#regLineBtn').attr('disabled',true);
			// INITIATE AJAX FUNCTION
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache:  false,
				data:{
					method:'registerLine',
					category:category,
					carmaker:carmaker,
					line:line,
					name:'<?=$name;?>'
				},success:function(response){
					$('#regLineBtn').attr('disabled',false);
					filterLine();
					swal('Notification',response,'info');
					// CLEAR
					$("#categProd").prop('selectedIndex',0);
					$('#carMakerSelect').prop('selectedIndex',0);
					$('#lineNumber').val('');
				},error:function(){
					// DO NOTHING
				}
			});
		}
	}
const getLine =(listId)=>{
		var x = confirm('To confirm delete, Please click "OK"');
		if(x == true){
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'delLine',
					id:listId,
					name: '<?=$name;?>'
				},success:function(response){
					if(response == 'success'){
						swal('Success','Deleted!','success');
						filterLine();
					}else{
						swal('Error','Failed!','error');
					}
				},error:function(){

				}
			});
		}else{
			// DO NOTHING
		}
	}

// MACHINE PROBLEM CONTROLLER
const filterProblem =()=>{
	var machine_opt = $('#filter_machine').val();
	$.ajax({
		url: '../processor/adminController.php',
		type: 'POST',
		cache:false,
		data:{
			method: 'filterProblem',
			machineName:machine_opt
		},success:function(response){
			$('#problem_list').html(response);
		}
	});
}

const getProblem =(listId)=>{
		x = confirm('To confirm delete, Please click "OK"');
		if(x == true){
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'delProblem',
					name: '<?=$name;?>',
					id:listId
				},success:function(response){
					if(response == 'success'){
						swal('Success','Deleted!','success');
						filterProblem();
					}else{
						swal('Error','Failed!','error');
					}
				},error:function(){
					// DO NOTHING
				}
			});
		}else{
			// DO NOTHING
		}
	}

// MACHINE SOLUTION CONTROLLER
const getSolution =(listId)=>{
		x = confirm('To confirm delete, Please click "OK"');
		if(x == true){
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'delSolution',
					name: '<?=$name;?>',
					id:listId
				},success:function(response){
					if(response == 'success'){
						swal('Success','Deleted!','success');
						filterSolution();
					}else{
						swal('Error','Failed!','error');
					}
				},error:function(){
					// DO NOTHING
				}
			});
		}else{
			// DO NOTHING
		}
	}
const filterSolution =()=>{
		filter_machine = $('#filter_machine').val();
		$.ajax({
			url: '../processor/adminController.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'filterSolution',
				filter_machine:filter_machine
			},success:function(response){
				// console.log(response);
				$('#solution_list').html(response);
			}
		});
	}


// MACHINE PROCESS
const filterProcess =()=>{
		filter = $('#filter_machine').val();
		$.ajax({
			url: '../processor/adminController.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'filterProcess',
				filter:filter
			},success:function(response){
				// console.log(response);
				$('#process_list').html(response);
			}
		});
	}
const loadMachineforSelectofProcess =()=>{
		dept = $('#departmentProcess').val();
		$.ajax({
			url: '../processor/adminController.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'loadSelectMachinename',
				dept:dept
			},success:function(response){
				$('#processMachine').html(response);
			},error:function(){

			}
		});
	}
const registerProcess =()=>{
		dept = $('#departmentProcess').val();
		machine = $('#processMachine').val();
		processTxt = $('#processTxt').val();
		// RESTRICTION
		if(dept == ''){
			swal('Warning','Please select department!','info');
		}else if(machine == ''){
			swal('Warning','Please select machine!','info');
		}else if(processTxt == ''){
			swal('Warning','Please enter process!','info');
		}else{
			// AJAX
			$('#regProcessBtn').attr('disabled',true);
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'regProcess',
					dept:dept,
					machine:machine,
					processTxt:processTxt,
					name: '<?=$name;?>'
				},success:function(response){
					console.log(response);
					if(response == 'success'){
						swal('Success','Registered!','success');
						$('#regProcessBtn').attr('disabled',false);
						filterProcess();
					}else{
						swal('Warning','Failed!','error');
						$('#regProcessBtn').attr('disabled',false);
					}
				},error:function(){

				}
			});
		}
	}
const loadProcessForm =()=>{
		$('#addProcessForm').load('../Form/addProcessForm.php');
	}
const getProcess =(listId)=>{
		x = confirm('To confirm delete, Please click "OK"');
		if(x == true){
			$.ajax({
				url: '../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'delProcess',
					name: '<?=$name;?>',
					id:listId
				},success:function(response){
					if(response == 'success'){
						swal('Success','Deleted!','success');
						filterProcess();
					}else{
						swal('Error','Failed!','error');
					}
				},error:function(){
					// DO NOTHING
				}
			});
		}else{
			// DO NOTHING
		}
	}

// ACCOUNT CONTROLLER
const filterAccount =()=>{
		var filter_carmaker = document.querySelector('#filter_carmaker').value;
		var filter_prod = document.querySelector('#filter_production').value;
		var filter_rank = document.querySelector('#filter_rank').value;
		$('#generateAcctbtn').attr('disabled',true);
		$.ajax({
			url: '../processor/adminController.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'filterAccount',
				filter_carmaker:filter_carmaker,
				filter_prod:filter_prod,
				filter_rank:filter_rank
			},success:function(response){
				$('#generateAcctbtn').attr('disabled',false);
				document.getElementById('account_list').innerHTML =response;
			}
		});
	}
// -----------------------------------------------------------------------------------------------------------------------
const loadDowntime =()=>{
		window.open("generateDowntime.php","Top 10 Downtime","width=1000,height=600,left=150");
	}
// -----------------------------------------------------------------------------------------------------------------------------
const loadAndonLogs =()=>{
		window.open("andonLogsAdmin.php?dept=<?=$dept;?>","Top 10 Downtime","width=1000,height=600,left=150");
	}
// -------------------------------------------------------------------------------------------------------------------------
const loadLogs =()=>{
		$('#activityLogsForm').load('../Form/viewLogsAdmin.php');
	}
// ACTIVITY LOG -----------------------------------------------------------------------------------------------------------
const viewActivityLog =()=>{
		dateLog = $('#dateLog').val();
		// alert(dateLog);
		$.ajax({
			url: '../processor/adminController.php',
			type: 'POST',
			cache: false,
			data: {
				method: 'fetchLogs',
				dateLog:dateLog,
			},success:function(response){
				$('#activityLogs').html(response);
			},error:function(){

			}
		});
	}
// LOAD BACKUP HISTORY
$('#backupLink').click(function(){
		$('#backupForm').load('../Form/backupDataForm.php');
		    // loadBackupLogs();
	});
	// LOAD BACKUP LOGS
const loadBackupLogs =()=>{
		$.ajax({
			url: '../processor/adminController.php',
			type: 'POST',
			cache:false,
			data:{
				method:'loadLatestBackup'
			},success:function(response){
				$('#backupLogsData').html(response);
			}
		});
	}
  // REFRESH LOGS
const refreshLogs =()=>{
    loadBackupLogs();
  }
	// BACKUP START
const backupStartBtn =()=>{
		from_date = $('#dataBackupFrom').val();
		to_date = $('#dataBackupTo').val();
		if(from_date == ''){
			swal('Attention!','Please select appropriate date range.','info');
		}else if(to_date == ''){
			swal('Attention!','Please select appropriate date range.','info');
		}else if(from_date > to_date){
			swal('Attention!','Please select appropriate date range.','info');
		}else{
			$("#backupStartBtn").attr('disabled',true);
			$('#spinner').addClass("spinner");
			$('#notif').html("<center>Backuping...</center>");
			$.ajax({
				url:'../processor/adminController.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'backupDatabase',
					from_date:from_date,
					to_date:to_date,
					name: '<?=$name;?>'
				},success:function(response){
					console.log(response);
					if(response == 'success'){
						$('#backupStartBtn').attr('disabled',false);
						$('#spinner').removeClass("spinner");
						$('#notif').html("<center class='green-text'>Done</center>");
						loadBackupLogs();
					}else if(response == 'exists'){
						$('#backupStartBtn').attr('disabled',false);
						$('#spinner').removeClass("spinner");
						$('#notif').html("<center class='red-text'>Exists</center>");
					}else{
						$('#backupStartBtn').attr('disabled',false);
						$('#spinner').removeClass("spinner");
						$('#notif').html("<center class='red-text'>Failed</center>");
					}
				}
			});
		}
	}

	function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;
    csvFile = new Blob([csv], {type: "text/csv"});
    downloadLink = document.createElement("a");
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
}
function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("#tblLogs tr");
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        csv.push(row.join(","));        
    }
    // DOWNLOAD CSV FILE
    downloadCSV(csv.join("\n"), filename);
}
	

</script>





</body>
</html>