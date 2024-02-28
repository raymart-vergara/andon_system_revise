<div class="row">
	<div class="col s12">
		<div class="input-field">
			<select class="browser-default z-depth-5" id="categProd" style="border-radius:20px;">
				<option value="">--Select Category--</option>
				<option value="Initial">Initial</option>
				<option value='Final'>Final</option>
			</select>
		</div>
		<!-- CARMAKER -->
		<div class="input-field">
			<select class="browser-default z-depth-5" id="carMakerSelect" style="border-radius:20px;">
				<option value="">--Select Carmaker--</option>
				<?php
					include '../processor/conn.php';
					$query = "SELECT carMaker FROM tblcarmaker";
					$stmt = $conn->prepare($query);
					$stmt->execute();
					foreach($stmt->fetchALL() as $x){
						if($x['carMaker'] == 'IT' || $x['carMaker'] == 'EQD' || $x['carMaker'] == 'PE')continue;
				?>
					<option value="<?=$x['carMaker']?>"><?=$x['carMaker']?></option>
				<?php
						}
				?>
			</select>
		</div>
		<!-- LINE -->
		<div class="input-field">
			<input type="text" name="" id="lineNumber" autocomplete="off"><label>Line Number</label>
		</div>
	</div>
</div>
<div class="row right">
	<button class="btn blue z-depth-5" id="regLineBtn" onclick="registerLine()" style="border-radius:20px;">Register</button>
	<button class="btn-flat z-depth-5 modal-close" style="border-radius:20px;">cancel</button>
</div>
