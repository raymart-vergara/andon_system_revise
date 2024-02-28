		<div class="row col s12">
			<div class="input-field col s6">
				<input type="text" id="fname" name="" autocomplete="off"><label>First Name</label>
			</div>
			<div class="input-field col s6">
				<input type="text" id="lname"  name="" autocomplete="off"><label>Last Name</label>
			</div>
		</div>
		<!-- ROW 2 -->
		<div class="row">
			<div class="input-field col s12">
				<select class="browser-default z-depth-5" id="carMaker" style="border-radius:20px;">
					<option value="">--Select Car Maker--</option>
					<?php
						include 'conn.php';
						$query = "SELECT carMaker FROM tblcarmaker ORDER BY listId ASC";
						$stmt = $conn->prepare($query);
						$stmt->execute();
						$res = $stmt->fetchAll();
							if($stmt->rowCount() > 0){
								foreach($res as $x){
									if($x['carMaker'] == 'IT' || $x['carMaker'] == 'EQD' || $x['carMaker'] == 'PE')continue;
					?>
						<option value="<?=$x['carMaker'];?>"><?=$x['carMaker'];?></option>
					<?php
								}
							}
					?>
				</select>
			</div>
		<!-- ROW 3 -->
		<div class="row">
			<div class="input-field col s12">
				<select class="browser-default z-depth-5" id="category" style="border-radius:20px;">
					<option value="">--Select Category--</option>
					<option value="Initial">Initial</option>
					<option value="Final">Final</option>
				</select>
			</div>
		</div>
		<!-- row 4 -->
		<div class="row">
			<div class="input-field col s12">
				<select class="browser-default z-depth-5" id="acct_type" style="border-radius:20px;">
					<option value="">--Select Account Type--</option>
					<option value="Operator Account">Operator</option>
					<option value="Event Account">Event</option>
				</select>
			</div>
		</div>
		<!-- ROW  5-->
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="" id="idNumber" autocomplete="off"><label>Operator's ID</label>
			</div>
		</div>
		<!-- ROW 6 -->
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="" id="techid" onchange="funcAddOperator()" autocomplete="off"><label>Your ID Please</label>
			</div>
		</div>
		</div>