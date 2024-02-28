<?php
	

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="img/ai.jpg" type="image/gif" sizes="16x16">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Andon Validation - Ongoing Andon</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div class="row" style="height:100px;">
		<p style="color:red;">ONGOING</p>
		<table border="1">
		<thead>
			<th>LIST ID</th>
			<th>REQUESTED ID</th>
			<th>MACHINE NAME</th>
			<th>PROBLEM</th>
			<th>LINE</th>
			<th>OPERATOR NAME</th>
			<th>COUNT OF ENTRY</th>
		</thead>
		<tbody id="datareturn"></tbody>
	</table>
	</div>
	<div class="" id="spinner"></div>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			// fetchDblHistory();
			setTimeout(fetchDblHistory,5000);
		});
// --------------------------------------------------------------------------------------
		const fetchDblHistory =()=>{
			$('#spinner').addClass('spinner');
			$.ajax({
			url:'php/fetchdblentry.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'fetchDoubleOngoing'
			},success:function(response){
				$('#datareturn').html(response);
				$('#spinner').removeClass('spinner');
				setTimeout(fetchDblHistory,10000);
			}
		});
		}
	</script>
</body>
</html>