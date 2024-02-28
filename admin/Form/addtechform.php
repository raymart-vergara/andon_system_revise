<div class="row">
	<div class="col s12">
		<div class="input-field col s6">
			<input type="text" name="" id="fname"><label>Firstname</label>
		</div>
		<!--  -->
		<div class="input-field col s6">
			<input type="text" name="" id="lname"><label>Lastname</label>
		</div>
	</div>
</div>
<!-- DEPT AND CATEGORY -->
<div class="row">
	<div class="col s12">
		<div class="input-field col s6">
			<select class="browser-default z-depth-5" id="department">
				<option value="">--Select Department--</option>
				<?php
					include '../processor/conn.php';
					$qry = "SELECT *FROM tbldepartment";
					$stmt = $conn->prepare($qry);
					$stmt->execute();
					$res = $stmt->fetchAll();
						foreach ($res as $x) {
					?>

						<option value="<?=$x['deptCode'];?>"><?=$x['description']?></option>
				<?php
						}
				?>
			</select>
		</div>
		<!-- CATEG -->
		<div class="input-field col s6">
			<select class="browser-default z-depth-5" id="production">
				<option value="">--Select Production--</option>
				<option value="Initial">Initial</option>
				<option value="Final">Final</option>
			</select>
		</div>
	</div>
</div>

<!-- TECHNICIAN PASSWORD -->
	<div class="row col s12">
		<div class="input-field col s12">
			<input type="text" name="" id="techPass"><label>Technician Password</label>
		</div>
	</div>
<!--  -->
<div class="divider"></div>
<!-- IT PASSWORD -->
<h6 class="center" style="color:red;">Scan your ID to register this technician</h6>
<div class="row">
	<center><input type="password" name="" class="center" style="width:200px;" id="ITpass" onchange="regTech()"></center>
</div>