<?php
 require '../processor/session.php';if(isset($_GET['dept'])){$dept=$_GET['dept'];if($dept!='IT'){exit('Unauthorized Access Detected!');}}else{session_unset();session_destroy();}if($dept=='IT'){$datenow=date('Y-m-d H:i:s');}else{echo '<script>window.close()</script>';}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manage Technician</title>
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
	<style>
	body{
		font-family: arial;
	}
    select,input,button,table{
	  border-radius:20px;
    }
	</style>
</head>
<body>
	<!-- REFERENCE -->
	<input type="hidden" name="" id="refNo">
	<!--  -->
	<div class="row">
		<div class="col s12">
			<div class="input-field col s4">
				<input type="text" name="" id="keyword"><label>Search Technician Name</label>
			</div>
			<!-- DEPT FILTER -->
			<div class="input-field col s4">
				<select class="browser-default z-depth-3" id="filterDept">
					<option value="">--All Department--</option>
					<?php
						include '../processor/conn.php';
						$qry = "SELECT *FROM tbldepartment";
						$stmt = $conn->prepare($qry);
						$stmt->execute();
						$res = $stmt->fetchALL();
							foreach($res as $x){
					?>
						<option value="<?=$x['deptCode']?>"><?=$x['description'];?></option>
					<?php
						}
					?>
				</select>
			</div>
			<!-- SEARCH -->
			<div class="input-field col s2">
				<button class="btn-large blue col s12 z-depth-3" onclick="searchTech()" id="searchBtn" style="border-radius:20px;">Search</button>
			</div>
			<!-- VIEW ALL -->
			<div class="input-field col s2 ">
				<button class="btn-large blue col s12 z-depth-3" onclick="generateAll()" id="genAll" style="border-radius:20px;">Generate All</button>
			</div>
		</div>
	</div>
	<!-- INCLUDE MODAL -->
  <?php  include '../Modal/modalAddtech.php';include '../Modal/viewTech.php';?>
	<div class="row" style="margin-left:1%;">
		<button class="btn green z-depth-3" onclick="exportTableToCSV('technician-masterlist.csv')" disabled id="exportBtn" style="border-radius:20px;">EXPORT RECORDS</button>
		<button class="btn red modal-trigger z-depth-3" data-target="modalAddTech" onclick="loadTechForm()" style="border-radius:20px;">Add technician</button>
	</div>
	<div style="height:460px;overflow: auto;" class="z-depth-3">
		<table id="tblData" class="centered" border="1" style="table-layout: fixed;">
		<thead>
			<th>PASSWORD</th>
			<th>NAME</th>
			<th>DEPARTMENT</th>
			<th>CATEGORY</th>
		</thead>
		<!-- DATA -->
		<tbody id="dataTable"></tbody>
	</table>
	</div>
	<!-- JAVASCRIPT -->
<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
<script type="text/javascript">
    	$(document).ready(function(){
    		$('.modal').modal();
    	});
    	// FILTRATION BY DEPT
    	const searchTech =()=>{
			document.getElementById('searchBtn').disabled = true;
			var deptFil = document.getElementById('filterDept') .value;
			var keyword = document.getElementById('keyword').value;
    		// AJAX
    		$.ajax({
    			url: '../processor/technicianLog.php',
    			type: 'POST',
    			cache: false,
    			data:{
    				method: 'search',
    				deptFil:deptFil,
    				keyword:keyword
    			},success:function(response){
					document.getElementById('dataTable').innerHTML = response;
					document.getElementById('searchBtn').disabled = false;
					document.getElementById('exportBtn').disabled = false;
    			}
    		});
    	}

   	// GENERATE ALL DATA
   	const generateAll =()=>{
	  document.getElementById('genAll').disabled = true;
   		$.ajax({
   			url: '../processor/technicianLog.php',
   			type: 'POST',
   			cache: false,
   			data:{
   				method: 'generateAll',
   			},success:function(response){
				document.getElementById('dataTable').innerHTML = response;
				document.getElementById('genAll').disabled = false;
				document.getElementById('exportBtn').disabled = false;
   			}
   		});
   	}
   // LOAD ADD TECHNICIAN FORM
   const loadTechForm =()=>{
   	$('#addtechForm').load('../Form/addtechform.php');
   }

   // REGISTERING TECHNICIAN
