<!DOCTYPE html>
<html>
<head>
	<title>Andon Department Admin</title>
	<link rel="icon" type="image/png" href="../img/ANDON ICON.png">
	<link rel="stylesheet" type="text/css" href="materialize/css/materialize.min.css">
	<style type="text/css">
		@font-face{
			src:url('../font/ubuntu_font.ttf');
			font-family: ubuntu;
		}
		body{
			font-family:ubuntu;
		}
		select{
			border-radius: 10px;
		}
	</style>
</head>
<body>
	<main style="margin-left:5%;margin-right: 5%;">
	<!-- BANNER -->
	<div class="row">
		<div class=" col s12">
			<center><img src="Img/andono.png" class="responsive-img" style="width:40%;"></center>
		</div>
	</div>
	<!-- LOGIN SYSTEM -->
	<div class="row">
		<!-- LOGIN IMAGE -->
		<div class="col l6 m6 s12">
			<center>
				<img src="Img/screen.png" class="responsive-img" style="width:50%;">
			</center>
		</div>

		<!-- LOGIN FORM -->
		<div class="col l6 m6 s12">
			<div class="row">
				<center>
					<?php
						require 'processor/viewerProcess.php';
					;?>
				</center>
				<form action="" method="POST" style="display: none;">
					<div class="input-field col s6">
						<!-- CATEGORY -->
						<select name="category" class="browser-default z-depth-5">
							<option value="">--SELECT CATEGORY--</option>
							<option value="All">Combine Andon</option>
							<option value="Initial">Initial</option>
							<option value="Final">Final</option>
						</select>
					</div>
					<div class="input-field col s6">
						<!-- DEPARTMENT -->
						<select name="dept" class="browser-default z-depth-5">
							<option value="" >--SELECT DEPARTMENT--</option>
							<?php
								require '../database/index.php';
								$query = "SELECT deptCode,description FROM tbldepartment";
								$stmt = $db->query($query);
								while($x = $stmt->fetch_assoc()){
									echo '<option value="'.$x['deptCode'].'">'.$x['description'].'</option>';
								}
								// $conn = null;
							?>
						</select>
					</div>
				
					<!-- submit -->
					<div class="row input-field col s12">
						<input type="submit" class="btn blue col s3 z-depth-5" name="loginBtn"  style="border-radius:10px;" value="Proceed &rarr;">
					</div>
				</form>
			</div>
		</div>

	</div>
</main>
	<!-- JAVASCRIPT -->
	<script type="text/javascript" src="materialize/jquery/jqueryLib.js"></script>
	<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){$("form").fadeIn(1e3)});
	</script>
</body>
</html>