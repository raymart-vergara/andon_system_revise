
<div class="row">
	<div class="col s12">
		<div class="input-field col s12">
			<select class="browser-default z-depth-5" id="machineCateg">
				<option value="">--Select Category--</option>
				<option value="Initial">Initial</option>
				<option value="Final">Final</option>
			</select>
		</div>
		<!-- DEPARTMENT -->
		<div class="input-field col s12">
			<select class="browser-default z-depth-5" id="machineDept">
				<option value="">--Select Department--</option>
				<?php
					include '../processor/conn.php';
					$qry = "SELECT DISTINCT deptCode FROM tbldepartment";
					$stmt = $conn->prepare($qry);
					$stmt->execute();
					$res = $stmt->fetchALL();
						foreach($res as $x){
  			 				echo '<option value="'.$x['deptCode'].'">'.$x['deptCode'].'</option>';
  			 			}
				?>
			</select>
		</div>
		<!-- MACHINE NAME -->
		<div class="input-field col s12">
			<input type="text" name="" id="machineName"><label>Machine Name</label>
		</div>
		<!-- BUTTON -->
		<div class="row right">
			<button class="btn blue z-depth-5" onclick="btnSaveMachine()" id="btnMachine" style="border-radius:20px;">Register</button>
			<button class="btn-flat modal-close z-depth-5 "style="border-radius:20px;">cancel</button>
		</div>
	</div>
</div>