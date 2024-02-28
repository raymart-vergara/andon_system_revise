<div class="modal" id="machineSolution" style="border-radius:20px;">
	<div class="modal-content">
		<h5 class="center">Machine Process Solution - <?=$dept;?></h5>
		<!-- FORM -->
		<div class="input-field col s12">
			<select class="browser-default z-depth-5" id="machineName" style="border-radius:20px;">
				<option value="">--Select Machine--</option>
				<?php
					$ftchQry = "SELECT DISTINCT machineName FROM tblmachinename WHERE department = '$dept'";
					$stmt = $conn->prepare($ftchQry);
					$stmt->execute();
					$res = $stmt->fetchAll();
						foreach($res as $x){
				?>
					<option value="<?=$x['machineName'];?>"><?=$x['machineName'];?></option>
				<?php
						}
				?>
			</select>
		</div>
		<!-- PROBLEM -->
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="" id="solution"><label>Solution</label>
			</div>
		</div>
		<!-- SCAN ID -->
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="" id="registrarID" onchange="addSolution()"><label>Your ANDON ID</label>
			</div>
		</div>
	</div>
	<!-- FOOTER -->
	<div class="modal-footer">
		<!-- <button class="btn blue z-depth-5" id="addSolutionBtn" onclick="addSolution()" style="border-radius:20px;">Add</button> -->
		<button class="btn-flat modal-close" style="border-radius:20px;">cancel</button>
	</div>
</div>