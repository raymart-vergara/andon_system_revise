<?php
	require '../processor/session.php';
	$dept = $_GET['dept'];
	$datenow =  date('Y-m-d');
?>	

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Cancelled Andon Logs</title>
    <link rel="icon" type="image/png" href="../../img/ANDON ICON.png">
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
    <style>
        body{
            font-family:arial;
        }
        </style>
</head>
<body>
	<div class="row col s12 z-depth-5" style="font-size:12px;">
		<div class="input-field col s2">
			<input type="text" class="datepicker" id="from" autocomplete="off" value="<?=$datenow?>"><label>From:</label>
		</div>
		<!-- TO -->
		<div class="input-field col s2">
			<input type="text" class="datepicker" id="to" autocomplete="off"  value="<?=$datenow?>"><label>To:</label>
		</div>
		
		<!-- PROD CATEGORY -->
			<div class="input-field col s3">
			<select class="browser-default z-depth-3" id="category" style="border-radius:20px;">
				<option value="all">Combine</option>
				<option value="Initial">Initial Only</option>
				<option value="Final">Final Only</option>
			</select>
		</div>
		<!-- Search -->
		<div class="input-field col s2">
			<button class="btn-large green col s12 z-depth-3" onclick="searchLog()" id="searchBtn" style="border-radius:20px;">Search</button>
		</div>
        <!-- Search -->
        <div class="input-field col s3">
            <button class="btn-large teal col s12 z-depth-3" onclick="generateAll()" id="searchBtn" style="border-radius:20px;">generate all</button>
        </div>
        <button onclick="exportTableToCSV('Cancelled Andon.csv')" style="margin-right:1%;margin-bottom: 1%;border-radius:20px;" class="btn right blue">print</button>
	</div>
	<br>
<!-- TABLE DATA FOR LOGS -->
	<div class="row">
		<div class="col s12" style="overflow: auto;height:500px;width:100%;border:1px solid black;">
			<table class="centered" style="width:100%;font-size:12px;font-family: arial;" id="tblData" border="1">
				<thead>
					<th>Production</th>
					<th>Line</th>
					<th>Machine</th>
          <th>Machine No.</th>
          <th>Process</th>
					<th>Problem</th>
					<th>Production Acct.</th>
					<th>Call Date Time</th>
					<th>Department</th>
          <th>Cancel Date Time</th>
          <th>Reason</th>
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
        //------------------------------------------------------------------------------------------------------
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
       // -------------------------------------------------------------------------------------------------------------------------
    	$(document).ready(function(){
    		$('.datepicker').datepicker({
    			format: 'yyyy-mm-dd',
    			autoClose: true
    		});
    	});
    	
        const searchLog =()=>{
            var from = document.getElementById('from').value;
            var to = document.getElementById('to').value;
            var categ = document.getElementById('category').value;
            var dept = '<?=$dept;?>'
            // GENERATE
            $.ajax({
                url: '../processor/cancelandonLogs.php',
                cache: false,
                type: 'POST',
                data: {
                    method: 'search',
                    from:from,
                    to:to,
                    categ:categ,
                    dept:dept
                },success:function(response){
                    document.getElementById('logs').innerHTML = response;
                }
            });
        }

        // GENERATE ALL
        const generateAll =()=>{
            dept = '<?=$dept;?>';
            $.ajax({
                 url: '../processor/cancelandonLogs.php',
                cache: false,
                type: 'POST',
                data: {
                    method: 'generateAll',
                    dept:dept
                },success:function(response){
                    document.getElementById('logs').innerHTML = response;
                }
            });

        }


    function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
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

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
    </script>
</body>
</html>