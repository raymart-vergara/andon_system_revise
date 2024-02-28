<?php include '../processor/conn.php';?>

<div class="row">
	<div class="col s12">
		<!-- PROCESS -->
		<div class="input-field">
			<select class="browser-default z-depth-5" id="departmentProcess" onchange="loadMachineforSelectofProcess()">
				<option value="">--Select Department--</option>
				<?php
					$sql = "SELECT deptCode, description FROM tbldepartment";
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					foreach ($stmt->fetchALL() as $x) {
				?>
					<option value="<?=$x['deptCode']?>"><?=$x['description'];?></option>
				<?php
					}
				?>
			</select>
		</div>
		<!-- MACHINE -->
		<div class="input-field">
			<select class="browser-default z-depth-5" id="processMachine">
				<option value="">--Select Machine--</option>
			</select>
		</div>
		<!-- PROCESS -->
		<div class="input-field">
			<input type="text" id="processTxt" name="" autocomplete="off"><label>Process</label>
		</div>
	</div>
</div>
<!-- BUTTON -->
<div class="row right">
	<div class="col s12 input-field">
		<button class="btn blue z-depth-5" onclick="registerProcess()" id="regProcessBtn" style="border-radius:20px;">REGISTER</button>
		<button class="btn-flat modal-close z-depth-5" style="border-radius:20px;">Cancel</button>
	</div>
</div>