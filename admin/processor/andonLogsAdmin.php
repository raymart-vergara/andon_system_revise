<?php 
	include 'conn.php';
	// METHOD
	$method = $_GET['method'];
	ini_set('memory_limit','512M');
	if($method == 'searchAndon'){
		$from = $_GET['from'];
		$to = $_GET['to'];
		$fixingCateg = $_GET['fixing'];
		$categ = $_GET['categ'];
		$dept = $_GET['dept'];
		$shift = $_GET['shift'];
		$server = $_GET['servername'];
		$car_model =  $_GET['car_model'];
		// SHIFT RESTRICTION --------------------
		if($shift == 'DS'){
			// 8AM
			$time_range_start = '08:00:00';
			// 7:69 PM
			$time_range_end = '19:59:59';
		}
		if($shift == 'NS'){
			$time_range_start = '20:00:00';
				//7:59AM
				$time_range_end = '07:59:59';
				$new_date_to = new DateTime($to);
				$new_date_to->modify("+1 day");
				$to = $new_date_to->format("Y-m-d");
		}

		if($shift == ''){
			$time_range_start = '00:00:00';
			$time_range_end = '23:59:59';
		}
		// ---------------------------------------

		// SERVER SELECTION ---------------------
		if($server == 'live'){
			$table_database = 'tblhistory';
		}else{
			$table_database = 'backupdatabase';
		}


		// SUPER QUERY
		$query = "SELECT DISTINCT * FROM $table_database WHERE requestDateTime >= '$from $time_range_start' AND requestDateTime <= '$to $time_range_end' AND fixRemarks LIKE '$fixingCateg%' AND category LIKE '$categ%' AND department LIKE '$dept%' AND line LIKE '$car_model%'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			// RETURN DATAS
			foreach($stmt->fetchAll() as $x){
				// DATA CONVERTION TO APPRIOPRIATE ENGLISH TERMS ------------------------------------------
					if($x['backupRequestTime'] == '0000-00-00 00:00:00'){
						$x['backupRequestTime'] = "N/A";
					}
					// CHANGE 0000-00-00 00:00:	00 TO N/A
					if($x['backupAccept'] == '0000-00-00 00:00:00'){
						$x['backupAccept'] = "N/A";
								}
					// CHANGE BLANK TECH TO N/A
					if($x['backupTechnicianName'] == ''){
						$x['backupTechnicianName'] = "N/A";
					}
					// BACKUP COMMENT BLANK TO --
					if($x['backupComment'] == ''){
						$x['backupComment'] = 'N/A';
					}
					if($x['serial_num'] == ''){
						$x['serial_num'] = 'N/A';
					}
					if($x['jigName'] == ''){
						$x['jigName'] = 'N/A';
					}
					if($x['jigLocation'] == ''){
						$x['jigLocation'] = 'N/A';
					}
					if($x['lineStatus'] == ''){
						$x['lineStatus'] = 'N/A';
					}
					if($x['circuit_location'] == ''){
						$x['circuit_location'] = 'N/A';
					}
					if($x['lotNumber'] == ''){
						$x['lotNumber'] = 'N/A';
					}
					if($x['productNumber'] == ''){
						$x['productNumber'] = 'N/A';
					}

					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
				// -------------------------------------------------------------------------------------------

				echo '<tr>';
				echo '<td>'.$x['category'].'</td>';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.$x['machineNo'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['operatorName'].'</td>';
				echo '<td>'.$x['requestDateTime'].'</td>';
				echo '<td>'.round($x['waitingTime'],2).'</td>';
				echo '<td>'.$x['startDateTime'].'</td>';
				echo '<td>'.$x['endDateTime'].'</td>';
				echo '<td>'.round($fixingTimeminutes,2).'</td>';
				echo '<td>'.$x['technicianName'].'</td>';
				echo '<td>'.$x['department'].'</td>';
				echo '<td>'.$x['counter_measure'].'</td>';
				echo '<td>'.$x['serial_num'].'</td>';
				echo '<td>'.$x['jigName'].'</td>';
				echo '<td>'.$x['jigLocation'].'</td>';
				echo '<td>'.$x['lineStatus'].'</td>';
				echo '<td>'.$x['circuit_location'].'</td>';
				echo '<td>'.$x['lotNumber'].'</td>';
				echo '<td>'.$x['productNumber'].'</td>';
				echo '<td>'.$x['fixRemarks'].'</td>';
				echo '<td>'.$x['backupRequestTime'].'</td>';
				echo '<td>'.$x['backupComment'].'</td>';
				echo '<td>'.$x['backupTechnicianName'].'</td>';
				echo '<td>'.$x['backupAccept'].'</td>';
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="24">NO RECORD FOUND</td>';
			echo '</tr>';
		}


	}


//MTTR

if($method == 'searchMTTR'){
		$from = $_GET['from'];
		$to = $_GET['to'];
		$fixingCateg = $_GET['fixing'];
		$categ = $_GET['categ'];
		$dept = $_GET['dept'];
		$shift = $_GET['shift'];
		$server = $_GET['servername'];
		$car_model =  $_GET['car_model'];
		$c = 0;
		// SHIFT RESTRICTION --------------------
		if($shift == 'DS'){
			// 8AM
			$time_range_start = '08:00:00';
			// 7:69 PM
			$time_range_end = '19:59:59';
		}
		if($shift == 'NS'){
			$time_range_start = '20:00:00';
				//7:59AM
				$time_range_end = '07:59:59';
				$new_date_to = new DateTime($to);
				$new_date_to->modify("+1 day");
				$to = $new_date_to->format("Y-m-d");
		}

		if($shift == ''){
			$time_range_start = '00:00:00';
			$time_range_end = '23:59:59';
		}
		// ---------------------------------------

		// SERVER SELECTION ---------------------
		if($server == 'live'){
			$table_database = 'tblhistory';
		}else{
			$table_database = 'backupdatabase';
		}


		// SUPER QUERY
		$query = "SELECT DISTINCT *, count(problem) as cases FROM $table_database WHERE requestDateTime >= '$from $time_range_start' AND requestDateTime <= '$to $time_range_end' AND fixRemarks LIKE '$fixingCateg%' AND category LIKE '$categ%' AND department LIKE '$dept%' AND line LIKE '$car_model%' GROUP BY listId";
		// $query ="SELECT * FROM $table_database WHERE requestDateTime >= '$from $time_range_start' AND requestDateTime <= '$to $time_range_end' AND fixRemarks LIKE '$fixingCateg%' AND category LIKE '$categ%' AND department LIKE '$dept%' AND line LIKE '$car_model%'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			// RETURN DATAS
			foreach($stmt->fetchAll() as $x){
				// DATA CONVERTION TO APPRIOPRIATE ENGLISH TERMS ------------------------------------------
					if($x['backupRequestTime'] == '0000-00-00 00:00:00'){
						$x['backupRequestTime'] = "N/A";
					}
					// CHANGE 0000-00-00 00:00:00 TO N/A
					if($x['backupAccept'] == '0000-00-00 00:00:00'){
						$x['backupAccept'] = "N/A";
								}
					// CHANGE BLANK TECH TO N/A
					if($x['backupTechnicianName'] == ''){
						$x['backupTechnicianName'] = "N/A";
					}
					// BACKUP COMMENT BLANK TO --
					if($x['backupComment'] == ''){
						$x['backupComment'] = 'N/A';
					}
					if($x['serial_num'] == ''){
						$x['serial_num'] = 'N/A';
					}
					if($x['jigName'] == ''){
						$x['jigName'] = 'N/A';
					}
					if($x['jigLocation'] == ''){
						$x['jigLocation'] = 'N/A';
					}
					if($x['lineStatus'] == ''){
						$x['lineStatus'] = 'N/A';
					}
					if($x['circuit_location'] == ''){
						$x['circuit_location'] = 'N/A';
					}
					if($x['lotNumber'] == ''){
						$x['lotNumber'] = 'N/A';
					}
					if($x['productNumber'] == ''){
						$x['productNumber'] = 'N/A';
					}

					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
				// -------------------------------------------------------------------------------------------
				echo	$total = round($fixingTimeminutes,0) - round($x['waitingTime'],0);

					$c++;
				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['endDateTime'].'</td>';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.round($fixingTimeminutes,0).'</td>';
				echo '<td>'.round($x['waitingTime'],0).'</td>';
				echo '<td class="total_working">'.abs($total).'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['counter_measure'].'</td>';
				// echo '<td>'.round($x['waitingTime'],2).'</td>';
				echo '<td class="total_cases">'.$x['cases'].'</td>';
				echo '<td class="technicianName">'.$x['technicianName'].'</td>';
				// echo '<td>'.round($fixingTimeminutes,2).'</td>';
				
			
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="24">NO RECORD FOUND</td>';
			echo '</tr>';
		}


	}





if($method == 'searchMTTR2'){
		$from = $_GET['from'];
		$to = $_GET['to'];
		$fixingCateg = $_GET['fixing'];
		$categ = $_GET['categ'];
		$dept = $_GET['dept'];
		$shift = $_GET['shift'];
		$server = $_GET['servername'];
		$car_model =  $_GET['car_model'];
		$c = 0;
		// SHIFT RESTRICTION --------------------
		if($shift == 'DS'){
			// 8AM
			$time_range_start = '08:00:00';
			// 7:69 PM
			$time_range_end = '19:59:59';
		}
		if($shift == 'NS'){
			$time_range_start = '20:00:00';
				//7:59AM
				$time_range_end = '07:59:59';
				$new_date_to = new DateTime($to);
				$new_date_to->modify("+1 day");
				$to = $new_date_to->format("Y-m-d");
		}

		if($shift == ''){
			$time_range_start = '00:00:00';
			$time_range_end = '23:59:59';
		}
		// ---------------------------------------

		// SERVER SELECTION ---------------------
		if($server == 'live'){
			$table_database = 'tblhistory';
		}else{
			$table_database = 'backupdatabase';
		}


		// SUPER QUERY
		$query = "SELECT DISTINCT *, count(problem) as cases FROM $table_database WHERE requestDateTime >= '$from $time_range_start' AND requestDateTime <= '$to $time_range_end' AND fixRemarks LIKE '$fixingCateg%' AND category LIKE '$categ%' AND department LIKE '$dept%' AND line LIKE '$car_model%' GROUP BY technicianName";
		// $query ="SELECT * FROM $table_database WHERE requestDateTime >= '$from $time_range_start' AND requestDateTime <= '$to $time_range_end' AND fixRemarks LIKE '$fixingCateg%' AND category LIKE '$categ%' AND department LIKE '$dept%' AND line LIKE '$car_model%'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			// RETURN DATAS
			foreach($stmt->fetchAll() as $x){
				// DATA CONVERTION TO APPRIOPRIATE ENGLISH TERMS ------------------------------------------
					if($x['backupRequestTime'] == '0000-00-00 00:00:00'){
						$x['backupRequestTime'] = "N/A";
					}
					// CHANGE 0000-00-00 00:00:00 TO N/A
					if($x['backupAccept'] == '0000-00-00 00:00:00'){
						$x['backupAccept'] = "N/A";
								}
					// CHANGE BLANK TECH TO N/A
					if($x['backupTechnicianName'] == ''){
						$x['backupTechnicianName'] = "N/A";
					}
					// BACKUP COMMENT BLANK TO --
					if($x['backupComment'] == ''){
						$x['backupComment'] = 'N/A';
					}
					if($x['serial_num'] == ''){
						$x['serial_num'] = 'N/A';
					}
					if($x['jigName'] == ''){
						$x['jigName'] = 'N/A';
					}
					if($x['circuit_location'] == ''){
						$x['circuit_location'] = 'N/A';
					}
					if($x['lotNumber'] == ''){
						$x['lotNumber'] = 'N/A';
					}
					if($x['productNumber'] == ''){
						$x['productNumber'] = 'N/A';
					}

					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
				// -------------------------------------------------------------------------------------------
				echo	$total = round($fixingTimeminutes,0) - round($x['waitingTime'],0);

					$c++;
				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['endDateTime'].'</td>';
				echo '<td>'.$x['line'].'</td>';
				echo '<td>'.$x['machineName'].'</td>';
				echo '<td>'.round($fixingTimeminutes,0).'</td>';
				echo '<td>'.round($x['waitingTime'],0).'</td>';
				echo '<td class="total_working2">'.abs($total).'</td>';
				echo '<td>'.$x['problem'].'</td>';
				// echo '<td>'.round($x['waitingTime'],2).'</td>';
				echo '<td class="total_cases2">'.$x['cases'].'</td>';
				echo '<td class="technicianName2">'.$x['technicianName'].'</td>';
				// echo '<td>'.round($fixingTimeminutes,2).'</td>';
				
			
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="24">NO RECORD FOUND</td>';
			echo '</tr>';
		}


	}





//MACHINE PROBLEM 
		if($method == 'searchMachine'){
		$from = $_GET['from'];
		$to = $_GET['to'];
		$fixingCateg = $_GET['fixing'];
		$categ = $_GET['categ'];
		$dept = $_GET['dept'];
		$shift = $_GET['shift'];
		$server = $_GET['servername'];
		$car_model =  $_GET['car_model'];
		$c =0;
		// SHIFT RESTRICTION --------------------
		if($shift == 'DS'){
			// 8AM
			$time_range_start = '08:00:00';
			// 7:69 PM
			$time_range_end = '19:59:59';
		}
		if($shift == 'NS'){
			$time_range_start = '20:00:00';
				//7:59AM
				$time_range_end = '07:59:59';
				$new_date_to = new DateTime($to);
				$new_date_to->modify("+1 day");
				$to = $new_date_to->format("Y-m-d");
		}

		if($shift == ''){
			$time_range_start = '00:00:00';
			$time_range_end = '23:59:59';
		}
		// ---------------------------------------

		// SERVER SELECTION ---------------------
		if($server == 'live'){
			$table_database = 'tblhistory';
		}else{
			$table_database = 'backupdatabase';
		}


		// SUPER QUERY
		$query = "SELECT *, count(problem) as total FROM $table_database WHERE requestDateTime >= '$from $time_range_start'	 AND requestDateTime <= '$to $time_range_end' AND fixRemarks LIKE '$fixingCateg%' AND category LIKE '$categ%' AND department LIKE '$dept%' AND line LIKE '$car_model%' GROUP BY problem";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			// RETURN DATAS
			foreach($stmt->fetchAll() as $x){
				// DATA CONVERTION TO APPRIOPRIATE ENGLISH TERMS ------------------------------------------
					if($x['backupRequestTime'] == '0000-00-00 00:00:00'){
						$x['backupRequestTime'] = "N/A";
					}
					// CHANGE 0000-00-00 00:00:	00 TO N/A
					if($x['backupAccept'] == '0000-00-00 00:00:00'){
						$x['backupAccept'] = "N/A";
								}
					// CHANGE BLANK TECH TO N/A
					if($x['backupTechnicianName'] == ''){
						$x['backupTechnicianName'] = "N/A";
					}
					// BACKUP COMMENT BLANK TO --
					if($x['backupComment'] == ''){
						$x['backupComment'] = 'N/A';
					}
					if($x['serial_num'] == ''){
						$x['serial_num'] = 'N/A';
					}
					if($x['jigName'] == ''){
						$x['jigName'] = 'N/A';
					}
					if($x['circuit_location'] == ''){
						$x['circuit_location'] = 'N/A';
					}
					if($x['lotNumber'] == ''){
						$x['lotNumber'] = 'N/A';
					}
					if($x['productNumber'] == ''){
						$x['productNumber'] = 'N/A';
					}

					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
				// -------------------------------------------------------------------------------------------

					$c++;

				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td >'.$x['machineName'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td>'.$x['total'].'</td>';
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="24">NO RECORD FOUND</td>';
			echo '</tr>';
		}


	}


	// for chart
		if($method == 'searchMachine2'){
		$from = $_GET['from'];
		$to = $_GET['to'];
		$fixingCateg = $_GET['fixing'];
		$categ = $_GET['categ'];
		$dept = $_GET['dept'];
		$shift = $_GET['shift'];
		$server = $_GET['servername'];
		$car_model =  $_GET['car_model'];
		$c =0;
		// SHIFT RESTRICTION --------------------
		if($shift == 'DS'){
			// 8AM
			$time_range_start = '08:00:00';
			// 7:69 PM
			$time_range_end = '19:59:59';
		}
		if($shift == 'NS'){
			$time_range_start = '20:00:00';
				//7:59AM
				$time_range_end = '07:59:59';
				$new_date_to = new DateTime($to);
				$new_date_to->modify("+1 day");
				$to = $new_date_to->format("Y-m-d");
		}

		if($shift == ''){
			$time_range_start = '00:00:00';
			$time_range_end = '23:59:59';
		}
		// ---------------------------------------

		// SERVER SELECTION ---------------------
		if($server == 'live'){
			$table_database = 'tblhistory';
		}else{
			$table_database = 'backupdatabase';
		}


		// SUPER QUERY
		$query = "SELECT DISTINCT *, count(problem) as total FROM $table_database WHERE requestDateTime >= '$from $time_range_start'	 AND requestDateTime <= '$to $time_range_end' AND fixRemarks LIKE '$fixingCateg%' AND category LIKE '$categ%' AND department LIKE '$dept%' AND line LIKE '$car_model%' GROUP BY machineName";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			// RETURN DATAS
			foreach($stmt->fetchAll() as $x){
				// DATA CONVERTION TO APPRIOPRIATE ENGLISH TERMS ------------------------------------------
					if($x['backupRequestTime'] == '0000-00-00 00:00:00'){
						$x['backupRequestTime'] = "N/A";
					}
					// CHANGE 0000-00-00 00:00:	00 TO N/A
					if($x['backupAccept'] == '0000-00-00 00:00:00'){
						$x['backupAccept'] = "N/A";
								}
					// CHANGE BLANK TECH TO N/A
					if($x['backupTechnicianName'] == ''){
						$x['backupTechnicianName'] = "N/A";
					}
					// BACKUP COMMENT BLANK TO --
					if($x['backupComment'] == ''){
						$x['backupComment'] = 'N/A';
					}
					if($x['serial_num'] == ''){
						$x['serial_num'] = 'N/A';
					}
					if($x['jigName'] == ''){
						$x['jigName'] = 'N/A';
					}
					if($x['circuit_location'] == ''){
						$x['circuit_location'] = 'N/A';
					}
					if($x['lotNumber'] == ''){
						$x['lotNumber'] = 'N/A';
					}
					if($x['productNumber'] == ''){
						$x['productNumber'] = 'N/A';
					}

					$fixingTime = explode(':',$x['fixInterval']);
					$fixingTimeminutes =  ($fixingTime[0] * 60 + $fixingTime[1] * 1 + $fixingTime[2] / 60);
				// -------------------------------------------------------------------------------------------

					$c++;

				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td class="machineName">'.$x['machineName'].'</td>';
				echo '<td>'.$x['problem'].'</td>';
				echo '<td class="total">'.$x['total'].'</td>';
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="24">NO RECORD FOUND</td>';
			echo '</tr>';
		}


	}






	// KILL DATABASE CONNECTION
	$conn=null;
?>
