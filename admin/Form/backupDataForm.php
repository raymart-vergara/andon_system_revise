<?php
	// SECURITY //
	require '../processor/session.php';
	if($dept != 'Administrator'){
		session_unset();
		session_destroy();
		header('location:../index.php');
	}
?>
<div class="row col s12">
	<div class="col s4 input-field">
		<input type="date" name="" id="dataBackupFrom"><label>From:</label>
	</div>
	<div class="col s4 input-field">
		<input type="date" name="" id="dataBackupTo"><label>To:</label>
	</div>
	<div class="col s4 input-field">
		<button class="btn blue col s12" id="backupStartBtn" onclick="backupStartBtn()">Start Backup</button>
	</div>
</div>
<div id="notif" style="font-family: arial;"></div>
<div class="row">
	<div class="" id="spinner"></div>
</div>
<b class="red-text">Latest Backup:</b>
<a href="javascript:void(0)" id="refreshLogs" class="right" onclick="refreshLogs()">Refresh &#10227;</a>
<div class="row">
	<table style="table-layout: fixed;" class="centered">
		<thead>
			<th>Data Range (year-month-date)</th>
			<th>Date of Backup</th>
			<th>Initiator</th>
		</thead>
		<tbody id="backupLogsData"></tbody>
	</table>
</div>
<script type="text/javascript">loadBackupLogs();</script>