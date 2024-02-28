<?php require '../processor/conn.php';?>
<div class="row">
	<div class="col s12">
		<div class="input-field">
			<select class="browser-default z-depth-5" id="deptMN" onchange="loadMachineforSelect()">
				<option value="">--Select Department--</option>
				<?php
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
		<div class="input-field">
			<select class="browser-default z-depth-5" id="MachineMN">
				<option value="">--Select Machine--</option>
			</select>
		</div>
		<!-- MACHINE NUMBER -->
		<div class="input-field">
			<input type="number" name="" id="machineNum"><label>Machine Number</label>
		</div>
	</div>
</div>
<div class="row right">
	<button class="btn blue z-depth-5" id="saveMachineNumber" onclick="saveMachineNumber()" style="border-radius:20px;">Register</button>
	<button class="btn-flat modal-close z-depth-5" style="border-radius:20px;">cancel</button>
</div>