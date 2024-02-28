<?php
	include '../processor/conn.php';
	$datenow =  date('Y-m-d');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Machine Downtime</title>
  <link rel="icon" type="image/png" href="../../img/ANDON ICON.png">
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
	<style>
    body{
      font-family: arial;
    }
    select{
        border-radius:20px;
    }
    .btn-large{
        border-radius:30px;
    }
    #machine_downtime_div{
        display:none;
        margin-top:1%;
    }
    #download_link{
        display:none;
    }
    .spinner {
  width: 40px;
  height: 40px;

  position: relative;
  margin: 100px auto;
}

.double-bounce1, .double-bounce2 {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #333;
  opacity: 0.6;
  position: absolute;
  top: 0;
  left: 0;
  
  -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
  animation: sk-bounce 2.0s infinite ease-in-out;
}

.double-bounce2 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

@-webkit-keyframes sk-bounce {
  0%, 100% { -webkit-transform: scale(0.0) }
  50% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bounce {
  0%, 100% { 
    transform: scale(0.0);
    -webkit-transform: scale(0.0);
  } 50% { 
    transform: scale(1.0);
    -webkit-transform: scale(1.0);
  }
}
	</style>
</head>
<body>
<div class="row z-depth-5">
    <div class="col s12">
    <h5 class="center">Machine Downtime</h5>
        <div class="input-field col s2">
            <select name="" id="server" class="browser-default z-depth-5">
                <option value="backup_server">Backup Server</option>
                <option value="live_server">Live Server</option>
            </select>
        </div>
        <div class="input-field col s2">
            <select name="" id="machine" class="browser-default z-depth-5">
                <option value="">--Select Machine--</option>
                <?php
                    $query = "SELECT DISTINCT machineName FROM tblmachinename";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    foreach($stmt->fetchALL() as $x){
                ?>
                <option value="<?=$x['machineName'];?>"><?=$x['machineName'];?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <!-- FROM -->
        <div class="input-field col s2">
            <input type="text" class="datepicker" id="dateFrom" value="<?=$datenow;?>"><label for="">From</label>
        </div>
        <!-- TO -->
        <div class="input-field col s2">
            <input type="text" class="datepicker" id="dateTo" value="<?=$datenow;?>"><label for="">To</label>
        </div>
        <!-- GENERATE -->
        <div class="input-field col s2">
            <button class="btn-large blue z-depth-5 col s12" id="generate" onclick="generate_machine_dw()">generate</button>
        </div>
        <!-- REFRESH -->
        <div class="input-field col s2">
            <button class="btn-large red z-depth-5 col s12" id="clear" onclick="location.reload()">New</button>
        </div>
    </div>
</div>
<div class="divider"></div>
<div class="spinner" id="spinner" style="display:none;">
  <div class="double-bounce1"></div>
  <div class="double-bounce2"></div>
</div>
<div class="row" id="machine_downtime_div">
    <table class="container z-depth-5" id="machine_downtime_tbl">
        <thead>
            <th>Department</th>
            <th>Downtime (Minutes)</th>
        </thead>
        <tbody id="content"></tbody>
    </table>
</div>
<div class="row" id="download_link">
    <div class="center">
        <button class="btn-large green z-depth-5" onclick="exportTableToCSV('Machine Downtime.csv')">download &darr;</button>
    </div>
</div>


<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
            autoClose: true,
            format:'yyyy-mm-dd'
        });
    });
    var min = [];
    function generate_machine_dw(){
        var server = document.getElementById('server').value;
        var machine = document.getElementById('machine').value;
        var from = document.getElementById('dateFrom').value;
        var to = document.getElementById('dateTo').value;
        if(machine == ''){
            swal('Notification','Please select machine!','info');
        }else if(from == ''){
            swal('Notification','Please complete the date range!','info');
        }else if(to == ''){
            swal('Notification','Please complete the date range!','info');
        }else{
            document.getElementById('generate').disabled = true;
            document.getElementById('spinner').style.display = "block";
            document.getElementById('server').disabled = true;
            document.getElementById('machine').disabled = true;
            document.getElementById('dateFrom').disabled = true;
            document.getElementById('dateTo').disabled = true;
            $('#machine_downtime_div').fadeOut();
            $.ajax({
                url:'../processor/downtimeGenerator.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'generate_machine_dw',
                    server:server,
                    machine:machine,
                    from:from,
                    to:to
                },success:function(response){
                   document.getElementById('content').innerHTML = response;
                   $('.entry_mins').each(function(){
                    var data = $(this).text();
                    min.push(data);
                   });
                //    console.log(min);
                  var sum = eval((min).join("+"));
                  if(!sum){
                      sum = 0;
                  }
                  document.getElementById('sum_min').innerHTML = sum;
                  $('#machine_downtime_div').fadeIn(500);
                  document.getElementById('spinner').style.display = "none";
                  document.getElementById('download_link').style.display = "block";
                }
            });
        }
    }
    // EXPORT
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
    var rows = document.querySelectorAll("#machine_downtime_tbl tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        csv.push(row.join(","));        
    }
    downloadCSV(csv.join("\n"), filename);
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