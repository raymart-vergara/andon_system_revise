
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>TRD Applicator Replacement Logs</title>
	<link rel="icon" type="image/png" href="../../img/ANDON ICON.png">
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
	<style type="text/css">
		body{
		font-family:arial;
	}
	</style>
</head>
<body>
	<main>
		<h5 class="center">TRD Applicator Replacement Logs</h5>
		<div class="row">
			<div class="col s12">
				<div class="col s3 input-field">
					<select class="browser-default z-depth-3" id="server">
						<option value="live">Live Server</option>
						<option value="backup">Backup Server</option>
					</select>
				</div>
				<!-- DATE -->
				<div class="col s2 input-field">
					<input type="text" class="datepicker" name="" id="date_from" value="<?php echo date('Y-m-d');?>"><label>From:</label>
				</div>
				<div class="col s2 input-field">
					<input type="text" class="datepicker" name="" id="date_to" value="<?php echo date('Y-m-d');?>"><label>To:</label>
				</div>
				<!-- FIX STATUS -->
				<div class="col s3 input-field">
					<select class="browser-default z-depth-3" id="fixing_stat">
						<option value="cmb">Combine</option>
						<option value="dw">Downtime</option>
						<option value="gd">Good</option>
					</select>
				</div>
				<!-- SEARCH -->
				<div class="col s2 input-field">
					<button class="btn green col s12" id="search_btn" onclick="generate()">Search</button>
				</div>
				<div class="col s2 input-field">
					<button class="btn blue col s12" id="export_btn" onclick="download_table_as_csv('appdata')">Export</button>
				</div>
			</div>
			<!-- BUTTONS -->
			<!-- <div class="row">
				<div class="col s12">
					<div class="col s3 input-field">
						<button class="btn blue col s12" id="export_btn">Export</button>
					</div>
				</div>
			</div> -->
		</div>


		<!-- TABLE DATA -->
		<div class="row">
			<div class="col s12" style="overflow: auto;height:450px;width:100%;border:1px solid black;">
				<table  class="centered z-depth-5" style="width:2800px;font-size:12px;table-layout:fixed;" id="appdata" border="1">
					<thead>
						<th>Production</th>
						<th>Line</th>
						<th>Machine</th>
						<th>Machine No.</th>
						<th>Problem</th>
						<th>Production Acct.</th>
						<th>Call Date Time</th>
						<th>Waiting Time(mins.)</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Fixing Time (mins.)</th>
						<th>Technician</th>
						<th>Department</th>
						<th>Solution</th>
						<th>Fixing Status</th>
						<th>Backup Request Time</th>
						<th>Backup Comment</th>
						<th>Backup Technician</th>
						<th>Backup Confirmation</th>
						<th>Applicator Solution</th>
						<th>Applicator Name</th>
						<th>Applicator Unique No.</th>
						<th>Replacement Status</th>
						<th>Work Order No.</th>
					</thead>
					<tbody id="applicator_logs"></tbody>
				</table>
			</div>
		</div>	
	</main>
	<!-- JS -->
	<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
	<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.datepicker').datepicker({
				autoClose: true,
				format: 'yyyy-mm-dd'
			});

			
		});
		// GENERATE LOGS
			const generate =()=>{
				var server = $('#server').val();
				var date_from = $('#date_from').val();
				var date_to = $('#date_to').val();
				var fixing_status = $('#fixing_stat').val();
				if(date_from == ''){
					swal('Notification','Please enter valid date range!','info');
				}else if(date_to == ''){
					swal('Notification','Please enter valid date range!','info');
				}else if(fixing_status == ''){
					swal('Notification','Please select Fixing Status!','info');
				}else{
					$('#search_btn').attr('disabled',true);
					$('#search_btn').html('Please wait..');
					$.ajax({
						url: '../processor/applicator_logs.php',
						type: 'POST',
						cache: false,
						data:{
							server:server,
							date_from:date_from,
							date_to:date_to,
							fixing_status:fixing_status
						},success:function(response){
							document.getElementById('applicator_logs').innerHTML = response;
							$('#search_btn').attr('disabled',false);
							$('#search_btn').html('Search');
						}
					});
				}
			}

// Quick and simple export target #table_id into a csv
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
    var filename = 'TRD_Applicator_Logs'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
	</script>
</body>
</html>