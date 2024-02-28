<?php
	include '../processor/conn.php';
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
<!-- RADIO BUTTON SERVER SELECTION ----------------------------------------------------------------------------------------------------->
<div class="row">
  <div class="col s12">
    <div class="input-field col s2">
      <select class="browser-default z-depth-5" id="server" style=";border-radius: 20px;">
        <option value="live">Live Server</option>
        <option value="backup">Backup Server</option>
      </select>
    </div>
  </div>
</div>
<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
	<div class="row" style="font-size:12px;">
		<div class="input-field col s2">
			<input type="text" class="datepicker" id="from" autocomplete="off" value="<?=$datenow?>"><label>From:</label>
		</div>
		<!-- TO -->
		<div class="input-field col s2">
			<input type="text" class="datepicker" id="to" autocomplete="off" value="<?=$datenow?>"><label>To:</label>
		</div>
		<!-- CATEGORY -->
		<div class="input-field col s1">
			<select class="browser-default z-depth-5" id="fixing" style="border-radius: 20px;">
				<option value="">All</option>
				<option value="good">Good Repair</option>
				<option value="downtime">Downtime</option>
			</select>
		</div>
		<!-- PROD CATEGORY -->
			<div class="input-field col s1">
			<select class="browser-default z-depth-5" id="category" style=" border-radius: 20px;">
				<option value="">Combine</option>
				<option value="Initial">Initial Only</option>
				<option value="Final">Final Only</option>
			</select>
		</div>
		<!-- DEPT -->
		<div class="input-field col s2">
			<select class="browser-default z-depth-5" id="department" style="border-radius: 20px;">
				<option value="">All Department</option>
				<?php
					// include '../processor/conn.php';
					$qry = "SELECT *FROM tbldepartment";
					$stmt = $conn->prepare($qry);
					$stmt->execute();
					// $stmt->fetchALL();
						foreach($stmt->fetchALL() as $x){
				?>
				<option value="<?=$x['deptCode']?>"><?=$x['description']?></option>
				<?php
						}
				?>
			</select>
		</div>
		<div class="input-field col s1">
			<select class="browser-default z-depth-5" id="shift" style="border-radius: 20px;">
				<option value="">ALL SHIFT</option>
				<option value="DS">DS</option>
				<option value="NS">NS</option>
			</select>
		</div>

		<!-- CARMODEL -->
		<div class="input-field col s2">
			<select class="browser-default z-depth-5" id="car_model" style="border-radius: 20px;">
				<option value="">ALL CARMODEL</option>
				<?php
				$query = "SELECT carMaker FROM tblcarmaker";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				$res = $stmt->fetchALL();
					foreach($res as $x){
						if($x['carMaker'] == 'IT' || $x['carMaker'] == 'EQD' || $x['carMaker'] == 'PE')continue;
						echo '<option>'.$x['carMaker'].'</option>';
					}
				 ?>
			</select>
		</div>

		<!-- Search -->
		<div class="input-field col s1">
			<button class="btn-large green col s12 z-depth-5" onclick="searchLog()" id="searchBtn" style="border-radius: 20px;">Search</button>
		</div>
	</div>
<!-- PRINT -->
	<button onclick="download_table_as_csv('tblData')" style="margin-right:1%;margin-bottom: 1%;border-radius:20px;" class="btn right blue z-depth-5" >Export &darr;</button>
	<br>
