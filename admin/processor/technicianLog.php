<?php
	include 'conn.php';
	$datenow =  date('Y-m-d H:i:s');
	// METHOD
	$method = $_POST['method'];
	// SEARCHING METHOD
	if($method == 'search'){
		$dept = $_POST['deptFil'];
		$keyword = $_POST['keyword'];
		// IF KEYWORD EMPTY AND DEPT IS NOT EMPTY
		if(empty($keyword) && !empty($dept)){
			$qry = "SELECT *FROM tblaccount WHERE carMaker = '$dept' AND accountType ='Admin Account'";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			$res = $stmt->fetchAll();
				if($stmt->rowCount() > 0){
					foreach($res as $user){
					echo '<tr onclick="viewTech(&quot;'.$user['listId'].'&quot;)" class="modal-trigger" data-target="modalViewTech" style="cursor:pointer;">';
					echo '<td>'.$user['idNumber'].'</td>';
					echo '<td>'.$user['firstName']." ".$user['lastName'].'</td>';
					echo '<td>'.$user['carMaker'].'</td>';
					echo '<td>'.$user['category'].'</td>';
					echo '</tr>';
				}
			}else{
				echo '<tr colspan="4">No Record</tr>';
			}
		}
		// IF EMPTY DEPT AND KEYWORD NOT EMPTY
		elseif(empty($dept) && !empty($keyword)){
			$qry = "SELECT *FROM tblaccount WHERE  firstName LIKE '$keyword%' AND accountType ='Admin Account'";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			$res = $stmt->fetchAll();
				if($stmt->rowCount() > 0){
					foreach($res as $user){
					echo '<tr onclick="viewTech(&quot;'.$user['listId'].'&quot;)" class="modal-trigger" data-target="modalViewTech" style="cursor:pointer;">';
					echo '<td>'.$user['idNumber'].'</td>';
					echo '<td>'.$user['firstName']." ".$user['lastName'].'</td>';
					echo '<td>'.$user['carMaker'].'</td>';
					echo '<td>'.$user['category'].'</td>';
					echo '</tr>';
				}
			}else{
				echo '<tr colspan="4">No Record</tr>';
				}

		}else{
			$qry = "SELECT *FROM tblaccount WHERE firstName LIKE '$keyword%' AND accountType ='Admin Account' AND carMaker = '$dept'";
			$stmt = $conn->prepare($qry);
			$stmt->execute();
			$res = $stmt->fetchAll();
				if($stmt->rowCount() > 0){
					foreach($res as $user){
					echo '<tr onclick="viewTech(&quot;'.$user['listId'].'&quot;)" class="modal-trigger" data-target="modalViewTech" style="cursor:pointer;">';
					echo '<td>'.$user['idNumber'].'</td>';
					echo '<td>'.$user['firstName']." ".$user['lastName'].'</td>';
					echo '<td>'.$user['carMaker'].'</td>';
					echo '<td>'.$user['category'].'</td>';
					echo '</tr>';
				}
			}else{
				echo '<tr colspan="4">No Record</tr>';
				}

		}
}
	elseif($method == 'generateAll'){
		$qry = "SELECT *FROM tblaccount WHERE accountType ='Admin Account' ORDER BY carMaker ASC";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		$res = $stmt->fetchALL();
			if($stmt->rowCount() > 0){
					foreach($res as $user){
					echo '<tr onclick="viewTech(&quot;'.$user['listId'].'&quot;)" class="modal-trigger" data-target="modalViewTech" style="cursor:pointer;">';
					echo '<td>'.$user['idNumber'].'</td>';
					echo '<td>'.$user['firstName']." ".$user['lastName'].'</td>';
					echo '<td>'.$user['carMaker'].'</td>';
					echo '<td>'.$user['category'].'</td>';
					echo '</tr>';
				}
			}else{
				echo '<tr colspan="4">No Record</tr>';
				}
	}
	// REGISTER
	elseif($method == 'register'){
		$id = 0;
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$dept = $_POST['department'];
		$prod = $_POST['prod'];
		$techPass = trim($_POST['technicianPass']);
		$regOfficer = $_POST['registerOfficer'];
		$type = "Admin Account";
		// CHECK IT PASSWORD
		$checkIT = "SELECT firstName,lastName FROM tblaccount WHERE carMaker = 'IT' AND idNumber ='$regOfficer'";
		$stmt = $conn->prepare($checkIT);
		$stmt->execute();
		$res = $stmt->fetchall();
			if($stmt->rowCount() > 0){
				foreach($res as $x){
				$name = $x['firstName']." ".$x['lastName'];
				}
				// SEARCHING
				$checkID = "SELECT idNumber FROM tblaccount WHERE carMaker = '$dept' AND idNumber ='$techPass'";
				$stmt = $conn->prepare($checkID);
				$stmt->execute();
				$stmt->fetchALL();
					if($stmt->rowCount() > 0){
						echo 'This password already used by other please choose another password.';

					}else{
							// INSERTING
							$qry = "INSERT INTO tblaccount (`listId`,`idNumber`,`firstName`,`lastName`,`carMaker`,`category`,`accountType`) VALUES('$id','$techPass','$fname','$lname','$dept','$prod','$type')";
							$stmt = $conn->prepare($qry);
							if($stmt->execute()){
								$notif = $name. " was successfully registered ".$fname." ".$lname. " as technician of ".$dept.".";
								$act = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES('$id','$notif','$datenow')";
								$stmt = $conn->prepare($act);
									if($stmt->execute()){
										echo 'Success';
									}
							}else{
								echo 'Failed';
							}
						}
					}else{
							echo 'Invalid ID';
						}

	}
	// VIEWTECH DETAILS
	elseif($method == 'viewTech'){
		$id = $_POST['listId'];
		// QUERY
		$detail = "SELECT *FROM tblaccount WHERE listId = '$id' AND accountType = 'Admin Account'";
		$stmt = $conn->prepare($detail);
		$stmt->execute();
		$result = $stmt->fetchALL();
			foreach($result as $x){
				echo '<table>';
				echo '<tr>';
				echo '<td>Name:</td>';
				echo '<td>'.$x['firstName']." ".$x['lastName'].'</td>';
				echo '</tr>';
				// ROW 2
				echo '<tr>';
				echo '<td>Department:</td>';
				echo '<td>'.$x['carMaker'].'</td>';
				echo '</tr>';
				// ROW 3
				echo '<tr>';
				echo '<td>Production:</td>';
				echo '<td>'.$x['category'].'</td>';
				echo '</tr>';
				// ROW 4
				echo '<tr>';
				echo '<td>Password:</td>';
				echo '<td>'.$x['idNumber'].'</td>';
				echo '</tr>';
				// END
				echo '</table>';
				echo '<br>';
				echo '<div class="row right">';
				echo '<button class="btn blue" onclick="changePass(&quot;'.$x['listId'].'~!~'.$x['firstName'].'~!~'.$x['lastName'].'&quot;)">Change Password</button>&nbsp;';
				echo '<button class="btn red" onclick="deleteTech(&quot;'.$x['listId'].'&quot;)">delete</button>';
				echo '<button class="btn-flat modal-close">close</button>';
				echo '</div>';
			}
	}
	// DELETE TECH
	elseif($method == 'deleteTech'){
		$id = $_POST['listId'];
		$type = "Admin Account";
		// QUERY
		$del = "DELETE FROM tblaccount WHERE listId = '$id' AND accountType = '$type'";
		$stmt = $conn->prepare($del);
		if($stmt->execute()){
			echo 'Successfully deleted!';
		}else{
			echo 'Failed';
		}
	}

// CHANGE PASSWORD TECHNICIAN

elseif($method == 'changePass'){
	$id = $_POST['id'];
	$new_pass = trim($_POST['newPassword']);
	$name = $_POST['full_name'];
	// SQL
	$changeQL = "UPDATE tblaccount SET idNumber = '$new_pass' WHERE listId = '$id' AND accountType = 'Admin Account'";
	$stmt = $conn->prepare($changeQL);
	if($stmt->execute()){
		// REGISTER TO ACTIVITY Logs
		$msg = "System detects changing of password for ".$name;
		$log = "INSERT INTO activity_log (`id`,`notif`,`dateAct`) VALUES ('0','$msg','$datenow')";
		$stmt=$conn->prepare($log);
		$stmt->execute();
		echo 'success';
	}else{
		echo 'fail';
	}
}

	$conn = null;
?>
