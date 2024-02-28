<?php
	// require '../processor/session.php';
	$datenow =  date('Y-m-d');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Top 10 Downtime</title>
	<link rel="icon" type="image/png" href="../../img/ANDON ICON.png">
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="../node_modules/chart.js/dist/Chart.min.css">
  <style type="text/css">
    canvas{
      width:100%;
    }
    body{
      font-family: arial;
    }
	#btnNew, #generateBtn{
		border-radius:20px;
	}
  </style>
</head>
<body>
	<h5>Report Graph Top 10 Downtime</h5>
	<!-- FILTRATION -->
	<div class="row">
		<div class="col s12">
      <div class="input-field col s2 ">
        <select class="browser-default z-depth-5" id="server" style="border-radius:20px;">
          <option value="live">Live Server</option>
          <option value="backup">Backup Server</option>
        </select>
      </div>
			<div class="input-field col s2">
				<input type="text" name="" class="datepicker" id="dateFrom" autocomplete="off" value="<?=$datenow;?>"><label>Date From:</label>
			</div>
			<div class="input-field col s2">
				<input type="text" name="" class="datepicker" id="dateTo" autocomplete="off" value="<?=$datenow;?>"><label>Date To:</label>
			</div>
			<!--  -->
			<div class="input-field col s2">
				<button class="btn blue z-depth-5 col s12" id="generateBtn" onclick="generate()" id="generateStart">Generate</button>

			</div>
			<div class="input-field col s2">
				<button class="btn red z-depth-5" onclick="location.reload()" id="btnNew" disabled>generate new</button>
			</div>
		</div>
	</div>

<br>
	<!-- TABLE AND CHART -->
	<div class="row">
			<div class="col s6">
				<canvas id="myChart"></canvas>
			</div>
			<!-- TABLE -->
			<div class="col s6 z-depth-5" style="height:450px;overflow: auto;">
				<table id="tblData"  class="centered" style="width:1500px;">
					<thead style="font-size: 12px;">
						<th>Request No.</th>
          				<th>Production</th>
						<th>Department</th>
						<th>Line</th>
						<th>Machine Name</th>
						<th>Problem</th>
						<th>Process</th>
						<th>Waiting Time (mins.)</th>
						<th>Call Time</th>
						<th>Start Fix Time</th>
						<th>End Time</th>
						<th>Solution</th>
						<th>Technician</th>
						<th>Fixing Time (mins.)</th>
					</thead>
					<tbody id="downtimeData" style="font-size:12px;"></tbody>
				</table>
			</div>
	</div>
	<!-- EXPORT -->
	<div class="row">
		<div class="col s12">
			<button class="btn-small blue right z-depth-5" onclick="download_table_as_csv('tblData')">Export Table</button>
		</div>
	</div>
	<!-- JAVASCRIPT AND JAVASCRIPT LIBRARY -->
	<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
	<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
    <script type="text/javascript" src="../node_modules/chart.js/dist/Chart.min.js"></script>
    <script type="text/javascript">
    window.onload=function(){function t(e){e.stopPropagation?e.stopPropagation():window.event&&(window.event.cancelBubble=!0),e.preventDefault()}document.addEventListener("keydown",function(e){e.ctrlKey&&e.shiftKey&&73==e.keyCode&&t(e),e.ctrlKey&&e.shiftKey&&74==e.keyCode&&t(e),83==e.keyCode&&(navigator.platform.match("Mac")?e.metaKey:e.ctrlKey)&&t(e),e.ctrlKey&&85==e.keyCode&&t(e),123==event.keyCode&&t(e)},!1)};
// -----------------------------------------------------------------------------------------------------------------------------------------------
    	$(document).ready(function(){
    		$('.datepicker').datepicker({
    			format: 'yyyy-mm-dd',
    			autoClose: true
    		});
    		$('.materialboxed').materialbox();
    	});
    	const generate =()=>{
        var from = document.getElementById('dateFrom').value;
        var to = document.getElementById('dateTo').value;
        var server = document.getElementById('server').value;
		$('#generateBtn').attr('disabled',true);
    		// AJAX
    		$.ajax({
    			type: 'POST',
    			url: '../processor/downtimeGenerator.php',
    			cache: false,
    			data:{
    				method: 'generate',
    				from:from,
    				to:to,
            		server:server
    			},success:function(response){
    				// console.log(response);
					$('#myChart').addClass('z-depth-5');
    				$('#downtimeData').html(response);
            		document.getElementById('server').disabled = true;
    				
    				$('#dateFrom').attr('disabled',true);
    				$('#dateTo').attr('disabled',true);
    				$('#btnNew').attr('disabled',false);
    				chart();
    			}
    		});
    	}

    	// GENERATION OF CHART
      // DECLARE VARIABLE AS ARRAY
    	var datas = [];
    	var dept = [];
    	const chart = () => {
    		$('.fixTime').each(function(){
    			var data = $(this).text();
    			datas.push(data);
    		});

    		$('.dept').each(function(){
    			var dataDept = $(this).text();
    			dept.push(dataDept);
    		});


    	var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: dept,
		        datasets: [{
		            label: 'Fixing Time',
		            data: datas,
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)',
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
		                'rgba(255, 159, 64, 1)',
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
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }
		});
    	}
// EXPORT AS CSV
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
    var filename = 'Andon_Logs'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
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
  if(idleTime > 2){
    window.close();
  }
}
    </script>
</body>	
</html>