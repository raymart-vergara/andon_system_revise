<?php
require '../processor/conn.php';
$dept = $_GET['dept'];
$categ = $_GET['categ'];
?>	
<!DOCTYPE html>
<html>
<head>
	<title><?=$dept;?> - <?=ucwords($categ);?></title>
	<link rel="icon" type="image/png" href="../../img/ANDON ICON.png">
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
	<style type="text/css">
		thead{font-size:18px}td{font-size:18px}table{zoom:80%}
		body{
			font-family:arial;
		}
		/* BODY SCROLLBAR */
		body::-webkit-scrollbar {
		width: 0.8em;
		}
		table{
			zoom:60%;
		}
		body::-webkit-scrollbar-track {
		box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		
		body::-webkit-scrollbar-thumb {
		background-color: darkgrey;
		}
		/* TABLE SCROLLBAR */
		div::-webkit-scrollbar {
		width: 0.4em;
		}
		
		div::-webkit-scrollbar-track {
		box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		
		div::-webkit-scrollbar-thumb {
		background-color: darkgrey;
		}
	</style>
</head>
<body>
	<h6 class="center">ANDON MONITORING</h6>
	<!-- AUDIO ALARM -->
	<audio id="alarm" src="../../audio/drums.wav"></audio>
	<!-- MAIN UI -->
	<main>
		<!-- TABLE 1 -->
		<div class="row">
			<div class="row col s12">
				<span style="color:red;">PENDING ANDON</span>&nbsp;DEPARTMENT: <?=$dept;?> - <?=$categ;?>
				<span id="realtime"></span>
			</div>
			<div class="row">
			<!-- HIDDEN ID RENDERER -->
			<input type="hidden" name="" id="renderer">
			<!-- IDENTIFIER -->
			<input type="hidden" id ="identify" name="">
			<!-- TABLES -->
				<div class="col s12"  style="height:270px;overflow: auto;">
					<table class="responsive-table">
					<thead>
						<th>Line</th>
						<th>Machine Name</th>
						<th>Process</th>
						<th>Machine No.</th>
						<th>Problem</th>
						<th>Time Reported</th>
						<th>Reported By</th>
						<th>Confirm By</th>
					</thead>
					<tbody id="request"></tbody>
				</table>
				</div>
			</div>
		</div>
		<hr>
		<!-- TABLE 2 -->
		<div class="row">
			<div class="row col s12"><span style="color:red;">ONGOING ANDON</span>&nbsp;DEPARTMENT: <?=$dept;?> - <?=$categ;?></div>
			<div class="row">
				<div class="col s12"  style="height:270px;overflow: auto;">
					<table class="responsive-table " >
					<thead>
						<th>Line Name/Line No.</th>
						<th>Problem</th>
						<th>Date/Time Reported</th>
						<th>Reported By</th>
						<th>Confirm By</th>
						<th>Start Fixing Time</th>
						<th>Backup Remarks</th>
						<th>Backup Request Time</th>
					</thead>
					<tbody id="confirmed"></tbody>
				</table>
				</div>
				
			</div>
		</div>
	</main>

	<?php 
	// INCLUDED MODAL
	include '../Modal/confirmAndon.php';
	include '../Modal/modalOngoingMenu.php';
	include '../Modal/modalProblem.php';
	include '../Modal/addOperator.php';
	include '../Modal/modalSolution.php';
	include '../Modal/modalSearchOpt.php';
	include '../Modal/modalEditOperator.php';
	include '../Modal/qr_request_list_modal.php';
	include '../Modal/qr_menu.php';
	?>
 	<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
	<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
	<script type="text/javascript">
		setTimeout(reload,7200000);
		function reload(){
			location.reload();
		};


		window.onload=function(){function e(e){return e.stopPropagation?e.stopPropagation():window.event&&(window.event.cancelBubble=!0),e.preventDefault(),!1}document.addEventListener("contextmenu",function(e){e.preventDefault()},!1),document.addEventListener("keydown",function(t){t.ctrlKey&&t.shiftKey&&73==t.keyCode&&e(t),t.ctrlKey&&t.shiftKey&&74==t.keyCode&&e(t),83==t.keyCode&&(navigator.platform.match("Mac")?t.metaKey:t.ctrlKey)&&e(t),t.ctrlKey&&85==t.keyCode&&e(t),123==event.keyCode&&e(t)},!1)};
       // -------------------------------------------------------------------------------------------------------------------
$(document).ready(function(){$(".sidenav").sidenav(),$(".dropdown-trigger").dropdown({alignment:"left",constrainWidth:!1,inDuration:200,outDuration:200}),$(".modal").modal({inDuration:600,outDuration:600}),$("select").formSelect(),M.updateTextFields()});
// SHOW MACHINE PROB MODAL
const showProblem =()=>{$('#machineProbForm').load('../Form/machineProbForm.php');}
$(document).ready(function(){
// TIMEOUT FOR REALTIME FETCH OF PENDING ANDON
setTimeout(loadPending, 3000);
setTimeout(loadOngoing, 6000);
setTimeout(counter,2000);
setTimeout(backupCounter,2000);
setTimeout(count_registration_request,15000);
// FUNCTION FOR FETCHING PENDING ANDON
function loadPending(){
	var concernDept = '<?=$dept;?>';
	var categ = '<?=$categ;?>';
	var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var response = this.responseText;
				document.getElementById('request').innerHTML = response;
				// LOOP BACK THE TIMEOUT TO AVOID END TIME OF FETCH
				setTimeout(loadPending,20000);
			}
		};
		xhttp.open("GET","../processor/process.php?process=fetchPending&&concern="+concernDept+"&&categ="+categ,true);
		xhttp.setRequestHeader('Cache-Control', 'no-cache');
		xhttp.send();
	}
		// FUNCTION FOR FETCHING ONGOING ANDON
		function loadOngoing(){
			var concernDept = '<?=$dept;?>';
			var category = '<?=$categ;?>';
			var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						var response = this.responseText;
						$('#confirmed').html(response);
						// LOOP BACK THE TIMEOUT TO AVOID END TIME OF FETCH
						setTimeout(loadOngoing,20000);
					}
				};
				xhttp.open("GET","../processor/process.php?process=fetchOngoing&&concern="+concernDept+"&&category="+category,true);
				xhttp.setRequestHeader("Cache-Control", "no-cache, no-store, must-revalidate");
				xhttp.send();
			}
			// ANDON COUNTER
