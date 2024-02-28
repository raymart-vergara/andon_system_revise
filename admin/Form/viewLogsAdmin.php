<div class="row">
	<div class="col s12">
		<div class="input-field col s4">
			<input type="date" name="" id="dateLog">
		</div>
		<!-- SUBMIT -->
		<div class="input-field col s4">
			<button class="btn blue z-depth-5 col s12" id="activityBtn" onclick="viewActivityLog()" style="border-radius:20px;">generate logs</button>
		</div>
		<div class="input-field col s4">
			<button class="btn z-depth-5 col s12" onclick="exportTableToCSV('Activity Logs.csv')" style="border-radius:20px;">export</button>
		</div>
	</div>
</div>
<div class="divider"></div>
<div class="row">
	<div class="container z-depth-5" style="overflow:auto;height:400px;">
		<table border="1" id="tblLogs" class="centered">
		<thead>
			<th>LOGS</th>
			<th>DATE</th>
		</thead>
		<tbody id="activityLogs"></tbody>
	</table>
	</div>
</div>
<div class="divider"></div>