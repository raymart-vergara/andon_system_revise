<?php
	require '../processor/session.php';
	$dept = $_GET['dept'];
	$datenow =  date('Y-m-d');
?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Andon Logs</title>
	<link rel="icon" type="image/png" href="../../img/ANDON ICON.png">
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
	<style>
	body{
		font-family:arial;
	}
	</style>
</head>
<body>
	<div class="row" style="font-size:12px;">
	<div class="input-field col s1">
			<select name="" id="server" class="browser-default z-depth-5" style="border-radius:20px;">
				<option value="live_server">Live Server</option>
				<option value="backup_server">Backup Server</option>
			</select>
		</div>
	<!-- FROM -->
		<div class="input-field col s2">
			<input type="text" class="datepicker" id="from" autocomplete="off" value="<?=$datenow?>"><label>From:</label>
		</div>
		<!-- TO -->
		<div class="input-field col s2">
			<input type="text" class="datepicker" id="to" autocomplete="off" value="<?=$datenow?>"><label>To:</label>
		</div>
		<!-- CATEGORY -->
		<div class="input-field col s2">
			<select class="browser-default z-depth-5" id="fixing" style="border-radius:20px;">
				<option value="">All</option>
				<option value="good">Good Repair</option>
				<option value="downtime">Downtime</option>
			</select>
		</div>
		<!-- PROD CATEGORY -->
			<div class="input-field col s2">
			<select class="browser-default z-depth-5" id="category" style="border-radius:20px;">
				<option value="">Combine</option>
				<option value="Initial">Initial Only</option>
				<option value="Final">Final Only</option>
			</select>
		</div>
		<!-- SHIFT -->
		<div class="input-field col s1">
			<select class="browser-default z-depth-5" id="shift" style="border-radius:20px;">
				<option value="">All Shift</option>
				<option value="DS">DS</option>
				<option value="NS">NS</option>
			</select>
		</div>

		<!-- Search -->
		<div class="input-field col s2">
			<button class="btn-large col s12 z-depth-5" onclick="searchLog()" id="searchBtn" style="border-radius:20px;">Search</button>
		</div>
	</div>
<!-- PRINT -->
	<button onclick="exportTableToCSV('AndonLogs-per-department.csv')" style="margin-right:1%;margin-bottom: 1%;border-radius:20px;" disabled class="btn right blue z-depth-5" id="printBtn">print</button>
	<br>
<!-- TABLE DATA FOR LOGS -->
	<div class="row">
		<div class="col s12" style="overflow: auto;height:500px;width:100%;border:1px solid black;">
			<table class="centered z-depth-5" style="width:2500px;font-size:14px;table-layout:fixed;" id="tblData" border="1">
				<thead>
					<th>Production</th>
					<th>Line</th>
					<th>Machine</th>
					<th>Machine No.</th>
					<th>Problem</th>
					<th>Production Acct.</th>
					<th>Call Date Time</th>
					<th>Waiting Time (mins.)</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Fixing Time Duration(mins.)</th>
					<th>Technician</th>
          				<th>Department</th>
					<th>Solution</th>
		          		<th>Serial Number</th>
		         		<th>Jig Name</th>
		          		<th>Circuit Location</th>
		          		<th>Lot Number</th>
		          		<th>Product Number</th>
					<th>Fixing Status</th>
					<th>Backup Request Time</th>
					<th>Backup Comment</th>
					<th>Backup Technician</th>
					<th>Backup Confirmation Date Time</th> 
				</thead>
				<tbody id="logs"></tbody>
			</table>
		</div>
	</div>
	<!-- JAVASCRIPT AND JAVASCRIPT LIBRARY -->
	<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
	<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('.datepicker').datepicker({
    			format: 'yyyy-mm-dd',
    			autoClose: true
    		});
    	});
    	// SEARCH BY DATE RANGE
    	const searchLog =()=>{
			var server = document.getElementById('server').value;
			var from = document.getElementById('from').value;
			var to = document.getElementById('to').value;
			var fixing = document.getElementById('fixing').value;
			var categ = document.getElementById('category').value;
			var dept = '<?=$dept;?>';
			var shift = document.getElementById('shift').value;
			document.getElementById('searchBtn').disabled = true;
			document.getElementById('searchBtn').innerHTML = 'Please Wait..';
    		// AJAX SEARCH
    			$.ajax({
    				url: '../processor/andonLogs.php',
    				type: 'GET',
    				cache: false,
    				data:{
    					method: 'searchAndon',
    					from:from,
    					to:to,
    					fixing:fixing,
    					categ:categ,
    					dept:dept,
					server:server,
					shift:shift
    				},success:function(response){
					document.getElementById('printBtn').disabled = false;
					document.getElementById('logs').innerHTML = response;
					document.getElementById('searchBtn').disabled = false;
					document.getElementById('searchBtn').innerHTML = 'search';
    				}
    			});
    	}
// EXPORT TO EXCEL
function downloadCSV(e,n){var d,o;d=new Blob([e],{type:"text/csv"}),(o=document.createElement("a")).download=n,o.href=window.URL.createObjectURL(d),o.style.display="none",document.body.appendChild(o),o.click()}
function exportTableToCSV(e){for(var t=[],o=document.querySelectorAll("#tblData tr"),l=0;l<o.length;l++){for(var n=[],r=o[l].querySelectorAll("td, th"),a=0;a<r.length;a++)n.push(r[a].innerText);t.push(n.join(","))}downloadCSV(t.join("\n"),e)}
// --------------------------------------------------------------------------------------------------------------------------------
// window.onload=function(){function e(e){return e.stopPropagation?e.stopPropagation():window.event&&(window.event.cancelBubble=!0),e.preventDefault(),!1}document.addEventListener("contextmenu",function(e){e.preventDefault()},!1),document.addEventListener("keydown",function(t){t.ctrlKey&&t.shiftKey&&73==t.keyCode&&e(t),t.ctrlKey&&t.shiftKey&&74==t.keyCode&&e(t),83==t.keyCode&&(navigator.platform.match("Mac")?t.metaKey:t.ctrlKey)&&e(t),t.ctrlKey&&85==t.keyCode&&e(t),123==event.keyCode&&e(t)},!1)};
       // -----------------------------------------------------------------------------------------------------------------
    </script>
</body>
</html>