function counter(){
var rowCount = $('#request > tr').length;
console.log(rowCount);
setTimeout(counter,10000);
if(rowCount > 0){
	alarm();
	}else{
		// DO NOTHING
	}
}
// PLAY AUDIO
function alarm(){
// SET TIMEOUT FOR THE AUDIO TO AVOID AUDIO OVER
setTimeout(() =>{
	document.querySelector('#alarm').play();
	},400);
}
});
			// CLICK PENDING GET ID
		function clickRequest(listId){
				$('#renderer').val(listId);
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						var response = this.responseText;
						$('#AndonDetails').html(response);
					}
				};
				xhttp.open("GET","../processor/modifier.php?method=viewPending&&andonID="+listId,true);
				xhttp.send();
			}
		// CLICK ONGOING ID
		function clickOngoing(listId){
				$('#renderer').val(listId);
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						var response = this.responseText;
						$('#ongoingDetails').html(response);
					}
				};
				xhttp.open("GET","../processor/modifier.php?method=viewOngoing&&andonID="+listId,true);
				xhttp.send();
			}

		function confirmAndon(){
			// VARIABLE NEEDED
			confirmID = $('#confirmID').val();
			andonID = $('#renderer').val();
			department = '<?=$dept;?>';
			// console.log(confirmID);
			// console.log(andonID);
			document.querySelector("#confirmID").disabled = true;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						var response = this.responseText;
						// console.log(response);
						// Notice
						swal('',response,'info');
						$('.modal').modal('close','#modalConfirmAndon');
						document.querySelector("#confirmID").value;
						document.querySelector("#confirmID").disabled = false;
					}
				};
				xhttp.open("GET","../processor/modifier.php?method=confirmAndon&&andonID="+andonID+"&&technicianID="+confirmID+"&&department="+department,true);
				xhttp.send();
		}

		const acceptBackup =()=>{
			andonID = $('#renderer').val();
			techID = $('#backupAcceptTech').val();
			dept = '<?=$dept;?>';
			// AJAX
			$.ajax({
				url: "../processor/modifier.php",
				type: "GET",
				data: {
					method: 'acceptBackup',
					andonID:andonID,
					techID:techID,
					dept:dept
				},success:function(response){
					$('.modal').modal('close','#modalOngoingMenu');
					swal('',response,'info');

				},error:function(){

				}
			});
		}
		// BACKUP REQUEST COUNTER
		const backupCounter =()=>{
			$.ajax({
				url: '../processor/backupCounter.php',
				type: 'GET',
				data:{
					method: 'countBackup',
					dept: '<?=$dept;?>'
				},success:function(response){
					if(response == 'alert'){
						// document.querySelector("#identify").value = response;
						// SOUND PLAY
						setTimeout(() =>{
						document.querySelector('#alarm').play();
						},400);
					}else{

					}
					// LOOP BACK SET TIME OUT FOR REALTIME
					setTimeout(backupCounter,5000);
				},error:function(){
				}
			});
		}
		
		// LOAD FORM ON CLICK MODAL
		const showOperator =()=>{
			$('#controlOperator').load('../processor/addOperatorControl.php');
		}
		// Register OPERATOR
		const funcAddOperator =()=>{
			Fname = $('#fname')	.val();
			Lname = $('#lname').val();
			carmaker = $('#carMaker').val();
			category = $('#category').val();
			account_type = $('#acct_type').val();
			operatorID = $('#idNumber').val();
			techID = $('#techid').val();
			if(Fname === ''){
				swal('Warning','First name is required!','info');
			}else if(Lname === ''){
				swal('Warning','Last name is required!','info');
			}else if(carmaker === ''){
				swal('Warning','Car Maker IS required!','info');
			}else if(category === ''){
				swal('Warning','Category is required!','info');
			}else if(account_type == ''){
				swal('Warning','Account type required!','info');
			}
			else if(operatorID === ''){
				swal('Warning','Operator'+"'"+'s ID is required.','info');
			}else{
				$.ajax({
					url: "../processor/modifier.php",
					type: "GET",
					cache: false,
					data:{
						method: 'regOperator',
						Fname:Fname,
						Lname:Lname,
						carmaker:carmaker,
						category:category,
						account_type:account_type,
						operatorID:operatorID,
						techID:techID
					},success:function(response){
						swal('Alert',response,'info');
						$('.modal').modal('close','#modalAddOperator');
					}
				});
			}
		}
		// ADD MACHINE PROBLEM
		const addProblem =()=>{
			dept = '<?=$dept;?>';
			machine = $('#machine').val();
			prob = $('#problem').val();
			if(machine === ''){
				swal('Error','Please choose machine name!','error');
			}else if(prob === ''){
				swal('Error','Please input the problem you have encountered!','error');
			}else{
				// DISABLED BUTTON FOR AVOIDING DOUBLE ENTRY
				$('#addProblemBtn').attr('disabled',true);
				// AJAX
				$.ajax({
					url: '../processor/modifier.php',
					type: 'GET',
					cache:false,
					data:{
						method: 'addProb',
						dept:dept,
						machine:machine,
						prob:prob
					},success:function(response){
						$('#addProblemBtn').attr('disabled',false);
						swal('Notification',response,'info');
						$('#problem').val('');
					},error:function(){
					}
				});
			}
		}

		// ADD SOLUTION
		const addSolution =()=>{
			dept = '<?=$dept;?>'; 
			machine = $('#machineName').val();
			solution = $('#solution').val();
			// IF EMPTY
			if(machine === ''){
				swal('Error','Please choose machine name!','error');
			}else if(solution === ''){
				swal('Error','Please input solution!','error');
			}else{
				// DISABLED BUTTON AVOIDING DOUBLE ENTRY
				$('#addSolutionBtn').attr('disabled',true);
				// AJAX
				$.ajax({
					url: '../processor/modifier.php',
					type: 'GET',
					cache:false,
					data:{
						method:'addSolution',
						dept:dept,
						machine:machine,
						solution:solution
					},success:function(response){
						$('#addSolutionBtn').attr('disabled',false);
						swal('Notification',response,'info');
						$('#solution').val('');
					}
				});
			}
		}
		// VIEW LOGS
		const viewLogs =()=>{
			window.open("Logs.php?dept=<?=$dept?>","Andon Logs","width=1000,height=600,left=150");
		}
		// MANAGE TECHNICIAN
		const manageTechnician =()=>{
			window.open("manageTech.php?dept=<?=$dept;?>","Manage Technician","width=1000,height=600,left=150");
		}
		// OPENDOWNTIME
		const openDowntime =()=>{
			window.open("generateDowntime.php","Top 10 Downtime","width=1000,height=600,left=150");
		}
		// OPEN CANCELLED ANDON
		const openCancelAndon =()=>{
			window.open("cancelledAndon.php?dept=<?=$dept;?>","Top 10 Downtime","width=1000,height=600,left=150");
		}
		// SHOW SEARCH MODAL FORM -----------------------------------------------------------------------------------------------------------------------
		const showSearchOpt =()=>{
			$('#searchOptForm').load('../Form/searchOptForm.php');
		}
		// SEARCH 
		const searchOperator =()=>{
			idnumber = $('#searchIDNumber').val();
				$.ajax({
					url: '../processor/modifier.php',
					type: 'GET',
					cache: false,
					data: {
						method: 'SearchOperator',
						idnumber:idnumber
					},success:function(response){
						$('#OperatorResults').html(response);
					},error:function(){
						// DO NOTHING
					}
				});
			}
		// GET DELETE ACCT ----------------------------------------------------------------------------------------------------------
