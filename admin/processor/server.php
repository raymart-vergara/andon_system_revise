<?php
	session_start();
	include 'conn.php';
	$error = 0;
	if(isset($_POST['loginBtn'])){
		$Dept = $_POST['dept'];
		$PassCode = $_POST['passcode'];
		$Categ = $_POST['category'];
		// IF DEPT AND PASSCODE WAS EMPTY
		if(empty($Dept) || empty($PassCode)){
			echo '<p style="color:red;">Please complete the login credentials.</p>';
		}else{
			// VALIDATION SQL
			$fetchDept = "SELECT *FROM admin_account where password = '$PassCode' AND departmentCode = '$Dept' LIMIT 1";
			$stmt = $conn->prepare($fetchDept);
			$stmt->execute();
			// PDO NEEDS TO FETCH ALL
			$res = $stmt->fetchALL();
			// FETCH ROWCOUNT IF ROWCOUNT > 0 OR = 1 REDIRECTED TO THE DASHBOARD
			if($stmt->rowCount() > 0){
				// IF RECORD > 0 SYSTEM FETCH THE DEPARTMENT AS USER ROLE
				foreach($res as $x){
					$userRole = $x['departmentCode'];
				}
				// IF STATEMENT FOR DETERMINING ROLES
				// IF USER ROLE = ADMINISTRATOR SYSTEM REDIRECTS TO SYSTEM PAGE
				if($userRole === 'Administrator'){
					$_SESSION['username'] = $Dept;
					$_SESSION['category'] = $Categ;
					$_SESSION['passcode'] = $PassCode;
					header('location: page/system.php');
					
				}
				// IF USER ROLE != TO ADMINISTRATOR SYSTEM REDIRECTS TO DEPARTMENT CONTROL PAGE
				else{
					$_SESSION['username'] = $Dept;
					$_SESSION['category'] = $Categ;
					header('location: page/departmentAdmin.php');
					
				}
			}else{
				echo '<p style="color:red;">Wrong Passcode. Please try again.</p>';
			}
		}

	
	}

	// LOGOUT
	if(isset($_POST['logoutBtn'])){
		session_unset();
		session_destroy();
		header('location: ../index.php');
	}
?>