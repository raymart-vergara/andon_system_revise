<!DOCTYPE html>
<html>
<head>
	<title>ANDON DATA</title>
	<link rel="stylesheet" type="text/css" href="node_modules/materialize-css/dist/css/materialize.min.css">
	<style type="text/css">
		.cont{
			border:1px solid gray;

		}
	</style>
	<link rel="icon" href="internet.png" sizes="16x16" type="image/png">
</head>
<body>
	<div class="row center">
		<h3 class="center" style="color:#f54e42;">ANDON DATA MONITORING</h3>
	</div>
	<div class="row">
		<div class="col s12">
			<!-- BACKUP DATABASE -->
			<div class="col l4 m4 s12 cont">
				<p>Backup Data</p>
				<h1 id="countBackup" style="color:#6eafdb;"></h1>
			</div>
 			
 			<!-- HISTORY -->
 			<div class="col l4 m4 s12 cont">
				<p>History</p>
				<h1 id="countHistory" style="color:#6edb91;"></h1>
			</div>

			<!-- TOTAL USERS -->
			<div class="col l4 m4 s12 cont">
				<p>Production Users</p>
				<h1 id="countUser" style="color:#dba56e;"></h1>
			</div>

		</div>
	</div>
	<div class="row divider"></div>

	<div class="row">
		<div class="col s12">
			<!-- PENDING ANDON -->
			<div class="col l4 m4 s12 cont">
				<p>Pending Andon</p>
				<table>
					<thead>
						<th>Department</th>
						<th>Count</th>
					</thead>
					<tbody id="pendingAndon"></tbody>
				</table>
			</div>

			<!-- ONGOING ANDON -->
			<div class="col l4 m4 s12 cont">
				<p>Ongoing Andon</p>
				<table>
					<thead>
						<th>Department</th>
						<th>Count</th>
					</thead>
					<tbody id="ongoingAndon"></tbody>
				</table>
			</div>

			<!-- TECHNICIAN -->
			<div class="col l4 m4 s12 cont">
				<p># of Technician registered in the ANDON System</p>
				<table>
					<thead>
						<th>Department</th>
						<th>Count</th>
					</thead>
					<tbody id="technician"></tbody>
				</table>
			</div>

		</div>
	</div>

	<script type="text/javascript" src="node_modules/materialize-css/dist/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

		});

		setTimeout(fetch_backup_count,1000);
		setTimeout(fetch_history,1000);
		setTimeout(fetch_user_prod,1000);
		setTimeout(fetch_pending_andon,1500);
		setTimeout(fetch_ongoing_andon,1500);
		setTimeout(fetch_tech,1500);

		function fetch_backup_count(){
			$.ajax({
				url: 'php/process.php',
				type: 'POST',
				cache:false,
				data:{
					method: 'count_backupDB'
				},success:function(response){
					document.querySelector('#countBackup').innerHTML = response;
				}
			});
		}

		function fetch_history(){
			$.ajax({
				url: 'php/process.php',
				type: 'POST',
				cache:false,
				data:{
					method: 'count_history'
				},success:function(response){
					// console.log(response);
					document.querySelector('#countHistory').innerHTML = response;
					setTimeout(fetch_history,10000);
				}
			});
		}

		function fetch_user_prod(){
			$.ajax({
				url: 'php/process.php',
				type: 'POST',
				cache:false,
				data:{
					method: 'count_user'
				},success:function(response){
					document.querySelector('#countUser').innerHTML = response;
					setTimeout(fetch_user_prod,12000);
				}
			});
		}

		function fetch_pending_andon(){
			$.ajax({
				url: 'php/process.php',
				type: 'POST',
				cache:false,
				data:{
					method: 'count_pending'
				},success:function(response){
					document.querySelector('#pendingAndon').innerHTML = response;
					setTimeout(fetch_pending_andon,12000);
				}
			});
		}

		function fetch_ongoing_andon(){
			$.ajax({
				url: 'php/process.php',
				type: 'POST',
				cache:false,
				data:{
					method: 'count_ongoing'
				},success:function(response){
					document.querySelector('#ongoingAndon').innerHTML = response;
					setTimeout(fetch_ongoing_andon,12000);
				}
			});
		}

		function fetch_tech(){
			$.ajax({
				url: 'php/process.php',
				type: 'POST',
				cache:false,
				data:{
					method: 'count_tech'
				},success:function(response){
					document.querySelector('#technician').innerHTML = response;
					setTimeout(fetch_tech,12000);
				}
			});
		}

	</script>
</body>
</html>