const regTech =()=> {
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var department = document.getElementById('department').value;
	var prod = document.getElementById('production').value;
	var technicianPass = document.getElementById('techPass').value;
	var registerOfficer = document.getElementById('ITpass').value;
   	 if(fname == ''){
   	 	swal('Alert','Please include the first name of the technician.','info');
   	 }else if(lname == ''){
   	 	swal('Alert','Please include the last name of the technician.','info');
   	 }else if(department == ''){
   	 	swal('Alert','Please include the department of the technician.','info');
   	 }else if(prod == ''){
   	 	swal('Alert','Please include the production catergory of the technician.','info');
   	 }else if(technicianPass == ''){
   	 	swal('Alert','Please include the password of the technician.','info');
   	 }else if(registerOfficer == ''){
   	 	swal('Alert','Please scan your ID to register this technician.','info');
   	 }else{
   	 	// START AJAX
   	 	$('#ITpass').attr('disabled',true);
   	 	$.ajax({
   	 		url: '../processor/technicianLog.php',
   	 		type: 'POST',
   	 		cache: false,
   	 		data: {
   	 			method: 'register',
   	 			fname:fname,
   	 			lname:lname,
   	 			department:department,
   	 			prod:prod,
   	 			technicianPass:technicianPass,
   	 			registerOfficer:registerOfficer
   	 		},success:function(response){
   	 			Swal('Notification',response,'info');
   	 			// CLEAR FUNCTION
   	 			$('#ITpass').attr('disabled',false);
   	 			$('#fname').val('');
   	 			$('#lname').val('');
   	 			$('#department')[0].selectedIndex = 0;
   	 			$('#production')[0].selectedIndex = 0;
   	 			$('#techPass').val('');
   	 			$('#ITpass').val('');
   	 		}
   	 	});
   	 }
   }
	//VIEW TECH DETAILS
   const viewTech =(listId)=>{
	   document.getElementById('refNo').value = listId;
   	$.ajax({
   		url: '../processor/technicianLog.php',
   		type: 'POST',
   		cache: false,
   		data:{
   			method: 'viewTech',
   			listId:listId
   		},success:function(response){
   			$('#techDetails').html(response);
   		}
   	});
   }
   	// DELETE
   	const deleteTech =(listId)=>{
   		var r = confirm('Confirm delete. Please press OK');
   		if(r == true){
   			// DELETE TRIGGER
   			$.ajax({
   				url: '../processor/technicianLog.php',
   				type: 'POST',
   				cache:false,
   				data:{
   					method: 'deleteTech',
   					listId:listId
   				},success:function(response){
   					swal(response)
   					.then((value) => {
   						location.reload();
   					});
   				}
   			});
   		}else{
   			// DO NOTHING..
   		}
   }
   // ------------------------------------------------------------------------------------------------------------------------
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
// CHANGE PASS ---------------------- -------------------------
const changePass =(param)=>{
  var string = param.split('~!~');
  var id = string[0];
  var firstname = string[1];
  var lastname = string[2];
  var full_name = firstname+' '+lastname;
  var newPassword = prompt("Enter your new password here","");
  if(newPassword != null){
    $.ajax({
      url: '../processor/technicianLog.php',
      type: 'POST',
      cache: false,
      data:{
        method: 'changePass',
        newPassword:newPassword,
        id:id,
        full_name:full_name
      },success:function(response){
        if(response == 'success'){
          swal('Notification','Password successfully changed!','success');
          $('.modal').modal('close','#modalViewTech');
          searchTech();
        }else{
          swal('Notification','Failed!','error');
        }
      }
    });
  }
}
</script>
<script type="text/javascript">
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
    var rows = document.querySelectorAll("#tblData tr");
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);
        csv.push(row.join(","));
    }
    downloadCSV(csv.join("\n"), filename);
}
    </script>
</body>
</html>