const deleteOperator =(listId)=>{
var x =  confirm("Please press OK to DELETE");
if(x == true){
	$.ajax({
	url: '../processor/modifier.php',
	type: 'GET',
	cache: false,
	data:{
		id:listId,
		method:'deleteOperator'
		},success:function(response){
		swal('Notification',response,'info');
		searchOperator();
	},error:function(){
// DO NOTHING
	}
});
}else{
	// DO NOTHING
}
}
// COUNT QR REQUEST 
const count_registration_request =()=>{
var dept = '<?=$dept;?>';
$.ajax({
url:'../processor/count_request.php',
type:'POST',
cache: false,
data:{
	dept:dept
},success:function(response){
	if(response == 'stop'){
	// DO NOTHING
	}else{
	$('#badge_handler').html(response);
	setTimeout(count_registration_request,15000);
	}
}
});
}

const load_qr_form =()=>{
	$('#qr_list_form').load('../Form/qr_list_form.php');
	load_qr_request();
}

const load_qr_request =()=>{
	$.ajax({
		url:'../processor/request_qr.php',
		type: 'POST',
		cache: false,
		data:{
			method: 'view_request'
		},success:function(response){
			document.getElementById('qr_pending_req').innerHTML = response;
		}
	});
}

const get_req_qr_id =(id)=>{
document.querySelector('#reference').value = id;
}

const approve_qr =()=>{
	var qrID = document.getElementById('reference').value;
	$.ajax({
		url: '../processor/request_qr.php',
		type: 'POST',
		cache: false,
		data:{
			method: 'approve',
			qrID:qrID
		},success:function(response){
			if(response == 'denied'){
				swal('Alert!','This user has already have an account, please verify first.','info');
			}else if(response == 'save'){
				swal('Success!','You have successfully approve this user.','success');
				load_qr_request();
				$('.modal').modal('close','#modalMenuQR');
			}else{
				swal('Error!','An error has occured, please try again!','error');
			}
		}
	});
}

const decline_qr =()=>{
	var x = confirm('Confirm decline process...');
	if(x == true){
		var id_decline = document.getElementById('reference').value;
		$.ajax({
			url:'../processor/request_qr.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'decline',
				id_decline:id_decline
			},success:function(response){
				console.log(response);
				if(response == 'success'){
					load_qr_request();
					swal('Notification','You successfully declined a request!','success');
				}else{

				}
			}
		});
	}else{
		M.toast({html: 'Cancelled!'});
	}
}
</script>
</body>
</html>

<?php $conn=null;?>