<!-- TABLE DATA FOR LOGS -->
<br>
	<div class="row">
		<div class="col s12" style="overflow: auto;height:400px;width:100%;border:1px solid black;">
			<table class="centered" style="width:2100px;font-size:12px;font-family: arial;" id="tblData" border="1">
				<thead >
					<th>#</th>
					<th>PC Type</th>
					<th>Problems</th>
					<th>Total</th>
				
					
				</thead>
				<tbody id="machine"></tbody>
			

			</table>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			
			<canvas id="myChart"></canvas>
		</div>
	</div>
	<div class="row">
		<div class="col s12" style="overflow: hidden;height:0;width:0%;border:1px solid black; visibility: hidden;">
			<table class="centered" style="width:2100px;font-size:12px;font-family: arial;" id="tblData" border="1">
				<thead >
					<th>#</th>
					<th>PC Type</th>
					<th>Problems</th>
					<th>Total</th>
				</thead>
				<tbody id="machine2"></tbody>
			

			</table>
		</div>
	</div>

	<!-- JAVASCRIPT AND JAVASCRIPT LIBRARY ----------------------------------------------------------------------------------------------->
	<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
	<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
    <script type="text/javascript" src="../node_modules/chart.js/dist/Chart.min.js"></script>
    <script type="text/javascript">
        window.onload = function () {
           document.addEventListener("contextmenu", function (e) {
            //    e.preventDefault();
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
var idleTime = 0;
$(document).ready(function(){
  var idleInterval = setInterval(timerIncrement,60000); //PER 1 MINUTE
  $(this).mousemove(function(e){
    idleTime = 0;
  });

  $(this).keypress(function(e){
    idleTime = 0;
  });

  $(this).mousedown(function(e){
    idleTime = 0;
  });

  $(this).click(function(e){
    idleTime = 0;
  });

  $(this).keydown(function(e){
    idleTime = 0;
  });

  $(this).scroll(function(e){
    idleTime = 0;
  });
});
function timerIncrement(){
  idleTime = idleTime + 1;
  console.log(idleTime);
  // if(idleTime > 2){
  //   window.close();
  // }
}
       // ----------------------------------------------------------------------------------------------------------------------------------
    	$(document).ready(function(){
    		$('.datepicker').datepicker({
    			format: 'yyyy-mm-dd',
    			autoClose: true
    		});
    	});
    	// SEARCH BY DATE RANGE -----------------------------------------------------------------------------------------------------------
    	const searchLog =()=>{
			var from = document.getElementById('from').value;
			var to = document.getElementById('to').value;
			var fixing = document.getElementById('fixing').value;
			var categ = document.getElementById('category').value;
			var dept = document.getElementById('department').value;
			var servername = document.getElementById('server').value;
			var shift = document.getElementById('shift').value;
			var car_model = document.getElementById('car_model').value;
			document.getElementById('searchBtn').disabled = true;
			document.getElementById('searchBtn').innerHTML = 'Please Wait..';

		
    		// AJAX SEARCH
    			$.ajax({
    				url: '../processor/andonLogsAdmin.php',
    				type: 'GET',
    				cache: false,
    				data:{
    					method: 'searchMachine',
    					from:from,
    					to:to,
    					fixing:fixing,
    					categ:categ,
    					dept:dept,
            			servername:servername,
            			shift:shift,
									car_model:car_model
    				},success:function(response){
    					$('#machine').html(response);
    					$('#searchBtn').attr('disabled',false);
    					$('#searchBtn').html('search');
    					
    				
						searchLog2();
    				}
    			});
    	}


    	const searchLog2 =()=>{
			var from = document.getElementById('from').value;
			var to = document.getElementById('to').value;
			var fixing = document.getElementById('fixing').value;
			var categ = document.getElementById('category').value;
			var dept = document.getElementById('department').value;
			var servername = document.getElementById('server').value;
			var shift = document.getElementById('shift').value;
			var car_model = document.getElementById('car_model').value;
			document.getElementById('searchBtn').disabled = true;
			document.getElementById('searchBtn').innerHTML = 'Please Wait..';

		
    		// AJAX SEARCH
    			$.ajax({
    				url: '../processor/andonLogsAdmin.php',
    				type: 'GET',
    				cache: false,
    				data:{
    					method: 'searchMachine2',
    					from:from,
    					to:to,
    					fixing:fixing,
    					categ:categ,
    					dept:dept,
            			servername:servername,
            			shift:shift,
									car_model:car_model
    				},success:function(response){
    					$('#machine2').html(response);
    					$('#searchBtn').attr('disabled',false);
    					$('#searchBtn').html('search');
    					
    					var machineName = [];
    					var total = [];

    					  $('.machineName').each(function(){
								machineName.push($(this).html());
								});
    					   $('.total').each(function(){
								total.push($(this).html());
								});
						chart(machineName,total);
    				}
    			});
    	}


    	
    	const chart=(machineName,total)=>{
    				var ctx = document.getElementById('myChart');
     var myChart = new Chart(ctx, {
                 type: 'bar',
                 data: {
                 labels: machineName,
                 datasets: [{
                 label: 'Concern Count',
                 data: total,
                 backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
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
            y: {
                beginAtZero: true
            }
        }
    }
});
 }

    	
		</script>
	<script>
//---------------------------------------------------------------------------------------------------------------------------------------
function download_table_as_csv(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'Machine_Summary'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
//------------------------------------------------------------------------------------------------------------------------------------------
</script>
</body>
</html>
<?php $conn = null;?>
